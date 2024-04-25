<?php

use Config\Config;
use Database\Database;

function deleteNote($config, $id): void
{
    $statement = 'DELETE FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    Database::execute($config, $statement, $queryParams);
}

$config = Config::getConfig();
$note_id = $_POST['id'];

deleteNote($config, $note_id);
header('Location: /notes');
exit;