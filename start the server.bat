@echo off
setlocal enabledelayedexpansion

REM Set the path to the XAMPP PHP executable (change it if necessary)
set PHP_PATH="C:\xampp\php\php.exe"

REM Set the path to the Laravel project directory (change it if necessary)
set PROJECT_PATH="C:\path\to\your\laravel\project"

REM Get the root of the file (assuming the batch file is in the Laravel project directory)
set "ROOT_PATH=%~dp0"

REM Change to the Laravel project directory
cd %PROJECT_PATH%

REM Run XAMPP PHP artisan serve
%PHP_PATH% artisan serve

endlocal
