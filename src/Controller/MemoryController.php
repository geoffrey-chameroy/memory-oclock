<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemoryController
{
    public function play() {
        ob_start();
        require dirname(__DIR__) . '/../templates/memory.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    public function save() {
        return '<p>Hello</p>';
    }
}
