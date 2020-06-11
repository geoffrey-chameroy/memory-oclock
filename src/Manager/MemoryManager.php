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
        // Récupère la connection à la base de données
        $this->connection = Database::getConnection();
    }

    /**
     * Récupère la liste des meilleurs scores
     *
     * @param int $limit Le nombre de scores souhaités
     * @return false|\PDOStatement La liste des scores au format PDOStatement
     */
    public function getHallOfFameList(int $limit)
    {
        // Requête SQL
        // On sécurise la variable $limit à l'aide du sprintf
        // le %d du sprintf permet d'insérer un entier comme valeur dans la chaîne
        $query = sprintf('SELECT id, name, time, created_at FROM memory ORDER BY time ASC Limit 0, %d', $limit);

        // le mode PDO:FETCH_CLASS permet de transformer le résultat de la requête SQL en collection d'objets
        return $this->connection->query($query, PDO::FETCH_CLASS, Memory::class);
    }

    /**
     * Insère un score en base de données
     *
     * @param string $name Le nom du participant
     * @param int $time Le temps de la partie
     * @return false|\PDOStatement Le résultat de la requête
     */
    public function insertMemory(string $name, int $time)
    {
        // On sécurise le nom avec la méthode ->quote pour éviter les injections SQL
        $name = $this->connection->quote($name, PDO::PARAM_STR);
        // On sécurise la variable $limit à l'aide du sprintf
        // le %d du sprintf permet d'insérer un entier comme valeur dans la chaîne
        // le %s permet d'insérer une chaîne de caractères
        $query = sprintf('INSERT INTO memory (name, time) VALUES (%s, %d)', $name, $time);

        // On retourne le résultat de la requête
        return $this->connection->query($query);
    }
}
