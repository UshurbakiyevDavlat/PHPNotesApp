<?php

use Config\Config;
use Database\Database;

$heading = 'Note';
$config = Config::getConfig();
$currentUserId = 1;
$method = $_SERVER['REQUEST_METHOD'];
$note_id = $method === 'POST' ? $_POST['id'] : $_GET['id'];

$note = getNote($config, $note_id);
checkIfNoteBelongsToUser($note, $currentUserId);

if ($method === 'POST') {
    deleteNote($config, $note_id);
    header('Location: /notes');
    exit;
}

return view('notes/show', compact('heading', 'note'));

function getNote($config, $id)
{
    $statement = 'SELECT * FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    return Database::execute($config, $statement, $queryParams)->findOrFail();
}

function deleteNote($config, $id): void
{
    $statement = 'DELETE FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    Database::execute($config, $statement, $queryParams);
}

function checkIfNoteBelongsToUser($note, $currentUserId): void
{
    authorize((int)$note['user_id'] !== $currentUserId);
}
