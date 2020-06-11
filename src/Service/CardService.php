<?php declare(strict_types=1);

namespace App\Service;

class CardService
{
    private const NB_MAX_ELEMENTS = 18;

    /**
     * Créé une liste de cartes en fonction du nombre de cartes demandées
     *
     * @param int $nbElement Nombre de cartes demandées
     * @return array Liste de cartes
     */
    public function getCards(int $nbElement): array
    {
        // Si le nombre demandé est supérieur au nombre possible, on modifie le nombre d'éléments demandés
        if ($nbElement > self::NB_MAX_ELEMENTS) {
            $nbElement = self::NB_MAX_ELEMENTS;
        }

        // Créé une sélection de cartes avec celles disponibles
        $deck = $this->selectDeck($nbElement);

        // On place 2 cartes de chaque
        $cards = array_merge($deck, $deck);

        // On mélange toutes les cartes
        shuffle($cards);

        // On retourne la liste de cartes mélangées
        return $cards;
    }

    /**
     * Crée une sélection de cartes avec celles disponibles
     *
     * @param int $nbElement Nombre de cartes demandées
     * @return array Sélection de cartes
     */
    private function selectDeck(int $nbElement): array
    {
        // Création d'un tableau avec les toutes cartes disponibles
        $deck = range(0, self::NB_MAX_ELEMENTS - 1, 1);
        // On mélange toutes les cartes
        shuffle($deck);

        // On retourne le nombre de cartes en fonction du nombre d'éléments demandés
        return array_slice($deck, 0, $nbElement);
    }
}
