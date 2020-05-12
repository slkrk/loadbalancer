<?php

namespace App;

use App\LoadBalancer\Algorithm\Algorithm;

class LoadBalancer implements RequestHandler
{

    private Algorithm $algorithm;

    /**
     * @var Host[]
     */
    private array $hostList;

    public function __construct(array $hostList, Algorithm $algorithm)
    {
        if (empty($hostList)) {
            throw new \InvalidArgumentException(
                "First argument of LoadBalancer::__construct() must contain at least one Host."
            );
        }
        array_map($this->getHostListTypeValidationCallback(), $hostList);
        $this->hostList = $hostList;
        $this->algorithm = $algorithm;
    }

    public function handleRequest(Request $request)
    {
        $host = $this->algorithm->balance($this->hostList);
        $host->handleRequest($request);
    }

    private function getHostListTypeValidationCallback()
    {
        return function ($host) {
            if (!$host instanceof Host) {
                throw new \InvalidArgumentException(
                    "First argument of LoadBalancer::__construct() " .
                    "must be array containing elements of type \App\Host."
                );
            }
        };
    }

}