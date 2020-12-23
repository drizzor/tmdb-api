@extends('layouts.app')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="actor image" class="w-64 md:w-96">

                <ul class="flex justify-center mt-4 space-x-10">
                    @if ($actor['facebook'])
                        <li>
                            <a href="{{ $actor['facebook'] }}" title="Facebook" class="text-3xl text-gray-400 hover:text-white" target="_blank">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                    @endif                    
                    
                    @if ($actor['instagram'])
                        <li>
                            <a href="{{ $actor['instagram'] }}" title="Instagram" class="text-3xl text-gray-400 hover:text-white" target="_blank">
                                <i class="fab fa-instagram-square"></i>
                            </a>
                        </li>
                    @endif
                                        
                    @if ($actor['twitter'])
                        <li>
                            <a href="{{ $actor['twitter'] }}" title="Twitter" class="text-3xl text-gray-400 hover:text-white" target="_blank">
                                <i class="fab fa-twitter-square"></i>
                            </a>
                        </li>
                    @endif                   
                    
                    @if ($actor['homepage'])
                        <li>
                            <a href="{{ $actor['homepage'] }}" title="Site" class="text-3xl text-gray-400 hover:text-white" target="_blank">
                                <i class="fas fa-globe-europe"></i>
                            </a>
                        </li>
                    @endif                    
                </ul>
            </div>            

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">
                    {{ $actor['name'] }}
                </h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h.01a1 1 0 010 2H7a1 1 0 01-1-1zm2 3a1 1 0 00-2 0v1a2 2 0 00-2 2v1a2 2 0 00-2 2v.683a3.7 3.7 0 011.055.485 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0A3.7 3.7 0 0118 12.683V12a2 2 0 00-2-2V9a2 2 0 00-2-2V6a1 1 0 10-2 0v1h-1V6a1 1 0 10-2 0v1H8V6zm10 8.868a3.704 3.704 0 01-4.055-.036 1.704 1.704 0 00-1.89 0 3.704 3.704 0 01-4.11 0 1.704 1.704 0 00-1.89 0A3.704 3.704 0 012 14.868V17a1 1 0 001 1h14a1 1 0 001-1v-2.132zM9 3a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H13a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1">
                        {{ $actor['birthday'] }} ({{ $actor['age'] }}) à {{ $actor['place_of_birth'] }}
                    </span>
                    @if ($actor['deathday'])
                        <span class="mx-2">|</span>
                        <span>Mort le {{ $actor['deathday'] }}</span>
                    @endif                    
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $actor['biography'] }}
                </p>

                <h4 class="font-semibold mt-12">Connu pour</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                    @foreach ($actor['known_for'] as $artwork)
                        <div class="mt-4">
                            <a href="{{ route('movies.show', $artwork['id']) }}">
                                <img src="{{ $artwork['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <a href="{{ route('movies.show', $artwork['id']) }}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">
                                {{ $artwork['title'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
                    
            </div>
        </div>
    </div> <!-- end actor info -->

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
               Filmographie
            </h2>  
            <ul class="list-disc leading-loose pl-5 mt-8">
                @forelse ($actor['credits'] as $credit)
                    {{-- @if ($credit['release_year']) --}}
                        <li>
                            {{ $credit['release_year'] }} &middot; <b>{{ $credit['title'] }}</b> en tant que {{ $credit['character'] }} - {{ $credit['media'] }}
                        </li>
                    {{-- @endif                     --}}
                @empty
                    Aucune filmographie
                @endforelse
            </ul>
        </div>
    </div> <!-- end credits info -->

    {{-- <div class="movie-images" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Images    
            </h2>  

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="mt-8">
                    <a 
                        href="#" 
                        @click.prevent="
                            isOpen = true
                            image = 'https://image.tmdb.org/t/p/w500/3JTEc2tGUact9c0WktvpeJ9pajn.jpg'
                        "
                    >
                        <img src="https://image.tmdb.org/t/p/w500/3JTEc2tGUact9c0WktvpeJ9pajn.jpg" alt="actor image" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>                    
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
                            <img :src="image" alt="actor image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end images gallery --> --}}
@endsection