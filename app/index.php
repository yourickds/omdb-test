<?php

require_once 'OmdbService.php';

function run(): array
{
    $service = new OmdbService();
    return $service->get();
}

header('Content-type: application/json');
var_dump(run());