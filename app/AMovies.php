<?php
require_once 'MovieD.php';
abstract class AMovies implements IMovies
{
    private array $mapping;

    abstract public function get(): array;

    public function setMapping(array $data): void
    {
        $this->mapping = $data;
    }

    public function getCollection(array $data): array
    {
        $movies = [];

        foreach ($data as $item) {
            $movies[] = new MovieD(
                $item[$this->mapping['title']],
                $item[$this->mapping['year']],
                $item[$this->mapping['type']],
                $item[$this->mapping['poster']],
            );
        }

        return $movies;
    }
}