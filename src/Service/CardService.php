<?php declare(strict_types=1);

namespace App\Service;

class CardService
{
    public function getCards(int $nbElement): array
    {
        $cards = [];
        for ($i = 0; $i < $nbElement; ++$i) {
            // put 2 identical cards
            $cards[] = $i;
            $cards[] = $i;
        }
        shuffle($cards);

        return $cards;
    }
}
