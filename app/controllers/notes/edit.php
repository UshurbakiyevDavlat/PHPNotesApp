<?php

$noteService = new NoteService();
$note_id = $_GET['id'];

try {
    $note = $noteService->getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

$body = $note['body'];

return view('notes/edit',
    [
        'note_id' => $note_id,
        'body' => $body,
    ],
);
