@echo off
title Server PT Bersih Prima Nusantara - Web Alat Kebersihan
echo ===================================================================
echo   SERVER WEB COMPANY PROFILE ALAT KEBERSIHAN (SAPU & PEL LANTAI)
echo   PT BERSIH PRIMA NUSANTARA
echo ===================================================================
echo.

where php >nul 2>&1
if %ERRORLEVEL% equ 0 (
    echo Membuka website di browser: http://localhost:8000
    start http://localhost:8000
    echo Menjalankan PHP Development Server pada port 8000...
    echo (Tekan Ctrl + C untuk menghentikan server)
    echo.
    php -S localhost:8000
) else (
    where python >nul 2>&1
    if %ERRORLEVEL% equ 0 (
        echo PHP tidak terdeteksi di PATH, beralih ke Python Web Server...
        echo Membuka website di browser: http://localhost:8000
        start http://localhost:8000
        echo Menjalankan Local Web Server pada port 8000...
        python -m http.server 8000
    ) else (
        echo Harap install PHP atau Python untuk menjalankan web server lokal.
        pause
    )
)
pause