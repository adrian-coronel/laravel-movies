<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

/*
    Esta clase es enviada a la vista index, por detras laravel utilia las funciones para poder abastecer a la vista index.
    ES DECIR: Que ahora podemos tener la logica de la vista en un controlador de vista
*/
class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    /*
        Los valores son enviados desde MoviesController
    */
    public function __construct($popularMovies,$nowPlayingMovies,$genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }
    public function nowPlayingMovies(){
        return $this->formatMovies($this->nowPlayingMovies);
    }
    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];
        });
    }

    /**
     * Este metódo es para que no se repita el mismo código en las otras funciones
     */
    private function formatMovies($movies){

        return collect($movies)->map(function($movie){
            # merge() Devuelve una nueva colecion que contiene todos los elementos originales y los elementos proporcionados como argumento

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                # retorna el valor reasignado y que coincida entre "genre_ids" y el array "genre"
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            # IMPLODE se utiliza para unir elementos de un array en una sola cadena separada por un delimitador especificado.

            return collect($movie)->merge([
                # Ahora los valores ya se pasarán modificados sin necidad de hacerlo en la vista
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => date('M d, Y',strtotime($movie['release_date'])),
                'genres' => $genresFormatted
            ]);
        })->dump();
    }

}
