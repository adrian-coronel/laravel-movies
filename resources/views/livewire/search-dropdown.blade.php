<div class="relative mt-3 md:mt-0">
  {{-- wire:model permite enlazar(reflejar) un input o select a una propiedad publica del componente --}}
  <input wire:model="search" type="text" class="bg-gray-800 rounded-full w-64 pl-8 px-4 py-1 focus:outline-none focus:shadow-outline" placeholder="Search">
  <div class="absolute top-0">
    {{-- #icon-search --}}
    <svg class="fill-current w-4 text-gray-500 mt-2 ml-2"></svg>
  </div>
  <div class="absolute bg-gray-800 rounded w-64 mt-4 text-sm">
    <ul>
      @foreach ($searchResults as $result)
        <li class="border-b border-gray-700">
          <a href="{{route('movies.show',$result['id'])}}" class="block hover:bg-gray-700 px-3 py-3">{{$result['title']}}</a>
        </li>
      @endforeach
      
    </ul>
  </div>
</div>

