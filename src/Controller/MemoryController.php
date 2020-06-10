<?php declare(strict_types=1);

// Déclaration du namespace, norme PSR-4
namespace App\Controller;

// Déclarations des classes, utilisation de la norme PSR-4 pour le chargement des classes
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
        // Instancie le service dans l'instanciation de la classe
        // @todo: Faire une injection de dépendances
        $this->cardService = new CardService();
        // Instancie le manager dans l'instanciation de la classe
        // @todo: Faire une injection de dépendances
        $this->memoryManager = new MemoryManager();
    }

    /**
     * Affiche la page Jeu de mémoire avec la liste des cartes à jouer
     *
     * @return Response
     */
    public function play(): Response {
        // Récupère une liste de cartes en fonction du nombre de cartes demandées
        $cards = $this->cardService->getCards(self::NB_ELEMENT);

        // Récupère l'affichage du template et le place dans la variable $content
        ob_start();
        require dirname(__DIR__) . '/../templates/memory.php';
        $content = ob_get_clean();

        // Retourne une réponse "200 ok" (valeur par défaut) formatée en text/html
        return new Response($content);
    }

    /**
     * Sauvegarde le score du joueur
     *
     * @param Request $request La requête http
     * @return Response
     */
    public function save(Request $request): Response {
        // Récupère le nom depuis la requête POST
        $name = $request->request->get('name');
        // Vérifie que le nom est valide
        if (!$name || $name === '' || strlen($name) > 35) {
            // Retourne une réponse "400 bad parameters" formatée
            return new JsonResponse(['success' => false, 'error' => 'Nom invalide (Max 35 caractères).'], 400);
        }

        // Récupère le temps depuis la requête POST
        $time = (int) $request->request->get('time');
        // Vérifie que le temps est valide
        if (!$time || $time <= 0 || $time > 120) {
            // Retourne une réponse "400 bad parameters" formatée
            return new Response('Temps invalide (Doit être compris entre 1 et 120).', 400);
        }

        // Insertion du score dans la base de données
        $this->memoryManager->insertMemory($name, $time);

        // Retourne une réponse "200 ok" (valeur par défaut) formatée en JSON
        // La classe JsonResponse étend la classe Response
        return new JsonResponse(['success' => true]);
    }
}
