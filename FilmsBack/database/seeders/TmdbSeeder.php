<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TmdbSeeder extends Seeder
{
    public function run()
    {
        $apiKey = env('TMDB_API_KEY');

        if (!$apiKey) {
            $this->command->error('ERRORE: TMDB_API_KEY non trovata nel file .env');
            return;
        }

        $this->command->info('Inizio importazione da TMDB...');

        // Determina se usare Bearer Token o API Key query param
        // I token JWT (Bearer) contengono punti e sono molto lunghi
        $isBearer = str_contains($apiKey, 'ey');

        // Setup Client
        $http = Http::acceptJson()->withoutVerifying();  // Disabilita verifica SSL per ambiente locale windows
        if ($isBearer) {
            $http->withToken($apiKey);
            $queryParams = ['language' => 'it-IT'];
        } else {
            $queryParams = ['api_key' => $apiKey, 'language' => 'it-IT'];
        }

        // 1. Scarica e Salva i Generi
        $this->command->info('Scaricamento generi...');
        $genresResponse = $http->get('https://api.themoviedb.org/3/genre/movie/list', $queryParams);

        if ($genresResponse->failed()) {
            $this->command->error('Errore chiamata Generi: ' . $genresResponse->body());
            return;
        }

        $tmdbGenres = $genresResponse->json()['genres'] ?? [];
        $genreMap   = [];  // Mappa ID TMDB -> ID Database Locale

        foreach ($tmdbGenres as $g) {
            $localGenre         = Genre::firstOrCreate(
                ['name' => $g['name']],
                ['color' => '#' . substr(md5($g['name']), 0, 6)]  // Colore esadecimale generato dal nome
            );
            $genreMap[$g['id']] = $localGenre->id;
        }
        $this->command->info('Generi importati: ' . count($genreMap));

        // 2. Scarica e Salva i Film Popolari (Prime 5 pagine per averne un po')
        $this->command->info('Scaricamento film popolari...');

        // Il regista richiede surname e nationality, li forniamo nel secondo array (valori di default alla creazione)
        $defaultDirector = Director::firstOrCreate(
            ['name' => 'TMDB Import'],
            [
                'surname'     => 'System',
                'nationality' => 'International'
            ]
        );

        $filmsCount = 0;

        for ($page = 1; $page <= 5; $page++) {
            $queryParams['page'] = $page;
            $response            = $http->get('https://api.themoviedb.org/3/movie/popular', $queryParams);

            if ($response->failed()) {
                $this->command->error("Errore scaricamento pagina $page");
                continue;
            }

            $results = $response->json()['results'] ?? [];

            foreach ($results as $movie) {
                // Salta se esiste già
                if (Film::where('title', $movie['title'])->exists())
                    continue;

                $description = $movie['overview'] ?: 'Descrizione non disponibile';

                $newFilm = Film::create([
                    'title'        => $movie['title'],
                    'description'  => $description,
                    // Salva URL completo del poster
                    'poster'       => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : null,
                    'trailer'      => null,
                    'release_date' => $movie['release_date'] ?: now(),
                    'rating'       => isset($movie['vote_average']) ? round($movie['vote_average']) : 0,
                    'cast'         => 'Cast importato da TMDB',
                    'director_id'  => $defaultDirector->id
                ]);

                // Associa i generi
                if (isset($movie['genre_ids'])) {
                    $syncIds = [];
                    foreach ($movie['genre_ids'] as $tmdbId) {
                        if (isset($genreMap[$tmdbId])) {
                            $syncIds[] = $genreMap[$tmdbId];
                        }
                    }
                    $newFilm->genres()->sync($syncIds);
                }
                $filmsCount++;
            }
            $this->command->info("Pagina $page completata.");
        }

        $this->command->info("Importazione completata! Nuovi film inseriti: $filmsCount");
    }
}
