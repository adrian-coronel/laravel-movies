<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class SearchDropdown extends Component
{
    # En este atributo se recibirá el objeto de busqueda
    public $search = '';

    
    public function render()
    {
        $searchResults = [];

        # minimo 2 letras para obtener un resultado 
        if (strlen($this->search) >= 2) {      
            $searchResults = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='. $this->search)
            ->json()['results'];
        }

        
        // dump($searchResults);
        return view('livewire.search-dropdown',[
            # collect combierte el array en una colección y con
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
