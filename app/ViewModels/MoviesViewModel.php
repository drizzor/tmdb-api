<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    /**
     * Formatage des films populaires
     */
    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    /**
     * Formatage de la catégorie now playing
     */
    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    /**
     * Reformatage des genres afin d'avoir un tableau retournant en clé l'id du genre et en valeur le nom du genre
     * 'id_genre' => 'name_genre' soit '28' => 'Action'
     */
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * Méthode de formatage des données brut pour les vues
     */
    private function formatMovies($movies)
    {    
        return collect($movies)->map(function($movie) {

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/' .  $movie['poster_path']
                    : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',
                
                'vote_average' => $movie['vote_average'] == 0
                    ? '-'
                    : $movie['vote_average'] * 10 . '%',

                'genres' => $genresFormatted,
                'release_date' => Carbon::parse($movie['release_date'])->format('d M, Y'),                
            ])->only([
                'poster_path', 'id', 'genres_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}
