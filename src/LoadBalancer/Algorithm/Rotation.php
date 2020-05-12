<?php

namespace App\LoadBalancer\Algorithm;

use App\Host;

class Rotation implements Algorithm
{

    public function balance(array &$hostList): Host
    {
        next($hostList);
        if (key($hostList) === null) {
            reset($hostList);
        }
        return current($hostList);
    }

}