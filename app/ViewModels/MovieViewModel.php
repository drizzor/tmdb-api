<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        $total_cast = count($this->movie['credits']['cast']);
        $total_secondary_cast = ($total_cast > 10) ? $total_cast - 10 : 0;

        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path']
                : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',

            'vote_average' => $this->movie['vote_average'] > 0
                ? $this->movie['vote_average'] * 10 . '%'
                : '-', 

            'release_date' => $this->movie['release_date']
                ? Carbon::parse($this->movie['release_date'])->format('d M, Y') 
                : '-',

            'genres' => $this->movie['genres']
                ? collect($this->movie['genres'])->pluck('name')->implode(', ')
                : '-',

            'crew' => collect($this->movie['credits']['crew'])->take(3),

            'trailer' => (count($this->movie['videos']['results']) > 0)
                ? 'https://www.youtube.com/embed/' . $this->movie['videos']['results'][0]['key']
                : '',

            'head_cast' => collect($this->movie['credits']['cast'])->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path']
                        : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',
                ]);
            })->take(10),

            'secondary_cast' => collect($this->movie['credits']['cast'])->reverse()->map(function ($cast){
                return collect($cast)->merge([
                   'profile_path' =>  $cast['profile_path'] 
                        ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] 
                        : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image', 
                ]);
            })->take($total_secondary_cast)->reverse(),

            'images' => collect($this->movie['images']['backdrops'])->map(function ($image){
                return collect($image)->merge([
                    'file_path' => 'https://image.tmdb.org/t/p/original' .  $image['file_path'] 
                ]);
            })->take(12),

        ])->only([
            'poster_path', 'id', 'genres', 'title', 
            'vote_average', 'overview', 'release_date', 'credits', 'trailer',
            'videos', 'images', 'crew', 'head_cast', 'secondary_cast', 'images'
        ]);
    }
}
