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

function render(array $collection = []): string
{
    ob_start();
    include 'view.php';
    return ob_get_clean();
}


header('Content-type: text/html; charset=utf-8');
echo render(run());