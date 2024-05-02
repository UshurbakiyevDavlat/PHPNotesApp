<?php

declare(strict_types=1);

namespace App\Services;

use app\Core\App;
use app\Core\Database;
use Exception;

class NoteService
{
    /**
     * Get note method
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function getNote(int $id): array
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
     * @param array $note
     * @param int $currentUserId
     *
     * @return void
     */
    public function checkIfNoteBelongsToUser(array $note, int $currentUserId): void
    {
        authorize((int)$note['user_id'] !== $currentUserId);
    }
}