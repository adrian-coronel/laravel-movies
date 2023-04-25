{{-- x-data: define una parte de HTML como un componente Alpine y proporciona 
  los datos reactivos para que ese componente haga referencia.--}}
<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false" @click="isOpen = true">{{-- @click.away=> Detectar clic fuera del elemento que tiene asociado el evento "@click"--}}
  {{-- wire:model permite enlazar(reflejar) un input o select a una propiedad publica del componente --}}
  <input wire:model="search" type="text" class="bg-gray-800 rounded-full w-64 pl-8 px-4 py-1 focus:outline-none focus:shadow-outline" placeholder="Search">
  <div class="absolute top-0">
    {{-- #icon-search --}}
    <svg class="fill-current w-4 text-gray-500 mt-2 ml-2"></svg>
  </div>

  {{-- SPINNER | wire:loading => Muestra u ocultar elementos mientras se está realizando una acción con Livewire. --}}
  <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

  @if (strlen($search) >= 2)      
    <div 
      class="absolute bg-gray-800 rounded w-64 mt-4 text-sm" 
      {{-- x-show: Proporciona una forma expresiva de mostrar y ocultar elementos DOM. --}}
      x-show="isOpen"
      @keydown.escape.window="isOpen = false"

    >
      @if ($searchResults->count() > 0)        
        <ul>
          @foreach ($searchResults as $result)
            <li class="border-b border-gray-700">
              <a href="{{route('movies.show',$result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex items-center">
                @if ($result['poster_path'])                  
                  <img class="w-8" src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster">
                @else
                  <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                @endif
                <span class="ml-4">{{$result['title']}}</span>
              </a>
            </li>
          @endforeach
        </ul>
      @else
        <div class="px-3 py-3">No results for {{ $search }}</div>
      @endif
    </div>
  @endif
</div>

