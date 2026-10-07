param([ValidateSet('start','stop','status','logs')][string]$Action = 'start')
$ErrorActionPreference = 'Stop'
Set-Location -LiteralPath $PSScriptRoot
$docker = (Get-Command docker -ErrorAction SilentlyContinue).Source
if (-not $docker) {
    $docker = @("$env:LOCALAPPDATA\Programs\DockerDesktop\resources\bin\docker.exe", "$env:ProgramFiles\Docker\Docker\resources\bin\docker.exe") | Where-Object { Test-Path -LiteralPath $_ } | Select-Object -First 1
}
if (-not $docker) { throw 'Installe Docker Desktop puis relance.' }
$env:PATH = (Split-Path -Parent $docker) + ';' + $env:PATH
& $docker info --format '{{.ServerVersion}}'
if ($LASTEXITCODE -ne 0) { throw 'Ouvre Docker Desktop et attends que son moteur soit pret.' }
& $docker compose config --quiet
if ($LASTEXITCODE -ne 0) { throw 'Configuration Compose invalide.' }
switch ($Action) {
    'start' { & $docker compose up -d --wait --wait-timeout 180 }
    'stop' { & $docker compose stop }
    'status' { & $docker compose ps }
    'logs' { & $docker compose logs --tail 100 }
}
if ($LASTEXITCODE -ne 0) { throw 'La commande Docker a echoue.' }
