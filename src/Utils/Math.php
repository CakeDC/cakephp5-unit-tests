<?php
declare(strict_types=1);

namespace App\Utils;

/**
 * Class Math
 *
 * @package App\Utils
 */
class Math
{
    /**
     * Calculate percentage
     *
     * @param int $successful
     * @param int $failed
     * @return int rounded percentage
     * @throws \OutOfBoundsException
     */
    public static function roundedPercentage(int $successful, int $failed): float
    {
        if ($successful < 0 || $failed < 0) {
            throw new \OutOfBoundsException('Won and lost must not be < 0');
        }
        $total = $successful + $failed;
        if ($total === 0) {
            return 0;
        }

        return round($successful / $total * 100);
    }
}
