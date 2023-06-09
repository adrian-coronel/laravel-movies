<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

/*
    Esta clase es enviada a la vista SHOW, por detras laravel utilia las funciones para poder abastecer a la vista show.
    ES DECIR: Que ahora podemos tener la logica de la vista en un controlador de vista
*/
class MovieViewModel extends ViewModel
{
    public $movie;

    /**
     * Es este constructor se pasará la pelicula 
     * para la vista show
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie(){
        
        # merge() Devuelve una nueva colecion que contiene todos los elementos originales y los elementos proporcionados como argumento
        return collect($this->movie)->merge([
            # Ahora los valores ya se pasarán modificados sin necidad de hacerlo en la vista
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 .'%',
            'release_date' => date('M d, Y',strtotime($this->movie['release_date'])),
            #eliminamos el campo "id" de gnre y nos quedamos con el campo "name"
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '), # IMPLODE une elementos de un array en una sola cadena separada por un delimitador.

            # Aqui tomamos 2 elementos de crew y los mostramos como un campo aparte
            'crew' => collect($this->movie['credits']['crew'])->take(2),

            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'images' => collect($this->movie['images']['backdrops'])->take(8),
        ])->only([
            # pasamos los datos que solo vamos a usar
            'poster_path','id','genre_ids','title','vote_average','overview','release_date','genres','crew','credits','videos','images','cew','cast','images'
        ]);
    }
}
