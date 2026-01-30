<?php

require_once 'OmdbService.php';

function run(): array
{
    $service = new OmdbService();
    $res = $service->get();
    $map = $service->mapping($res);
    return $service->getCollection($map);
}

header('Content-type: application/json');
var_dump(run());