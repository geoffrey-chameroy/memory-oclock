<?php

namespace App\Controller;

use App\Manager\MemoryManager;
use App\Service\CardService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemoryController
{
    const NB_ELEMENT = 14;

    private CardService $cardService;
    private MemoryManager $memoryManager;

    public function __construct()
    {
        $this->cardService = new CardService();
        $this->memoryManager = new MemoryManager();
    }

    public function play(): Response {
        $cards = $this->cardService->getCards(self::NB_ELEMENT);

        ob_start();
        require dirname(__DIR__) . '/../templates/memory.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    public function save(Request $request): Response {
        $name = $request->request->get('name');
        if (!$name || $name === '' || strlen($name) > 35) {
            return new JsonResponse(['success' => false, 'error' => 'Nom invalide (Max 35 caractères).'], 400);
        }

        $time = (int) $request->request->get('time');
        if (!$time || $time <= 0 || $time > 120) {
            return new Response('Temps invalide (Doit être compris entre 1 et 120).', 400);
        }

        $this->memoryManager->insertMemory($name, $time);

        return new JsonResponse(['success' => true]);
    }
}
