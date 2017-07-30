<?php

namespace AppBundle\ReviewUtil;


class SuperMemoCalculator
{

    public function calcInterval($repetition = 1, $eFactor = 2.5, $oldInterval = 1)
    {
        if ($repetition < 1) {
            throw new \Exception('The number of repetitions must be 1 or higher');
        }
        if ($repetition == 1) {
            $interval = 1;
        } elseif ($repetition == 2) {
            $interval = 6;
        } else {
            $interval = $oldInterval * $eFactor;
        }
        return ceil($interval);
    }

    public function calcNewEFactor($oldEFactor = 2.5, $quality = 4)
    {
        if ($quality > 5 || $quality < 0) {
            throw new \Exception('Quality must be between 0 and 5');
        }
        $newEFactor = $oldEFactor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
        return max($newEFactor, 1.3);
    }
}
