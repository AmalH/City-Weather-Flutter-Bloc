# Nth Fibonacci Number as a Restful API

This repo presents **a simple php implementation** of the nth fibonacci number problem.
It **exposes this implementation as a consumable REST endpoint**.

The repo also mocks a very **basic cruds system** around the FibonacciSet entity. (a FibonacciSet is: {a number, its nth fibonacci number})

As an example of **securing a REST endpoint**, this repo uses the **[Magic Admin PHP SDK](https://github.com/magiclabs/magic-admin-php)**
 to disable unauthorized users from consuming some endpoints.

## Prerequisites

- [PHP](https://www.php.net/downloads.php)
- [MySQL](https://www.mysql.com/downloads/)
- [Composer](http://getcomposer.org/)
- [Magic Admin PHP SDK](https://github.com/magiclabs/magic-admin-php)
- [Postman](https://www.postman.com/downloads/)

## Configuring the application

- ### Creating a MySQL database and user for the project.

```php
CREATE DATABASE fibonacci_task CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
...
...
```

- ### Creating the `fibonacci_sets` table

```php
CREATE TABLE `fibonacci_sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `nthFibOfNumber` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
```

<p align="center">
<img src="https://raw.githubusercontent.com/AmalH/FibonacciTask/master/readmeScreenshots/database.png"/>
</p>

- ### Setting up a Magic Admin PHP SDK account and extracting the API key and secret values

<p align="center">
<img src="https://raw.githubusercontent.com/AmalH/FibonacciTask/master/readmeScreenshots/magic_dashboard.png"/>
</p>

- ### Setting up the `.env` file and entering the database and the Magic SDK secret key.
- ### Running the PHP server to use and test the API
 
```php
php -S localhost:8000 -t fibonacci_api
```

## API Endpoints

| Endpoint               |    CRUD    |                                Description |
| :---------------- | :--------:      | -----------------------------------------: |
| GET /fibonaccisets        |    **READ**  |        Get all the number/fibonacciNumber sets from `fibonacci_sets` table |
| GET /fibonacciset/{number}    |  **READ**  |        Get a single FibonacciSet ( number/fibonacciNumber set ) from `fibonacci_sets` table |
| POST /fibonacciset        | **CREATE** | Create a FibonacciSet and insert from `fibonacci_sets` table |
| PUT /fibonacciset/{id}    | **UPDATE** |            Update the FibonacciSet from `fibonacci_sets` table |
| DELETE /fibonacciset/{id} | **DELETE** |            Delete a FibonacciSet from `fibonacci_sets` table |

### Testing the endpoints using [Postman](https://www.postman.com/)

This step required getting the authentication token to test a bearer token authaurization on Postman for the secured endpoints, as well as testing the publicly accessible endpoints.

Below are a few screenshots of the final result:

- ### GET /fibonacciSet/9 : get nth fibonnacci number of 9

If no corresponding number/nthFib entry exists, we calulate the nth fibonacci of n using the helper class **[NthFibonacciCalculator](https://github.com/AmalH/FibonacciTask/src/Helpers/NthFibonacciCalculator.php)** and add a new entry to our database

<p align="center">
<img src="https://raw.githubusercontent.com/AmalH/FibonacciTask/master/readmeScreenshots/get_fibonacci_of_9.png"/>
</p>

- ### POST /fibonacciSet

<p align="center">
<img src="https://raw.githubusercontent.com/AmalH/FibonacciTask/master/readmeScreenshots/post_fibonacciSet.png"/>
</p>

- ### PUT /fibonacciSet/ : 

let's update the nth fibonnaci of 9 that we added with the GET method to a wrong value !

<p align="center">
<img src="https://raw.githubusercontent.com/AmalH/FibonacciTask/master/readmeScreenshots/update_fibonacci_of_9.png"/>
</p>

## Project structure and code details

Structuring this sample project as it is (fibonacci_api / src-Controller / src-Entity / src-Helpers / src-Repository), as well as specific code details can be discussed and explained in further communications.