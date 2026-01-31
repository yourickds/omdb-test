<?php

interface IMovies
{
    public function get(): array;

    public function setMapping(array $data): void;

    public function getCollection(array $data): array;
}