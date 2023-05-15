<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActor;

    public function __construct($popularActor)
    {
        $this->popularActor = $popularActor;
    }

    public function popularActor()
    {
        return $this->popularActor;
    }
}
