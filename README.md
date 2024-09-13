## About Custom CV

The idea was to make a CV webapp that can be modified at any given time.
In this README file we'll brake down the code arhitecture.

## .htaccess FILE

- designed to manage URL routing and resource handling for this PHP application.
- makes "public" directory is used as the web root.

## config/app.php 

- defines important constants that the application can reference throughout its lifecycle.
- these constants include paths, database settings, and application-specific information.

## app DIRECTORY

- consists of custom controllers, models, middlewares and views
- each directory has a base file (controller.php, model.php, etc.)
- ## controller.php
- base controller class provides common methods that other controllers can extend or use.
- includes methods for rendering views, getting request data (typically from form submissions), and redirecting the user to different URLs.
- ## middleware/auth.php
- middleware class that manages authentication in this application.
- handles tasks that occur before or after the main logic of a request.
- middleware handles whether a user is logged in or not and redirects them accordingly.
- ## model.php
- this class serves as the foundation for other models such as User model which interacts with the database.
- ## Database.php
- singleton class that handles database operations using PDO
- designed to provide a fluent interface for querying a database, making it easy to perform common SQL tasks like selecting, inserting, and filtering data.

## ROUTING

- Router.php implements a singleton-based router class for handling HTTP requests and dispatching them to the appropriate controller and action.
- Facades/Route.php file simplifies access to the Router class.
- provides a cleaner, static interface for defining and dispatching routes within application.
- routes/web.php file is responsible for defining the routes that handle different HTTP requests and map them to specific controllers and methods.

## ENTRY POINT

- index.php file is the front controller for this PHP application.
- entry point for handling all incoming requests in an MVC arhitecture
- delegates control to the appropriate parts of the application, such as routing, controllers, and models.

## DISCLAIMER

This web app is still a work in progress; not all functionalities are up and running yet.

## HOW TO INSTALL

- clone repository: https://github.com/J3D1337/Custom-CV-App.git
- create database: CREATE DATABASE IF NOT EXISTS cv;<br>

USE cv;<br>

CREATE TABLE IF NOT EXISTS users (<br>
	id INT AUTO_INCREMENT PRIMARY KEY,<br>
    email VARCHAR(255) NOT NULL UNIQUE,<br>
    password VARCHAR(255) NOT NULL,<br>
    is_admin BOOLEAN NOT NULL DEFAULT FALSE<br>
);<br>
<br>

CREATE TABLE IF NOT EXISTS texts (<br>
    id INT AUTO_INCREMENT PRIMARY KEY,<br>
    text_name VARCHAR(255) NOT NULL,<br>
    content TEXT NOT NULL,<br>
    user_id INT,<br>
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,<br>
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,<br>
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE<br>
);<br>
<br>
CREATE TABLE IF NOT EXISTS images (<br>
    id INT AUTO_INCREMENT PRIMARY KEY,<br>
    content LONGBLOB NOT NULL,<br>
    user_id INT,<br>
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE<br>
);<br>
<br>
ALTER TABLE texts ADD COLUMN type ENUM('h2', 'h5', 'p') NOT NULL;<br>

- run composer install
- in composer.json, set pst-4 App:// to app/
