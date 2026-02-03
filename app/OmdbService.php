<?php
require_once 'IMovies.php';
require_once 'MovieD.php';
final class OmdbService implements IMovies
{
    private const URL = 'https://www.omdbapi.com';
    private const API_KEY = 'eade8a29'; // Необходимо в будущем вынести в env для безопасности

    private array $data = [];

    /**
     * @throws Exception
     */
    public function find(string $search): self
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

        $this->data = $movies;

        return $this;
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

    /**
     * @return array<MovieD>
     */
    public function get(): array
    {
        $movies = [];
        foreach ($this->data as $item) {
            $movie = [];

            $movie['title'] = $item['Title'];
            $movie['year'] = (int) $item['Year'];
            $movie['type'] = $item['Type'];
            $movie['poster'] = $item['Poster'];
            $movie['genre'] = $item['Genre'];
            $movie['description'] = $item['Plot'];

            $movies[] = new MovieD(...$movie);
        }

        return $movies;
    }
}