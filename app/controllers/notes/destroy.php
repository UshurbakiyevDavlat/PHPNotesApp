<?php

use Core\App;
use Core\Database;

/**
 * Delete note function
 *
 * @param int $id
 * @return void
 * @throws Exception
 */
function deleteNote(int $id): void
{
    $statement = 'DELETE FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    $db = App::resolve(Database::class);
    $db->query($statement, $queryParams);
}

$note_id = $_POST['id'];

try {
    deleteNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}
header('Location: /notes');
exit;