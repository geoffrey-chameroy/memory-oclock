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
        $deck = [];
        // create array with all cards
        for ($i = 0; $i < self::NB_MAX_ELEMENTS; ++$i) {
            $deck[] = $i;
        }
        // shuffle cards
        shuffle($deck);

        // return the first cards
        return array_slice($deck, 0, $nbElement);
    }
}
