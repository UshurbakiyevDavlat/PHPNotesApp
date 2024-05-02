<?php

namespace App\Controller\Notes;

use App\Services\AuthService;
use Exception;
use App\Services\NoteService;

$noteService = new NoteService();

$heading = 'Note';

$currentUser = (new AuthService())->getAuthenticatedUser();
$note_id = $_GET['id'];

try {
    $note = $noteService->getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

$noteService->checkIfNoteBelongsToUser($note, $currentUser['id']);

return view('notes/show', compact('heading', 'note'));