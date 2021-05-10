Install project

1. git clone https://github.com/Zhandos-prog/kaspi-app.git
2. composer install
2. настройте подключение к бд в файле .env (нужно создать его)
3. запустите миграции > php artisan migrate
4. Далее выполните команды:<br>
    а)  php artisan permission:create-role user<br>
    b)  php artisan permission:create-role admin<br> 
    с)  php artisan db:seed --class UserSeeder<br>
    d)  php artisan db:seed --class WarehouseSeeder<br>
<br>    
Login user:    
ruk1@kaspi.kz, 
ruk2@kaspi.kz<br>
Password: 
WENYNymm34
