<?php

namespace App\LoadBalancer\Algorithm;

use App\Host;
use PHPUnit\Framework\TestCase;

class RotationTest extends TestCase
{
    public function testBalance()
    {
        $rotation = new Rotation();
        for ($hostQuantity = 1; $hostQuantity < 7; $hostQuantity++) {
            $hostListStub = [];
            for ($i = 0; $i < $hostQuantity; $i++) {
                $hostStub = $this->createMock(Host::class);
                $hostStub->id = $i;
                $hostListStub[] = $hostStub;
            }
            for ($i = 1; $i < 33; $i++) {
                $host = $rotation->balance($hostListStub);
                $this->assertEquals(($i % $hostQuantity), $host->id);
            }
        }
    }
    
}
