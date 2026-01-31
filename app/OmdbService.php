<?php
require_once 'MovieD.php';
require_once 'IMovies.php';
final class OmdbService implements IMovies
{
    public function get(): array
    {
        $url = "https://www.omdbapi.com/?apikey=eade8a29&s=die%20hard&type=movie&page=1";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res, true);
    }

    public function mapping(array $data): array
    {
        $result = [];

        foreach ($data['Search'] as $item) {
            $result[] = [
                'title' => $item['Title'],
                'year' => $item['Year'],
                'type' => $item['Type'],
                'poster' => $item['Poster'],
            ];
        }

        return $result;
    }

    public function getCollection(array $data): array
    {
        $movies = [];

        foreach ($data as $item) {
            $movies[] = new MovieD(
                $item['title'],
                $item['year'],
                $item['type'],
                $item['poster'],
            );
        }

        return $movies;
    }
}