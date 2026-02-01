<?php

interface IMovies
{
    public function get(): array;

    public function setMapping(array $data): void;

    /**
     * @return array<MovieD>
     */
    public function getCollection(array $data): array;
}