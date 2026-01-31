<?php

require_once 'Container.php';
require_once 'IMovies.php';
require_once 'OmdbService.php';

function run(): array
{
    // DI
    $container = new Container();
    $container->bind(IMovies::class, OmdbService::class);
    $service = $container->make(IMovies::class);

    $res = $service->get();
    return $service->getCollection($res);
}

header('Content-type: application/json');
echo json_encode(run());