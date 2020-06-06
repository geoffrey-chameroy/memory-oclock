<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemoryController
{
    const NB_ELEMENT = 14;
    private CardService $cardService;

    public function __construct()
    {
        $this->cardService = new CardService();
    }

    public function play(): Response {
        $cards = $this->cardService->getCards(self::NB_ELEMENT);

        ob_start();
        require dirname(__DIR__) . '/../templates/memory.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    public function save(Request $request): Response {
        return new Response('<p>Hello</p>');
    }
}
