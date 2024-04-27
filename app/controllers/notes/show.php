<?php

namespace App\Controller\Notes;

use Exception;
use NoteService;

$noteService = new NoteService();

$heading = 'Note';

$currentUserId = 1;
$note_id = $_GET['id'];

try {
    $note = $noteService->getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

$noteService->checkIfNoteBelongsToUser($note, $currentUserId);

return view('notes/show', compact('heading', 'note'));