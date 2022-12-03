<?php

require 'functions.php';
require 'router.php';
require 'Database.php';
require 'Config.php';

$config = Config::env();

$statement = 'SELECT * FROM posts'; // write a sql query

$fetchOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
];

$db = new Database($config['database'], $statement, $fetchOptions);
$connection = $db->query();

$posts = $connection->fetchAll(); // fetching all results in associative array format

foreach ($posts as $post) {  // in loop getting post one by one
    echo '<li>' . $post['title'] . '</li>'; // printing post title by index
}