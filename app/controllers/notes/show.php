<?php

use Config\Config;
use Database\Database;

/**
 * Get note function
 *
 * @param array $config
 * @param int $id
 *
 * @return mixed
 */
function getNote(array $config, int $id): mixed
{
    $statement = 'SELECT * FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    return Database::execute($config, $statement, $queryParams)->findOrFail();
}

/**
 * Check access function
 *
 * @param $note
 * @param $currentUserId
 * @return void
 */
function checkIfNoteBelongsToUser($note, $currentUserId): void
{
    authorize((int)$note['user_id'] !== $currentUserId);
}

$heading = 'Note';

$currentUserId = 1;
$note_id = $_GET['id'];

$note = getNote(Config::getConfig()['database'], $note_id);
checkIfNoteBelongsToUser($note, $currentUserId);

return view('notes/show', compact('heading', 'note'));