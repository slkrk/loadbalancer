<?php
namespace App;

interface RequestHandler
{
    public function handleRequest(Request $request);
}