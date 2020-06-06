<?php declare(strict_types=1);

namespace App\Service;

class CardService
{
    private const NB_MAX_ELEMENTS = 18;

    public function getCards(int $nbElement): array
    {
        // prevent error on max value
        if ($nbElement > self::NB_MAX_ELEMENTS) {
            $nbElement = self::NB_MAX_ELEMENTS;
        }

        // select a deck of cards from available
        $deck = $this->selectDeck($nbElement);

        // put 2 cards of each
        $cards = array_merge($deck, $deck);

        // shuffle all cards to render it
        shuffle($cards);

        return $cards;
    }

    private function selectDeck(int $nbElement): array
    {
        // create array with available cards and shuffle
        $deck = range(0, self::NB_MAX_ELEMENTS - 1, 1);
        shuffle($deck);

        // return the $nbElement first cards
        return array_slice($deck, 0, $nbElement);
    }
}
