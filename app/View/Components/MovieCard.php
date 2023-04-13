<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MovieCard extends Component
{

    public $movie;
    public $genres;
    /**
     * Create a new component instance.
     */
    public function __construct($movie, $genres)
    {
        # Una vez recibido el valor mediante :movie='$movie' :genres='$genres'
        # ya se puede usar en la mista movie-card
        $this->movie = $movie;
        $this->genres = $genres;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movie-card');
    }
}
