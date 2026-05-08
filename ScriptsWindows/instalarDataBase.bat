@echo off
chcp 65001 >nul
title Setup EventConnect - MySQL

echo ============================================================
echo        Configuracion de MySQL - EventConnect
echo ============================================================
echo.

REM ── Configuracion ──────────────────────────────────────────────
set DB_NAME=EventConnect
set NEW_USER=user
set NEW_PASS=user123
set SQL_FILE=%USERPROFILE%\Downloads\EventConnect.sql
set MYSQL_HOST=localhost
set MYSQL_PORT=3306
set MYSQL_ROOT=root

REM ── Solicitar credenciales de root ─────────────────────────────

echo.
echo Pone la contraseña de root que tienes en el phpMyadmin, si no te acuerdas busca en el firefox:
set /p MYSQL_ROOT_PASS=Contrasena: 

echo.
echo [1/4] Verificando archivo de volcado...
echo       Ruta: %SQL_FILE%
echo.

if not exist "%SQL_FILE%" (
    echo [ERROR] No se encontro el archivo SQL en:
    echo         %SQL_FILE%
    echo         Asegurate de que el archivo este en la carpeta Downloads.
    pause
    exit /b 1
)

echo        Archivo encontrado correctamente.

echo.
echo [2/4] Creando base de datos '%DB_NAME%' y usuario '%NEW_USER%'...

REM ── Ejecutar comandos MySQL como root ──────────────────────────
mysql -h %MYSQL_HOST% -P %MYSQL_PORT% -u %MYSQL_ROOT% -p%MYSQL_ROOT_PASS% --execute="^
CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;^
CREATE USER IF NOT EXISTS '%NEW_USER%'@'%%' IDENTIFIED BY '%NEW_PASS%';^
GRANT ALL PRIVILEGES ON *.* TO '%NEW_USER%'@'%%' WITH GRANT OPTION;^
FLUSH PRIVILEGES;" 2>&1

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [ERROR] Fallo al conectar o ejecutar comandos en MySQL.
    echo         Verifica que:
    echo           - MySQL este corriendo
    echo           - El host, puerto y credenciales sean correctos
    pause
    exit /b 1
)

echo        Base de datos y usuario creados correctamente.

echo.
echo [3/4] Cargando volcado en la base de datos '%DB_NAME%'...

mysql -h %MYSQL_HOST% -P %MYSQL_PORT% -u %MYSQL_ROOT% -p%MYSQL_ROOT_PASS% %DB_NAME% < "%SQL_FILE%" 2>&1

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [ERROR] Fallo al importar el volcado SQL.
    echo         Verifica que el archivo descargado sea valido.
    pause
    exit /b 1
)

echo        Volcado importado correctamente.

echo.
echo [4/4] Finalizando configuracion...

echo.
echo ============================================================
echo   CONFIGURACION COMPLETADA EXITOSAMENTE
echo ============================================================
echo.
echo   Base de datos : %DB_NAME%
echo   Host          : %MYSQL_HOST%:%MYSQL_PORT%
echo   Usuario       : %NEW_USER%
echo   Contrasena    : %NEW_PASS%
echo   Privilegios   : TODOS (WITH GRANT OPTION)
echo.
echo ============================================================
pause