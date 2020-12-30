<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow()
    {
        $total_cast = count($this->tvshow['credits']['cast']);
        $total_secondary_cast = ($total_cast > 10) ? $total_cast - 10 : 0;

        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/' . $this->tvshow['poster_path']
                : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',

            'vote_average' => $this->tvshow['vote_average'] > 0
                ? $this->tvshow['vote_average'] * 10 . '%'
                : '-', 

            'first_air_date' => $this->tvshow['first_air_date']
                ? Carbon::parse($this->tvshow['first_air_date'])->format('d M, Y') 
                : '-',

            'genres' => $this->tvshow['genres']
                ? collect($this->tvshow['genres'])->take(3)->pluck('name')->implode(', ')
                : '-',

            'status' => $this->tvshow['status'] == 'Returning Series'
                ? 'En cours'
                : 'Terminée',

            'episode_run_time' => $this->tvshow['episode_run_time']
                ? $this->tvshow['episode_run_time'][0] . ' min'
                : '',

            'crew' => collect($this->tvshow['credits']['crew'])->take(3),

            'trailer' => (count($this->tvshow['videos']['results']) > 0)
                ? 'https://www.youtube.com/embed/' . $this->tvshow['videos']['results'][0]['key']
                : '',

            'head_cast' => collect($this->tvshow['credits']['cast'])->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path']
                        : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image',
                ]);
            })->take(10),

            'secondary_cast' => collect($this->tvshow['credits']['cast'])->reverse()->map(function ($cast){
                return collect($cast)->merge([
                   'profile_path' =>  $cast['profile_path'] 
                        ? 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] 
                        : 'https://via.placeholder.com/500x750/1F2937/FFFFFF?text=No+Image', 
                ]);
            })->take($total_secondary_cast)->reverse(),

            'seasons' => collect($this->tvshow['seasons'])->map(function ($season){
                return collect($season)->merge([
                    'poster_path' => $season['poster_path']
                        ? 'https://image.tmdb.org/t/p/w130_and_h195_bestv2' . $season['poster_path']
                        : 'https://via.placeholder.com/130x195/1F2937/FFFFFF?text=No+Image',

                    'air_date' => $season['air_date']
                        ? Carbon::parse($season['air_date'])->format('d M, Y')
                        : null,
                ]);
            }),
                

            'images' => collect($this->tvshow['images']['backdrops'])->map(function ($image){
                return collect($image)->merge([
                    'file_path' => 'https://image.tmdb.org/t/p/original' .  $image['file_path'] 
                ]);
            })->take(12),

        ])->only([
            'poster_path', 'id', 'genres', 'name', 'created_by', 'status',
            'vote_average', 'overview', 'first_air_date', 'credits', 'trailer', 'seasons',
            'videos', 'images', 'crew', 'head_cast', 'secondary_cast', 'episode_run_time'
        ]);
    }
}
