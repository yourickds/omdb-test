<?php
require_once 'MovieD.php';
abstract class AMovies implements IMovies
{
    private array $mapping;

    abstract public function get(string $search): array;

    public function setMapping(array $data): void
    {
        $this->mapping = $data;
    }

    /**
     * @return array<MovieD>
     */
    public function getCollection(array $data): array
    {
        $movies = [];

        foreach ($data as $item) {
            $movies[] = new MovieD(
                $this->getField('title', $item) ?? '',
                (int) $this->getField('year', $item) ?? '',
                $this->getField('type', $item) ?? '',
                $this->getField('poster', $item) ?? '',
                $this->getField('genre', $item) ?? '',
                $this->getField('description', $item) ?? '',
            );
        }

        return $movies;
    }

    protected function getField(string $name, array $item): mixed
    {
        if (empty($this->mapping[$name])) {
            return null;
        }

        if (empty($item[$this->mapping[$name]])) {
            return null;
        }

        return $item[$this->mapping[$name]];
    }
}