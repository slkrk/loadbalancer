<?php

namespace App\LoadBalancer\Algorithm;

use App\Host;

class LoadAware implements Algorithm
{

    const BORDER_LOAD = 0.75;

    public function balance(array &$hostList): Host
    {
        $lowestLoad = null;
        $hostWithLowestLoad = null;
        /**
         * @var Host $host
         */
        foreach ($hostList as $host) {
            if ($host->getLoad() < self::BORDER_LOAD) {
                return $host;
            }
            if ($lowestLoad === null || $lowestLoad > $host->getLoad()) {
                $lowestLoad = $host->getLoad();
                $hostWithLowestLoad = $host;
            }
        }
        return $hostWithLowestLoad;
    }
}