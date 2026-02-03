<?php

require_once 'Container.php';
require_once 'IMovies.php';
require_once 'OmdbService.php';

function run(string $search): array
{
    // DI
    $container = new Container();
    $container->bind(IMovies::class, OmdbService::class);
    $service = $container->make(IMovies::class);

    try {
        return $service->find($search)->get();
    } catch (Exception $e) {
        echo render(error: $e->getMessage());
        exit;
    }
}

function render(array $collection = [], string $error = null): string
{
    ob_start();
    include 'view.php';
    return ob_get_clean();
}

header('Content-type: text/html; charset=utf-8');

if (empty($_GET['search'])) {
    echo render();
} else {
    echo render(run($_GET['search']));
}