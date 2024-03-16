## Requirements
•	PHP 7.3 or higher <br>
•	Node 12.13.0 or higher <br>

## Usage <br>
Setting up your development environment on your local machine: <br>
```
git clone git@github.com:codewithdary/laravel-8-complete-blog.git
cd laravel-8-complete-blog
cp .env.example .env
composer install
php artisan key:generate
php artisan cache:clear && php artisan config:clear
php artisan serve
```

## Before starting <br>
Create a database <br>
```
mysql
create database laravelblog;
exit;
```

Set up your database credentials in the .env file <br>
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelblog
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}
```

Migrate the tables
```
php artisan migrate
```

## Screenshots

![Homepage](.\public\images\2345.png)
Home page

![Games](.\public\images\1234.png)  
*Page Games*

![Guides](.\public\images\3456.png)  
*Page Guids*

![Dashboard](.\public\images\4567.png)  
*One of many reviews*

## Data Structure

| Table    | Description                              |
|----------|------------------------------------------|
| Users    | Holds user information                   |
| Posts    | Stores all blog posts                    |
| Guides   | Stores all guides (based on games table) |
| Reviews  | Stores all reviews                       |
| Games    | Stores all games                         |
| Comments | Contains user comments for reviews       |


## Features

- User authentication system.
- CRUD operations for posts and games.
- Commenting feature on reviews.
- Dynamic routing for cleaner URLs.
- Responsive design for multiple devices.

## Technologies Used

- PHP Laravel 8
- MySQL for database management
- Bootstrap, Tailwind and CSS for styling
- TinyMCE for rich text editing
