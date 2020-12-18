<div class="relative mt-3 md:mt-0" 
    x-data="{ isOpen: true }"
    @click.away="isOpen = false">

    <input wire:model.debounce.500ms="search" 
        type="text" 
        class="bg-gray-800 text-sm rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline" 
        placeholder="Rechercher (focus avec *)"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 106) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.shift.tab="isOpen = false">

    <div class="absolute top-0">
        <svg class="w-4 text-gray-500 mt-2 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>

    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 mt-1 text-white absolute top-0 right-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>

    @if (strlen($search) > 1)
        <div class="absolute bg-gray-800 rounded text-sm w-64 mt-4 shadow-lg z-10" 
            x-show.transition.opacity="isOpen"
            @keydown.escape.window="isOpen = !isOpen">

            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $result['id']) }}" 
                                class="hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-1 focus:ring-yellow-400 px-3 py-3 flex items-center"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                                @if ($result['poster_path'])
                                    <img class="w-8" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster">
                                @else 
                                    <img class="w-8" src="https://via.placeholder.com/50x75?text=No+Image" alt="poster">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}</span> 
                            </a>
                        </li>
                    @endforeach            
                </ul>
            @else 
                <div class="px-3 py-3">
                    Aucun résultat pour "{{ $search }}"
                </div>
            @endif        
        </div>
    @endif
</div>