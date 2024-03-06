<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Model\Entity\Move;

interface StrategyInterface
{
    public function move(Move $move): string;
}
