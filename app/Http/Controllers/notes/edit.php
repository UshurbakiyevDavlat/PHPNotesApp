<?php

use App\Services\AuthService;
use App\Services\NoteService;

$noteService = new NoteService();
$note_id = $_GET['id'];

try {
    $note = $noteService->getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

$currentUser = (new AuthService())->getAuthenticatedUser();
$noteService->checkIfNoteBelongsToUser($note, $currentUser['id']);

$body = $note['body'];

return view('notes/edit',
    [
        'note_id' => $note_id,
        'body' => $body,
    ],
);
