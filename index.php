<?php

require 'functions.php';
require 'router.php';
require 'Database.php';

$query = 'SELECT * FROM posts'; // write a sql query

$db = new Database($query);
$connection = $db->query();

$posts = $connection->fetchAll(PDO::FETCH_ASSOC); // fetching all results in associative array format

foreach ($posts as $post) {  // in loop getting post one by one
    echo '<li>' . $post['title'] . '</li>'; // printing post title by index
}