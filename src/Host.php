<?php
namespace App;

interface Host extends RequestHandler
{

    public function getLoad(): float;

}