<?php
require_once 'AMovies.php';
final class OmdbService extends AMovies
{
    private const URL = 'https://www.omdbapi.com';
    private const API_KEY = 'eade8a29'; // Необходимо в будущем вынести в env для безопасности
    public function __construct()
    {
        $this->setMapping([
            'title' => 'Title',
            'year' => 'Year',
            'type' => 'Type',
            'poster' => 'Poster',
            'genre' => 'Genre',
            'description' => 'Plot',
        ]);
    }

    /**
     * @throws Exception
     */
    public function get(string $search): array
    {
        $params = [
            'apikey' => self::API_KEY,
            's' => $search,
            'type' => 'movie',
            'page' => 1, // В будущем можно будет реализовать пагинацию. но на уровне внешнего сервиса
        ];

        $url = self::URL . '?' . http_build_query($params);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($res, true);
        if (empty($result['Search'])) {
            throw new Exception('Ничего не найдено');
        }
        $movies = [];
        // Пройдемся по всем фильма и получим жанр и описание
        // Я бы лучше вынес в отдельный fetch запрос, чтоб не делать 100+ запросов на страницу тем более не факт что каждую карточку тыкнут. Но надо будет сделать второй DTODetail расширяющий основной либо полностью независимый. Надо думать!
        foreach ($result['Search'] as $item) {
            $movies[] = $this->getInfoMovie($item['imdbID']);
        }

        return $movies;
    }

    private function getInfoMovie(string $id): array
    {
        $params = [
            'apikey' => self::API_KEY,
            'i' => $id,
        ];

        $url = self::URL . '?' . http_build_query($params);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res, true);
    }
}