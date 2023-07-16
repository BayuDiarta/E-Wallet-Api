# Description
A E-Wallet Lumen Service Repository and JWT auth.

# Features
This API developed with PHP 8.0, Lumen Framework 9.0
 
# Tech Used
 ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![JWT](https://img.shields.io/badge/JWT-black?style=for-the-badge&logo=JSON%20web%20tokens) ![Lumen](https://img.shields.io/badge/lumen-%23FF2D20.svg?style=for-the-badge&logo=lumen&logoColor=white) ![PostgresSQL](https://img.shields.io/badge/postgresql-%23316192.svg?&style=for-the-badge&logo=postgresql&logoColor=white) ![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white) ![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
      
# Getting Start:
Before you running the program, make sure you've run this command:
- `docker-compose up -d --build`
- `docker-compose exec app composer install --ignore-platform-req=ext-zip`
-  `cp .env.example .env`
-  Generate the jwt secret key with `docker-compose exec app php artisan jwt:secret`

### Database setup:
- Create your own database, and put the credential in env file
- Run the migration with `docker-compose exec app php artisan migrate --seed`

### Run the program
- `localhost:80`
- `Unit Test (docker-compose exec app vendor/bin/phpunit tests/{nameTest.php})`

### API Route List
| Method | URL                                      | Description           | Authorization           |         
| ------ | ---------------------------------------- | --------------------- | ------------------------|
| POST   | localhost:80/api/auth/register           | Register              |                         |
| POST   | localhost:80/api/auth/login              | Login                 |                         |
| POST   | localhost:80/api/auth/forgot-password    | Forgot Password       |                         |
| POST   | localhost:80/api/auth/reset-password     | Reset Password        |                         |
| POST   | localhost:80/api/logout                  | Logout                | Add Authorization token |
| GET    | localhost:80/api/users/profile           | Get User              | Add Authorization token |
| POST   | localhost:80/api/users                   | Create User           | Add Authorization token |
| POST   | localhost:80/api/users/{id}              | Update User           | Add Authorization token |
| DELETE | localhost:80/api/users/{id}              | Delete User           | Add Authorization token |
| GET    | localhost:80/api/wallet/detail?limit=10  | Get Detail Wallet     | Add Authorization token | 
| POST   | localhost:80/api/wallet/create           | Create Wallet         | Add Authorization token |
| POST   | localhost:80/api/wallet/topup            | TopUp                 | Add Authorization token |
| POST   | localhost:80/api/wallet/transfer         | Transfer              | Add Authorization token |
| POST   | localhost:80/api/wallet/widtraw          | Widtraw               | Add Authorization token |



