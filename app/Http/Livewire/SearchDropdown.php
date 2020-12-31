<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if(strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/multi?language=fr-FR&query=' . $this->search)
            ->json()['results'];

        }
        
        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->map(function ($result){
                if(isset($result['known_for'])) {
                    return collect($result['known_for'])->merge([
                        'title' => $result['media_type'] == 'movie'
                            ? $result['title']
                            : $result['name'],
    
                        'poster' => isset($result['profile_path'])
                            ? 'https://image.tmdb.org/t/p/w92' . $result['profile_path']
                            : 'https://via.placeholder.com/50x75/111827/FFFFFF?text=No+Image',
                        
                        'url' => route('actors.show', $result['id']),
                    ]);  
                }
                else {
                    return collect($result)->merge([
                        'title' => $result['media_type'] == 'movie'
                            ? $result['title']
                            : $result['name'],
                        
                        'poster' => $result['poster_path'] 
                            ? 'https://image.tmdb.org/t/p/w92' . $result['poster_path']
                            : 'https://via.placeholder.com/50x75/111827/FFFFFF?text=No+Image',
    
                        'url' => $result['media_type'] == 'movie'
                            ? route('movies.show', $result['id'])
                            : route('tv.show', $result['id']),
                    ]);
                }
                
            })->take(10),
        ]);
    }
}
