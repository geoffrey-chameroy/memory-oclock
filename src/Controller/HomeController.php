<?php

namespace App\Controller;

ini_set('display_errors', true);

use App\Manager\MemoryManager;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    private const LIMIT_HALL_OF_FAME = 5;

    /** @var MemoryManager */
    private $memoryManager;

    public function __construct()
    {
        $this->memoryManager = new MemoryManager();
    }

    public function home(): Response {
        $memories = $this->memoryManager->getHallOfFameList(self::LIMIT_HALL_OF_FAME);

        ob_start();
        require dirname(__DIR__) . '/../templates/home.php';
        $content = ob_get_clean();

        return new Response($content);
    }
}
