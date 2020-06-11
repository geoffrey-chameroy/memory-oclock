<?php declare(strict_types=1);

namespace App\Model;

/**
 * Class Memory
 * Représente le modèle en base de données de la table memory
 */
class Memory
{
    public int $id;
    public string $name;
    public int $time;
    public string $created_at;
}
