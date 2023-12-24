<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About this project

Final exam for ```Advanced Web Development``` subject at VNUK Institute for Research and Executive Education

Student: ```Phạm Duy Trưởng```

Student ID: ```21020014```

Lecterer: ```Nguyễn Hữu Quyền```

## Integrated Kits

- **[Laravel Breeze & Livewire](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)**
- **[Laravel Sanctum](https://laravel.com/docs/10.x/sanctum#main-content)**
- **[Scramble](https://scramble.dedoc.co/) & [Telescope](https://laravel.com/docs/10.x/telescope#main-content)**
- **[Tailwind CSS](https://tailwindcss.com/) (via [Vite](https://laravel.com/docs/10.x/vite))**

## Features

- A Todos application with ```CRUD``` functions
- Login and register function
- User can add their own categories and edit/delete as well
- Ability to update user's profile (this is provided by Breeze kit)
- ```Filter tasks by category``` (might be by status as well, this is easy but I'm lazy)

## Dev features
- Database migration and models to create schema
- Database seeder using factories
- Implement ```Livewire``` using ```Blade``` as layout
- Service providers such as ```Scramble``` to create API document and ```Telescope``` to monitor requests
- ```Laravel Sanctum``` for authentication (this is nearly done)

## Demo video

https://youtu.be/WUrOWL8vpDo
 
## Database schema
<img src="https://i.imgur.com/0M3aSQ5.png)https://i.imgur.com/0M3aSQ5.png" width="400" alt="DB schema">

## Installation
1. Clone this repository
```shell
    git clone https://github.com/lunarpham/AWDevFinalExam.git
````
2. Install dependencies
```shell
    composer install
    npm install
````
3. Database migrate and seed
   Check your database config in .env and config/database.php before processing
```shell
    php artisan migrate --seed
````
4. Run Laravel application
```shell
    php artisan serve
````
5. Run Vite (for Tailwind CSS)
```shell
    npm run dev
````
