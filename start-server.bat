@echo off
title Server PT Bersih Prima Nusantara - Web Alat Kebersihan
echo ===================================================================
echo   SERVER WEB COMPANY PROFILE ALAT KEBERSIHAN (SAPU & PEL LANTAI)
echo   PT BERSIH PRIMA NUSANTARA
echo ===================================================================
echo.

where php >nul 2>&1
if %ERRORLEVEL% equ 0 (
    set PHP_BIN=php
) else (
    set PHP_BIN="C:\Users\%USERNAME%\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
)

echo Membuka website di browser: http://localhost:8000
start http://localhost:8000

echo Menjalankan PHP Development Server pada port 8000...
echo (Tekan Ctrl + C untuk menghentikan server)
echo.

%PHP_BIN% -S localhost:8000
pause