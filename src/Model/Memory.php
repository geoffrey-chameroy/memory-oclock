<?php declare(strict_types=1);

namespace App\Model;

use DateTime;

class Memory
{
    public int $id;
    public string $name;
    public int $time;
    public DateTime $created_at;
}
