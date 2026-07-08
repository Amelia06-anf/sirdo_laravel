@echo off
cd /d C:\xampp\htdocs\sirdo_laravel
start /min C:\xampp\mysql\bin\mysqld.exe
timeout /t 5
php artisan serve --host=0.0.0.0 --port=8000