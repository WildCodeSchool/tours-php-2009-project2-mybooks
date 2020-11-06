# Simple MVC

## Description

This repository is a simple PHP MVC structure from scratch.

It uses some cool vendors/libraries such as Twig and Grumphp.
For this one, just a simple example where users can choose one of their databases and see tables in it.

### Check on Travis

Travis is checking your code. It's a Continuous Integration (CI) service used on this repository to launch the code verification tools on the github repository itself.

1. Go on [https://travis-ci.com](https://travis-ci.com).
2. Sign up if you don't have account,
3. Look for your project in search bar on the left,

## Installation steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import `mybooks.sql` in your SQL server,
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## URLs availables

* Home page at [localhost:8000/](localhost:8000/)
* Books list at [localhost:8000/book/index](localhost:8000/book/index)
* Book details [localhost:8000/book/index/show/:id](localhost:8000/book/show/2)
* Book edit [localhost:8000/book/index/edit/:id](localhost:8000/book/edit/2)
* Book add [localhost:8000/book/index/add](localhost:8000/book/add)
* Book deletion [localhost:8000/book/index/delete/:id](localhost:8000/book/delete/2)

## How does URL routing work ?

![Simple MVC.png](https://raw.githubusercontent.com/WildCodeSchool/simple-mvc/master/Simple%20-%20MVC.png)
