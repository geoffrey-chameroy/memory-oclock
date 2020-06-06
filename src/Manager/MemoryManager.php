<?php declare(strict_types=1);

namespace App\Manager;

use App\Database\Database;
use App\Model\Memory;
use PDO;

class MemoryManager
{
    public function getHallOfFameList(int $limit) {
        $connection = Database::getConnection();
        $query = sprintf('SELECT id, name, time, created_at FROM memory ORDER BY time ASC Limit 0, %d', $limit);

        return $connection->query($query, PDO::FETCH_CLASS, Memory::class);
    }
}
