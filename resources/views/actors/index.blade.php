@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">
                Acteurs populaires
            </h2>            

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="#">
                            <img src="{{ $actor['profile_path'] }}" alt="actor profile image" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg hover:text-gray-300">
                                {{ $actor['name'] }}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>  
                @endforeach                             
            </div>
        </div> <!-- end popular actors -->

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <svg class="infinite-scroll-request animate-spin -ml-1 mr-3 h-20 w-20 mt-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="infinite-scroll-last">Tout a été chargé!</p>
                <p class="infinite-scroll-error">Erreur de chargement.</p>
            </div>            
        </div>
          
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="{{ route('actors.index.page', $previous) }}" class="bg-yellow-500 text-gray-900 font-semibold px-3 py-3 hover:bg-yellow-600 rounded">
                    <i class="fas fa-chevron-left"></i> Précédent
                </a>    
            @else 
                <p class="bg-gray-800 text-gray-900 font-semibold cursor-not-allowed px-3 py-3 rounded">
                    <i class="fas fa-chevron-left"></i> Précédent
                </p>
            @endif
            
            @if ($next)
                <a href="{{ route('actors.index.page', $next) }}" class="bg-yellow-500 text-gray-900 font-semibold px-3 py-3 hover:bg-yellow-600 rounded">
                    Suivant <i class="fas fa-chevron-right"></i> 
                </a>   
                
            @else 
                <p class="bg-gray-800 text-gray-900 font-semibold cursor-not-allowed px-3 py-3 rounded">
                    Suivant <i class="fas fa-chevron-right"></i> 
                </p>
            @endif
        </div> <!-- end prev/next button --> --}}
    </div>
@endsection

@section('scripts')
    {{-- Infinite Scrolling --}}
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status'
        // history: false,
        });

        // element argument can be a selector string
        //   for an individual element
        var infScroll = new InfiniteScroll( '.container', {
        // options
        });
    </script>
@endsection