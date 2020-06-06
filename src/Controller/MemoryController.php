<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemoryController
{
    public function play(): Response {
        ob_start();
        require dirname(__DIR__) . '/../templates/memory.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    public function save(Request $request): Response {
        return new Response('<p>Hello</p>');
    }
}
