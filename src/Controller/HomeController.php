<?php declare(strict_types=1);

// Déclaration du namespace, norme PSR-4
namespace App\Controller;

// Déclarations des classes, utilisation de la norme PSR-4 pour le chargement des classes
use App\Manager\MemoryManager;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    private const LIMIT_HALL_OF_FAME = 5;
    private MemoryManager $memoryManager;

    public function __construct()
    {
        // Instancie le manager dans l'instanciation de la classe
        // @todo: Faire une injection de dépendances
        $this->memoryManager = new MemoryManager();
    }

    /**
     * Affiche la page d'accueil avec le tableau des scores
     *
     * @return Response
     */
    public function home(): Response {
        // Récupère la liste des 5 meilleurs scores depuis la base de données
        $memories = $this->memoryManager->getHallOfFameList(self::LIMIT_HALL_OF_FAME);

        // Récupère l'affichage du template et le place dans la variable $content
        ob_start();
        require dirname(__DIR__) . '/../templates/home.php';
        $content = ob_get_clean();

        // Retourne une réponse "200 ok" (valeur par défaut) formatée en text/html
        return new Response($content);
    }
}
