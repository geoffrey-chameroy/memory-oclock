<?php declare(strict_types=1);

namespace App\Manager;

use App\Database\Database;
use App\Model\Memory;
use PDO;

class MemoryManager
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getHallOfFameList(int $limit)
    {
        $query = sprintf('SELECT id, name, time, created_at FROM memory ORDER BY time ASC Limit 0, %d', $limit);

        return $this->connection->query($query, PDO::FETCH_CLASS, Memory::class);
    }

    public function insertMemory(string $name, int $time)
    {
        // Secure inputs from sql injection
        $name = $this->connection->quote($name, PDO::PARAM_STR);
        $query = sprintf('INSERT INTO memory (name, time) VALUES (%s, %d)', $name, $time);

        return $this->connection->query($query);
    }
}
