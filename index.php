<?php

require 'functions.php';
require 'router.php';

// connection to Mysql by PDO, will be refactored, but for first lesson let it go this way

$dsn = 'mysql:host=localhost;port=3306;dbname=php_native_lessons;charset=utf8mb4'; // data to connect for mysql

$username = 'root'; //username data

$pdo = new PDO($dsn,$username); // make an instance of pdo that connect us to mysql

$query = 'SELECT * FROM posts'; // write a sql query

$statement = $pdo->query($query); // prepare and execute query with help of pdo

$posts = $statement->fetchAll(PDO::FETCH_ASSOC); // fetching all results in associative array format

foreach ($posts as $post) {  // in loop getting post one by one
    echo '<li>' . $post['title'] . '</li>'; // printing post title by index
}