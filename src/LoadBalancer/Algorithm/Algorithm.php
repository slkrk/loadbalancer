<?php
namespace App\LoadBalancer\Algorithm;

use App\Host;

interface Algorithm
{

    public function balance(array & $hostList): Host;

}