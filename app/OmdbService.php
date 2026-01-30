<?php

class OmdbService
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
}