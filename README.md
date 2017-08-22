ZendFrameWork Alura Project
=======================

Introduction
------------
This is my application from a course in alura, in there I do connection with a  mysql data base using a Doctrine, created a module called Produtos and a validation auth.


Installation
------------
clone this repository, in root folder call the php Server
```sh
 php -S localhost:8080
```
The mysql run in localhost, so you don't need login and password, create this db:

> zendtestloja

Create a file in the folder config/autoload/ with the name doctrine.local.php
Inside of the file, put de code below


```sh
<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'zendtestloja',
                )))));

```



Open your bash, go to the root folder and run this command:
```sh
./vendor/bin/doctrine-module orm:schema-tool:update --force
```
If all go well go to your mysql and you'll see the tables in your db

In your table suario, create a new user with a password with md5 crypt, below, the commando to do this.
```sh
INSERT INTO usuario(email,senha) VALUES ('youremail@email.com',MD5(123456));
```
After you do all this things above, you can go for your browser and open this url 'http://localhost:8080'
the login screen will appear and you can enjoy the app




Thanks 

Waldir Bertuqui















