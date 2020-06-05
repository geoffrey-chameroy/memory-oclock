<?php

namespace App\Controller;

ini_set('display_errors', true);

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function home() {
        ob_start();
        require dirname(__DIR__) . '/../templates/home.php';
        $content = ob_get_clean();

        return new Response($content);
    }
}
