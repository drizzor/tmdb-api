@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">
                Séries populaires
            </h2>            

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach                
            </div>
        </div> <!-- end popular tv -->

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">
                Diffusé en ce moment
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($airingToday as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach                          
            </div>
        </div> <!-- end top rated -->
    </div>
@endsection