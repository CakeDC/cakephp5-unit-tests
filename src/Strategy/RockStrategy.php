<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Model\Entity\Move;

class RockStrategy implements StrategyInterface
{
    public function move(Move $move): string
    {
        return 'R';
    }
}
