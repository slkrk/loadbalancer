<?php

namespace App\LoadBalancer\Algorithm;

use App\Host;
use PHPUnit\Framework\TestCase;

class LoadAwareTest extends TestCase
{

    public function testBalance()
    {
        $loadAware = new LoadAware();

        $loads = [0.99, 0.75, 0.78, 0.99, 1.0, 0.76, 0.75, 0.86, 1.0, 0.4, 0.2, 0.3, 0.5, 0.77];

        $hostListStub = [];
        foreach ($loads as $load) {
            $hostStub = $this->createMock(Host::class);
            $hostStub->method("getLoad")->willReturn($load);
            $hostStub->load = $load;
            $hostListStub[] = $hostStub;
        }

        $host = $loadAware->balance($hostListStub);
        $this->assertEquals(0.4, $host->load);

        for ($i = 0; $i < 10; $i++) {
            shuffle($hostListStub);
            $host = $loadAware->balance($hostListStub);
            $this->assertLessThan(LoadAware::BORDER_LOAD, $host->load);
        }

        $loads = [0.96, 0.79, 0.78, 0.99, 1.0, 0.76, LoadAware::BORDER_LOAD, 0.86, 1.0, 0.94, 0.92, 0.93, 0.95, 0.77];

        $hostListStub = [];
        foreach ($loads as $load) {
            $hostStub = $this->createMock(Host::class);
            $hostStub->method("getLoad")->willReturn($load);
            $hostStub->load = $load;
            $hostListStub[] = $hostStub;
        }

        for ($i = 0; $i < 10; $i++) {
            shuffle($hostListStub);
            $host = $loadAware->balance($hostListStub);
            $this->assertEquals(min($loads), $host->load);
        }
    }

}
