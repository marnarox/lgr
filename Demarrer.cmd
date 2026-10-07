@echo off
cd /d "%~dp0"
set "PATH=%LOCALAPPDATA%\Programs\DockerDesktop\resources\bin;%ProgramFiles%\Docker\Docker\resources\bin;%PATH%"
docker compose config --quiet
if errorlevel 1 goto fin
docker compose up -d --wait --wait-timeout 180
if errorlevel 1 goto fin
echo Site : http://dingding.localhost
:fin
pause
