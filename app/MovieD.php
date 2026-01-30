<?php

final readonly class MovieD
{
    public function __construct(
        public string $title,
        public int    $year,
        public string $type,
        public string $poster
    ) {}
}