### Laravel [Backend] | Vue [Frontend] | Inertia | Tailwind [CSS]
-----------------------------------------------------------------------------------------------------------

## About

It is a Laravel 9 Vue3 Inertia JS based project template showing the basics of inertia js. Authentication, Authorization, Routing, form submittion and data binding. It will help begineers to understand "How to start with Inertia JS".

1. Laravel 9
2. Vue 3
3. Inertia JS
4. Tailwind CSS 3
5. laravel/breeze
6. Authentication
7. Authorization
8. 
-----------------------------------------------------------------------------------------------------------
## Getting Started Step by Step
1. Clone the project file using git clone https://github.com/LilDarkin/Project-Template.git
2. Open terminal (bash/cmd). Then go to project folder using command

```sh
cd project-template
```

3. Then install required files and libraries using 

```sh
composer install
```

4. Then create a .env file and generate key for this project using command 

```sh
cp .env.example .env

php artisan key:generate
```

5. Then compile all CSS & JS files together using this command

```sh
npm install && npm run dev
```

or

```sh
yarn install && yarn run dev
```
6. Create a database in MYSQL and connect it with your project via updating .env file.
7. After connecting the db with project, then run command 

```sh
php artisan migrate:fresh --seed
```

## After completing the migration and seeding of db, you will have 5 user ready for login in this project. 
# Admin
Employee No -> 001
Pass        -> 123
# Students
Student No  -> 20240001 / 20240002
Pass        -> 123
# Teacher
Employee No  -> 20240003
Pass         -> 123
# Librarian
Employee No  -> 20240004
Pass         -> 123
# If you want to create a user, use admin account > Users > Create User
-----------------------------------------------------------------------------------------------------------

Finally we are ready to run our project using this command

```sh
php artisan serve 
```
in one terminal and also run

```sh
npm run watch 
```
 on another terminal for compiling js and css. 
-----------------------------------------------------------------------------------------------------------

 ## Tools I used

1. Vscode
2. WAMP 3.2.6 [Better version of XAMPP]
3. Git Bash [Terminal]
4. MySQL Workbench 8
5. PHP 8.1.0
6. MySQL 8.0.27
7. Apache 2.4.51
