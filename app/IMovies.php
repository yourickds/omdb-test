<?php

interface IMovies
{
    public function get(): array;

    public function mapping(array $data): array;

    public function getCollection(array $data): array;
}