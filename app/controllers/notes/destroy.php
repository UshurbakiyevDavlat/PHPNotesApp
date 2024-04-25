<?php

use Config\Config;
use Database\Database;

/**
 * Delete note function
 *
 * @param array $config
 * @param int $id
 * @return void
 */
function deleteNote(array $config, int $id): void
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