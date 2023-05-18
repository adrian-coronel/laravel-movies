<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActor;
    public $page;

    public function __construct($popularActor, $page)
    {
        $this->popularActor = $popularActor;
        $this->page = $page;
    }

    public function popularActor()
    {
        return collect($this->popularActor)->map(function($actor){
            return collect($actor)->merge([
                
                'profile_path' => $actor['profile_path'] 
                    ? 'https://image.tmdb.org/t/p/w470_and_h470_face/' . $actor['profile_path']
                    #En caso la url este rota, mostraremos una ventana con las iniciales del actor
                    : 'https://ui-avatars.com/api/?size=2356name='. $actor['name'],

                # pluck() => recupera todos los valores de una clave dada
                # where() => filtra la colección por un par clave/valor determinado
                # union() => Une la colección con los artículos dados.
                'known_for' => collect($actor['known_for'])->where('media_type','movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type','tv')->pluck('name')
                )->implode(', '),

            ])->only([
                # pasamos los datos que solo vamos a usar
                'name','id','profile_path','known_for'
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }
    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
    
}
