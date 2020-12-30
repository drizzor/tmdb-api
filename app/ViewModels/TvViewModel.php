<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $airingToday;
    public $genres;

    /**
     * Init des différents élément lié à l'index séries
     */
    public function __construct($popularTv, $airingToday, $genres)
    {
        $this->popularTv = $popularTv;
        $this->airingToday = $airingToday;
        $this->genres = $genres;
    }

    /**
     * Formatage des séries populaires
     */
    public function popularTv()
    {
        return $this->formattedTv($this->popularTv);
    }

    /**
     * Formatage des séries les mieux notées
     */
    public function airingToday()
    {
        return $this->formattedTv($this->airingToday);
    }

    /**
     * Place les IDS des genres en key
     */
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        // return collect($this->genres)->dump();
    }

    private function formattedTv($tv)
    {
        return collect($tv)->map(function ($tv){
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tv)->merge([
                'poster_path' => $tv['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/' .  $tv['poster_path']
                    : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',
                'vote_average' => $tv['vote_average']
                    ? $tv['vote_average'] * 10 . '%'
                    : '-',
                'first_air_date' => $tv['first_air_date']
                    ? Carbon::parse($tv['first_air_date'])->format('d M, Y')
                    : '-',
                'genres' => $genresFormatted,
            ])->only(['poster_path', 'id', 'name', 'vote_average', 'first_air_date', 'genres']);
        });
    }
}
