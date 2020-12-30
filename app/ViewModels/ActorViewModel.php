<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;

    public function __construct($actor)
    {
        $this->actor = $actor;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday' => $this->actor['birthday'] 
                ? Carbon::parse($this->actor['birthday'])->format('d M, Y')
                : 'N/A',
            'age' => $this->actor['birthday']
                ? Carbon::parse($this->actor['birthday'])->age . ' ans'
                : '-',
            'deathday' => $this->actor['deathday']
                ? Carbon::parse($this->actor['deathday'])->format('d M, Y')
                : '',
            'profile_path' => $this->actor['profile_path']
                ? 'https://image.tmdb.org/t/p/w300/' . $this->actor['profile_path']
                : 'https://via.placeholder.com/300x450/1F2937/FFFFFF?text=No+Image',
            'facebook' => $this->actor['external_ids']['facebook_id'] 
                ? 'https://www.facebook.com/' . $this->actor['external_ids']['facebook_id']
                : '',
            'instagram' => $this->actor['external_ids']['instagram_id'] 
                ? 'https://www.instagram.com/' . $this->actor['external_ids']['instagram_id']
                : '',
            'twitter' => $this->actor['external_ids']['twitter_id'] 
                ? 'https://twitter.com/' . $this->actor['external_ids']['twitter_id']
                : '',

            'known_for' => collect($this->actor['combined_credits']['cast'])                
                ->where('media_type', 'movie')->union(
                    collect($this->actor['combined_credits']['cast'])->where('media_type', 'tv')                    
                )->map(function ($movie){
                return collect($movie)->merge([
                    'poster_path' => $movie['poster_path'] 
                        ? 'https://image.tmdb.org/t/p/w185/' . $movie['poster_path']
                        : 'https://via.placeholder.com/185x278/1F2937/FFFFFF?text=No+Image',
                    'title' => isset($movie['title']) ? $movie['title'] : $movie['name'],
                    'url' => $movie['media_type'] == "movie"
                        ? route('movies.show', $movie['id'])
                        : route('tv.show', $movie['id']),
                ])->only(['id', 'poster_path', 'title', 'popularity', 'media_type', 'url']);               
            })->sortByDesc("popularity")->take(5),  

            'credits' => collect($this->actor['combined_credits']['cast'])->map(function ($movie){
                if (isset($movie['release_date'])) 
                    $releaseDate = $movie['release_date'];
                elseif (isset($movie['first_air_date']))
                    $releaseDate = $movie['first_air_date'];
                else    
                    $releaseDate = '';
                return collect($movie)->merge([
                    'release_date' => $releaseDate, 
                    'release_year' => isset($releaseDate)
                        ? Carbon::parse($releaseDate)->format('Y')
                        : 'Futur',                        
                    'title' => isset($movie['title']) ? $movie['title'] : $movie['name'],
                    'character' => isset($movie['character']) ? $movie['character'] : '/',
                    'media' => $movie['media_type'] == 'movie' ? 'Film' : 'Série',
                    'url' => $movie['media_type'] == 'movie' 
                        ? route('movies.show', $movie['id']) 
                        : route('tv.show', $movie['id']),
                ])->only(['release_date', 'release_year', 'title', 'character', 'media', 'url', 'id']);               
            })->sortByDesc('release_year'),   
            
            'images' => collect($this->actor['images']['profiles'])->map(function ($image){
                return collect($image)->merge([
                    'file_path' => 'https://image.tmdb.org/t/p/w220_and_h330_face' . $image['file_path'],
                    'file_path_zoom' => 'https://image.tmdb.org/t/p/w500' .  $image['file_path'] 
                ]);
            })->take(15),
        ]);
    }
}
