@extends('layouts.app')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">

            <img src="{{ $movie['poster_path'] }}" alt="movie image" class="w-64 md:w-96">

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">
                    {{ $movie['title'] }}
                </h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/>
                        </g>
                    </svg>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['genres'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movie['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Feature Cast</h4>
                    <div class="flex mt-4">
                        @forelse ($movie['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>  
                        @empty 
                            <p>Aucune donnée</p>
                        @endforelse                        
                    </div>
                </div>

                <div x-data="{ isOpen: false }">
                    @if ($movie['trailer'])
                        <div class="mt-12">
                            <button 
                                class="flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150"
                                @click="isOpen = true"
                            >
                                <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2">Voir Trailer</span>
                            </button>
                        </div>
                        
                        <template x-if="isOpen"> 
                            <div style="background-color: rgba(0, 0, 0, .9);" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded"  @click.away="isOpen = false">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                class="text-3xl leading-none hover:text-gray-300"
                                                @click="isOpen = false"
                                            >
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="{{ $movie['trailer'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif  
                </div>
            </div>
        </div>
    </div> <!-- end movie info -->

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Acteurs  
            </h2>  

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @forelse ($movie['head_cast'] as $actor)
                    <div class="mt-8">
                        <a href="#">
                            <img src="{{ $actor['profile_path'] }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>

                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">
                                {{ $actor['name'] }}
                            </a>

                            <div class="flex items-center text-sm">
                                {{ $actor['character'] }}
                            </div>
                        </div>
                    </div> 
                @empty 
                    <p>Aucune donnée</p>
                @endforelse                               

            </div> 

            @if (count($movie['secondary_cast']) > 0)
                <div x-data="{ isOpen: false }">
                    <div class="mt-10">
                        <button class="text-yellow-400 hover:text-yellow-500 normal-case"
                            @click="isOpen = !isOpen"
                            x-html="
                                isOpen 
                                    ? 'Masquer <i class=&quot;fas fa-chevron-right ml-1 text-xs&quot;></i>' 
                                    : 'Afficher plus <i class=&quot;fas fa-chevron-down ml-1 animate-bounce text-xs&quot;></i>'
                            "
                        >                            
                        </button>                
                    </div>
    
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4" x-show="isOpen" x-cloak>
                        @foreach ($movie['secondary_cast'] as $actor)
                            <div class="mt-5 flex flex-col">
                                <a href="#" class="hover:opacity-75 transition ease-in-out duration-150">
                                    <img src="{{ $actor['profile_path'] }}"  class="w-8" alt="actor">
                                </a>
                                                                
                                <a href="#" class="text-lg hover:text-gray-300">
                                    {{ $actor['name'] }}
                                </a>

                                <span class="text-sm">
                                    {{ $actor['character'] }}
                                </span>
                            </div>                            
                        @endforeach
                    </div>
                </div>                
            @endif
        </div>
    </div> <!-- end cast section -->

    <div class="movie-images" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Images    
            </h2>  

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($movie['images'] as $image)                    
                    <div class="mt-8">
                        <a 
                            href="#" 
                            @click.prevent="
                                isOpen = true
                                image = '{{ $image['file_path'] }}'
                            "
                        >
                            <img src="{{ $image['file_path'] }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>     
                @empty 
                   <p>Aucune donnée</p>                                
                @endforelse                
            </div> 

            <div style="background-color: rgba(0, 0, 0, .9);" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" 
                x-show="isOpen" x-cloak
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded"  @click.away="isOpen = false">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                class="text-3xl leading-none hover:text-gray-300"
                                @click="isOpen = false, image = null"
                                @keydown.escape.window="isOpen = false"
                            >
                                &times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="movie image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end images gallery -->
@endsection