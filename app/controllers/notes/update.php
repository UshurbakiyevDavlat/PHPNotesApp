<?php

use Core\App;
use Core\Database;
use Core\Validator;

$noteService = new NoteService();
$body = $_POST['body'];
$note_id = $_POST['id'];

try {
    $note = $noteService->getNote($note_id);
} catch (Exception $e) {
    die($e->getMessage());
}

$currentUserId = 1;
$noteService->checkIfNoteBelongsToUser($note, $currentUserId);

$result = null;
$errors = Validator::string($body, 10, 1000);
$statement = 'UPDATE notes SET body = :body WHERE id = :id';
$query_params = [
    'body' => $body,
    'id' => $note_id
];

if (empty($errors['errors'])) {
    try {
        $db = App::resolve(Database::class);
        $db->query($statement, $query_params);
        $result = 'Note updated successfully.';
    } catch (Exception|PDOException $e) {
        die($e->getMessage());
    }

}

return view('notes/edit', compact('errors', 'body', 'result', 'note_id'));