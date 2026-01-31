<?php
require_once 'AMovies.php';
final class OmdbService extends AMovies
{
    public function __construct()
    {
        $this->setMapping([
            'title' => 'Title',
            'year' => 'Year',
            'type' => 'Type',
            'poster' => 'Poster',
        ]);
    }

    public function get(): array
    {
        $url = "https://www.omdbapi.com/?apikey=eade8a29&s=die%20hard&type=movie&page=1";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($res, true);
        return $result['Search'];
    }
}