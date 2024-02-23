<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

start apache and mysql on xampp

Start in local env using 
php artisan serve

The command to create MySql schema
php artisan migrate 

The command to run dummy seed data
php artisan db:seed

The endpoint to get user(s) grouped by score is
GET|HEAD        api/users-grouped-by-score
In local enviornment
GET|HEAD        http://localhost:8000/api/users-grouped-by-score

The command to find the latest winner and save in winners table (if no tie exists) has
signature = 'find:winner' , which can be checked using php artisan schedule:run in local system.

it can be setup using crontab as 
*/5 * * * * cd /path-to-your-project && php artisan schedule:run 2>&1

 -- OR --

In actions of task scheduler on  windows
Go to the "Actions" tab and click "New..."
Action: Start a program.
Program/script: Enter the path to the php.exe executable. This is usually located in your PHP installation directory. For example: C:\xampp\php\php.exe.
Add arguments: Path to your artisan file and the Laravel command you want to run. For example: C:\path\to\your\project\artisan command:name.
Start in: Path to your Laravel project directory. For example: C:\path\to\your\project.

Go to the "Triggers" tab and click "New..." to create a new trigger for your task. You can set the schedule here.(Modify accordingly).
Go to the "Settings" tab to configure any additional settings you need.

Click "OK" to save the task.
Upon viewing the task's action it should be like C:\xampp\php\php.exe artisan schedule:run

The QR image for address information is saved under public/storage/qrcodes from the GenerateQrCodeJob is stored in local it can be accessed using http://localhost:8000/storage/qrcodes/{user_id}.png
or through hosted url as well , only the domain will be modified.