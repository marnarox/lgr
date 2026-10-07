param(
    [Parameter(Mandatory)][ValidateSet('backup','restore')][string]$Action,
    [string]$BackupPath
)
$ErrorActionPreference = 'Stop'
$projectRoot = Split-Path -Parent (Split-Path -Parent $PSScriptRoot)
Set-Location -LiteralPath $projectRoot
$dockerLgr = (Get-Command docker -ErrorAction SilentlyContinue).Source
if (-not $dockerLgr) {
    $dockerLgr = @("$env:LOCALAPPDATA\Programs\DockerDesktop\resources\bin\docker.exe", "$env:ProgramFiles\Docker\Docker\resources\bin\docker.exe") | Where-Object { Test-Path -LiteralPath $_ } | Select-Object -First 1
}
if (-not $dockerLgr) { throw 'Docker Desktop introuvable.' }
$env:PATH = (Split-Path -Parent $dockerLgr) + ';' + $env:PATH
function Invoke-LgrDocker {
    & $dockerLgr @args
    if ($LASTEXITCODE -ne 0) { throw 'La commande Docker a echoue.' }
}
Invoke-LgrDocker compose config --quiet
Invoke-LgrDocker info --format '{{.ServerVersion}}'
$containerSql = '/tmp/lgr-transfer-' + [guid]::NewGuid().ToString('N') + '.sql'
if ($Action -eq 'backup') {
    if (-not $BackupPath) { $BackupPath = Join-Path $projectRoot ('backups/lgr-' + (Get-Date -Format 'yyyyMMdd-HHmmss')) }
    $backupFullPath = [IO.Path]::GetFullPath($BackupPath)
    if (Test-Path -LiteralPath $backupFullPath) { throw 'Choisis un dossier de sauvegarde qui nexiste pas encore.' }
    New-Item -ItemType Directory -Path $backupFullPath | Out-Null
    Invoke-LgrDocker compose exec -T lgr-db sh -c 'exec mariadb-dump --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" --single-transaction --quick --skip-lock-tables --default-character-set=utf8mb4 "$MYSQL_DATABASE" > "$1"' sh $containerSql
    Invoke-LgrDocker compose cp "lgr-db:$containerSql" (Join-Path $backupFullPath 'database.sql')
    $uploadsPath = Join-Path $projectRoot 'lgr/wp-content/uploads'
    $hasMedia = (Test-Path -LiteralPath $uploadsPath) -and (@(Get-ChildItem -LiteralPath $uploadsPath -File -Recurse -Force).Count -gt 0)
    if ($hasMedia) { Compress-Archive -LiteralPath $uploadsPath -DestinationPath (Join-Path $backupFullPath 'uploads.zip') }
    @{ site='LGR'; url='http://lgr.localhost'; hasMedia=$hasMedia; created=(Get-Date -Format o); gitCommit=(& git -c "safe.directory=$projectRoot" rev-parse HEAD) } | ConvertTo-Json | Set-Content -LiteralPath (Join-Path $backupFullPath 'manifest.json') -Encoding utf8
    Invoke-LgrDocker compose exec -T lgr-db rm -- $containerSql
    Write-Output "Sauvegarde prete : $backupFullPath"
} else {
    if (-not $BackupPath) { throw 'Indique -BackupPath avec le dossier de sauvegarde.' }
    $backupFullPath = (Resolve-Path -LiteralPath $BackupPath).Path
    $manifest = Get-Content -LiteralPath (Join-Path $backupFullPath 'manifest.json') -Raw | ConvertFrom-Json
    if ($manifest.site -ne 'LGR' -or $manifest.url -ne 'http://lgr.localhost') { throw 'Cette sauvegarde ne correspond pas a LGR.' }
    $sqlPath = Join-Path $backupFullPath 'database.sql'
    if (-not (Test-Path -LiteralPath $sqlPath) -or (Get-Item -LiteralPath $sqlPath).Length -eq 0) { throw 'Sauvegarde SQL absente ou vide.' }
    if ($manifest.hasMedia -and -not (Test-Path -LiteralPath (Join-Path $backupFullPath 'uploads.zip'))) { throw 'Archive des medias absente.' }
    Write-Output 'La restauration remplace les tables WordPress LGR de cette station. Sauvegarde son etat avant si necessaire.'
    if ((Read-Host 'Tape RESTAURER pour continuer') -cne 'RESTAURER') { throw 'Restauration annulee.' }
    Invoke-LgrDocker compose up -d --wait lgr-db lgr proxy
    Invoke-LgrDocker compose stop lgr
    try {
        Invoke-LgrDocker compose cp $sqlPath "lgr-db:$containerSql"
        Invoke-LgrDocker compose exec -T lgr-db sh -c 'exec mariadb --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" --default-character-set=utf8mb4 "$MYSQL_DATABASE" < "$1"' sh $containerSql
        if ($manifest.hasMedia) { Expand-Archive -LiteralPath (Join-Path $backupFullPath 'uploads.zip') -DestinationPath (Join-Path $projectRoot 'lgr/wp-content') -Force }
        Invoke-LgrDocker compose exec -T lgr-db rm -- $containerSql
    } finally { Invoke-LgrDocker compose start lgr }
    Write-Output 'Restauration terminee : http://lgr.localhost — utilise ton compte WordPress du PC source.'
}
