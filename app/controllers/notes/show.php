<?php

use Config\Config;
use Database\Database;

function getNote($config, $id)
{
    $statement = 'SELECT * FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    return Database::execute($config, $statement, $queryParams)->findOrFail();
}

function checkIfNoteBelongsToUser($note, $currentUserId): void
{
    authorize((int)$note['user_id'] !== $currentUserId);
}

$heading = 'Note';
$config = Config::getConfig();

$currentUserId = 1;
$method = $_SERVER['REQUEST_METHOD'];
$note_id = $_GET['id'];

$note = getNote($config, $note_id);
checkIfNoteBelongsToUser($note, $currentUserId);

return view('notes/show', compact('heading', 'note'));