<?php

use Config\Config;
use Database\Database;

/**
 * Delete note function
 *
 * @param array $config
 * @param int $id
 * @return void
 * @throws Exception
 */
function deleteNote(array $config, int $id): void
{
    $statement = 'DELETE FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    Database::execute($config, $statement, $queryParams);
}

$note_id = $_POST['id'];

try {
    deleteNote(Config::getConfig()['database'], $note_id);
} catch (Exception $e) {
    die($e->getMessage());
}
header('Location: /notes');
exit;