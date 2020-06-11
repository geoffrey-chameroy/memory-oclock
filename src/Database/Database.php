<?php declare(strict_types=1);

namespace App\Database;

use PDO;

class Database
{
    private static $connection = null;

    // constructeur privé pour le pattern singleton : une classe = une instance
    private function __construct()
    {
    }

    /**
     * Récupère l'instance créée ou en retourne une nouvelle
     *
     * @return PDO Connection à la base de données
     */
    public static function getConnection(): PDO
    {
        // Si l'instance existe, on la retourne
        if (self::$connection) {
            return self::$connection;
        }

        // Création d'une connexion à la base de données
        // Les variables d'environnements peuvent être déclarées sur le serveur via la commande export
        // ou bien déclarées dans le fichier .env à la racine du projet
        self::$connection = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s',
                $_ENV['DATABASE_HOST'],
                $_ENV['DATABASE_NAME']
            ),
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
        );

        return self::getConnection();
    }
}
