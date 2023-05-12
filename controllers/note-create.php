<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //TODO implement insertion to db
    dd($_POST);
}
require 'views/note-create.view.php';
