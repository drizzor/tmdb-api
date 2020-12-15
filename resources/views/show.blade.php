@extends('layouts.app')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">

            <img src="{{ asset('/img/parasite.jpg') }}" alt="parasite" class="w-64 md:w-96">

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">
                    Parasite (2019)
                </h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/>
                        </g>
                    </svg>
                    <span class="ml-1">85%</span>
                    <span class="mx-2">|</span>
                    <span>Feb 20, 2020</span>
                    <span class="mx-2">|</span>
                    <span>Action, Thriller, Drama</span>
                </div>

                <p class="text-gray-300 mt-8">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia assumenda nam dolorem itaque doloremque maxime 
                    atque odio accusantium magni dolore necessitatibus similique earum quos excepturi et nemo obcaecati, amet quo ducimus 
                    consequatur maiores enim cupiditate! Beatae voluptatem quibusdam laudantium quis labore officia recusandae ex autem sit molestiae, 
                    assumenda dicta commodi!
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Feature Cast</h4>
                    <div class="flex mt-4">
                        <div>
                            <div>Bong Joon-won</div>
                            <div class="text-sm text-gray-400">Screenplay, Director, Story</div>
                        </div>

                        <div class="ml-8">
                            <div>Han Jin-won</div>
                            <div class="text-sm text-gray-400">Screenplay</div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <button class="flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150">
                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>

            </div>
        </div>
    </div> <!-- end movie info -->

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Cast    
            </h2>  

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/actor1.jpg') }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">
                            Real Name
                        </a>

                        <div class="flex items-center text-sm">
                            John Smith
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/actor2.jpg') }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">
                            Real Name
                        </a>

                        <div class="flex items-center text-sm">
                            John Smith
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/actor3.jpg') }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">
                            Real Name
                        </a>

                        <div class="flex items-center text-sm">
                            John Smith
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/actor4.jpg') }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">
                            Real Name
                        </a>

                        <div class="flex items-center text-sm">
                            John Smith
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/actor5.jpg') }}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>

                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray:300">
                            Real Name
                        </a>

                        <div class="flex items-center text-sm">
                            John Smith
                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div> <!-- end cast section -->

    <div class="movie-images border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">
                Images    
            </h2>  

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image1.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image2.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>                    
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image3.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image4.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>                   
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image5.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>

                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('/img/image6.jpg') }}" alt="movie images" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>

            </div> 
        </div>
    </div> <!-- end images gallery -->
@endsection