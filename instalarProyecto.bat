@echo off
setlocal

:: -----------------------------
:: CONFIGURACION
:: -----------------------------
set GIT_URL=https://github.com/Klaa5/EventConnect.git
set GIT_INSTALLER=%TEMP%\GitInstaller.exe
set DESTINO=C:\xampp\htdocs\EventConnect

:: -----------------------------
:: VERIFICAR SI GIT EXISTE
:: -----------------------------
where git >nul 2>nul
if %errorlevel% neq 0 (
    echo Git no encontrado. Descargando Git for Windows...

    powershell -Command "Invoke-WebRequest -Uri 'https://github.com/git-for-windows/git/releases/latest/download/Git-64-bit.exe' -OutFile '%GIT_INSTALLER%'"

    echo Instalando Git silenciosamente...
    start /wait "" "%GIT_INSTALLER%" /VERYSILENT /NORESTART

    echo Actualizando PATH...
    set "PATH=%ProgramFiles%\Git\bin;%ProgramFiles(x86)%\Git\bin;%PATH%"
)

:: -----------------------------
:: VERIFICAR XAMPP
:: -----------------------------
if not exist "C:\xampp\htdocs" (
    echo No se encontro XAMPP en C:\xampp\htdocs
    pause
    exit /b
)

:: -----------------------------
:: ELIMINAR PROYECTO PREVIO
:: -----------------------------
if exist "%DESTINO%" (
    echo Eliminando proyecto existente...
    rmdir /S /Q "%DESTINO%"
)

:: -----------------------------
:: CLONAR PROYECTO
:: -----------------------------
echo Clonando proyecto...
git clone %GIT_URL% "%DESTINO%"

if %errorlevel% neq 0 (
    echo Error al clonar el proyecto.
    pause
    exit /b
)

echo.
echo Proyecto instalado correctamente en:
echo %DESTINO%
echo.
pause