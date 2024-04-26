<?php

namespace App\Controller\Notes;

use Core\App;
use Core\Database;
use Exception;

/**
 * Get note function
 *
 * @param int $id
 *
 * @return mixed
 * @throws Exception
 */
function getNote(int $id): mixed
{
    $statement = 'SELECT * FROM notes WHERE id = :id';
    $queryParams = [
        'id' => $id
    ];

    $db = App::resolve(Database::class);
    return $db->query($statement, $queryParams)->findOrFail();
}

/**
 * Check access function
 *
 * @param $note
 * @param $currentUserId
 *
 * @return void
 */
function checkIfNoteBelongsToUser($note, $currentUserId): void
{
    authorize((int)$note['user_id'] !== $currentUserId);
}

$heading = 'Note';

$currentUserId = 1;
$note_id = $_GET['id'];

try {
    $note = getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

checkIfNoteBelongsToUser($note, $currentUserId);

return view('notes/show', compact('heading', 'note'));