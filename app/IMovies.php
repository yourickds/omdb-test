<?php

interface IMovies
{
    public function find(string $search): self;

    /**
     * @return array<MovieD>
     */
    public function get(): array;
}