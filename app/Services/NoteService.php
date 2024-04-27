<?php

declare(strict_types=1);

use Core\App;
use Core\Database;

class NoteService
{
    /**
     * Get note method
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function getNote(int $id): mixed
    {
        $statement = 'SELECT * FROM notes WHERE id = :id';
        $queryParams = [
            'id' => $id
        ];

        $db = App::resolve(Database::class);
        return $db->query($statement, $queryParams)->findOrFail();
    }

    /**
     * Check access method
     *
     * @param $note
     * @param $currentUserId
     *
     * @return void
     */
    public function checkIfNoteBelongsToUser($note, $currentUserId): void
    {
        authorize((int)$note['user_id'] !== $currentUserId);
    }
}