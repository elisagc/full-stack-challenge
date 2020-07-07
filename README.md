AVIRATO FULL-STACK CHALLENGE
=====================

Welcome to our Full-Stack challenge!

This project includes the scaffold in order to start the code challenge. You will need to proceed with installation and configuration and after that, you can do the exercise. It will have 3 main parts we are going to explain. This code challenge has been made in order to test fullstack skills. You will need to use **Laravel**, **MySQL** and **Vue**. If you want to add any CSS preprocessor or similar, please use **SCSS**.

Once you have done your code challenge send us your github repository link to [empleo@avirato.com](mailto:empleo@avirato.com) with *Full-Stack Challenge* as subject.

## Configuration

In this project you only have to configure the environment variables to connect to your own [MySQL server](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/).

Fork the repo from this link and clone this project into your desired folder.

```
git@github.com:[YOUR_USER]/full-stack-challenge.git
```

Install all the dependencies (we use `composer` and `npm`), both back and front. This can be done from the *root* of the project.

```
composer install
npm install
```

Once all the dependencies are ready, modify the *.env* and configure your database credentials.
In order to migrate and seed the database with some random data run this command.

```
php artisan migrate:fresh --seed
```

Run the development server and compile front-end assets with the following commands.

```
php artisan serve
npm run hot
```

Now you will have everything running so you can go ahead to `http://localhost:8000` and proceed with the code challenge.

## Exercises

This code challenge have three main parts. You don´t have to do all the exercises. The more you do, the better knowledge we will have about you.

### First exercise
We have a list of 15 tasks and we need to represent them as in a TodoApp. You are free to use any way to organize your components, styles, etc. You have to use `Vue` but you are free to use any kind of styles or UI Library. This project is ready to work with ES6/ES7 so feel free to use the last characteristics of JavaScript in your code.

The minimum structure has to be:

```
----------------------------------------
|                 HEADER               |
----------------------------------------
|                                      |
|   STATUS 1     STATUS 2    STATUS 3  |
|   --------     --------    --------  |
|  |  TASK  |   |  TASK  |  |  TASK |  |
|   --------     --------    --------  |
|                                      |
|   --------     --------    --------  |
|  |  TASK  |   |  TASK  |  |  TASK  | |
|   --------     --------    --------  |
|                                      |
----------------------------------------
|                 FOOTER               |
----------------------------------------
```

Each task should have its *title* and *description*. They need to be grouped by status in columns in order, and this columns may be draggables to reorder them.

### Second Exercise
We need to update, create and delete tasks. You will need to implement back and front functionality in order to achieve this goal.

We need to be able to:

* Delete an existing task
* Adding a new task
* Update data from task (title, description, status)
* Reorder columns content and the columns themselves

We will appreciate some of this extra functionalities:

* Change task status and reorder columns with drag&drop
* Be able to create new tasks without popups
* Be able to add new status dinamically

## Pieces of advice

We will love to receive your code, even if you are not interested in working with us!. We will like your app if:

* You follow clean coding practices
* You use git properly
* You think about the UX a little bit

Let us know if you have any question or feedback.

Hope to see your code soon!
