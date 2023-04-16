<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;


/* Para ejecutar este metodo de test en la terminal
php artisan test --filter ViewMoviesTest::the_main_page_shows_correct_info

Proposito: Probar con exito nuetra aplicación, especificamente falsificamos nuestras 
repuestas API e hicimos afirmaciones contra nuestras respuestas falsas
*/


class ViewMoviesTest extends TestCase
{
  /* @test 
    el nombre de la funcion debe comenzar con test_.....
  */
  public function test_the_main_page_shows_correct_info()
  {

    Http::fake([
      'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
      'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
      'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
    ]);

    $response = $this->get(route('movies.index'));

    #"assertSuccessful()" Comprueba que la respuesta tiene un codigo de estado correcto
    $response->assertSuccessful(); 
    $response->assertSee('Popular Movies');
    // $response->assertSee('Fake Movie');
    $response->assertSee('Animation, Adventure, Family, Fantasy, Comedy');
    $response->assertSee('Now Playing');
  }

  public function test_the_movie_page_shows_the_correct_info(){
    Http::fake([
      'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
    ]);

    $response = $this->get(route('movies.show',2321));
    #"assertSuccessful()" Comprueba que la respuesta tiene un codigo de estado correcto
    $response->assertSuccessful(); 

    #assertSee() se utiliza para verificar que un cierto texto o contenido está presente en la respuesta HTML generada
    $response->assertSee('Fake Jumanji');
    $response->assertSee('Jeanne McCarthy');
    $response->assertSee('Casting Director');
    $response->assertSee('Dwayne Johnson');
  }

  private function fakePopularMovies(){
    return Http::response([ // app\Http\Controllers\MoviesController.php:19
        "results" =>  [
          0 =>  [
            "adult" => false,
            "backdrop_path" => "/9n2tJBplPbgR2ca05hS5CKXwP2c.jpg",
            "genre_ids" => [
              0 => 16,
              1 => 12,
              2 => 10751,
              3 => 14,
              4 => 35,
            ],

            "id" => 502356,
            "original_language" => "en",
            "original_title" => "The Super Mario Bros. Movie",
            "overview" => "While working underground to fix a water main, Brooklyn plumbers—and brothers—Mario and Luigi are transported down a mysterious pipe and wander into a magical new world. But when the brothers are separated, Mario embarks on an epic quest to find Luigi.",
            "popularity" => 9032.947,
            "poster_path" => "/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg",
            "release_date" => "2023-04-05",
            "title" => "The Super Mario Bros. Movie",
            "video" => false,
            "vote_average" => 7.5,
            "vote_count" => 756,
          ]
        ]
    ],200);
  }
  
  
  private function fakeNowPlayingMovies(){
    return Http::response([ // app\Http\Controllers\MoviesController.php:19
        "results" => [
          0 => [
            "adult" => false,
            "backdrop_path" => "/9n2tJBplPbgR2ca05hS5CKXwP2c.jpg",
            "genre_ids" =>[
              0 => 16,
              1 => 12,
              2 => 10751,
              3 => 14,
              4 => 35,
            ],
            "id" => 502356,
            "original_language" => "en",
            "original_title" => "The Super Mario Bros. Movie",
            "overview" => "While working underground to fix a water main, Brooklyn plumbers—and brothers—Mario and Luigi are transported down a mysterious pipe and wander into a magical new world. But when the brothers are separated, Mario embarks on an epic quest to find Luigi.",
            "popularity" => 9032.947,
            "poster_path" => "/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg",
            "release_date" => "2023-04-05",
            "title" => "The Super Mario Bros. Movie",
            "video" => false,
            "vote_average" => 7.5,
            "vote_count" => 756,
          ],
        ],
        
    ],200);
  }
  
  private function fakeGenres(){
    return Http::response([ // app\Http\Controllers\MoviesController.php:26
      "genres" =>  [
        0 => [
          "id" => 28,
          "name" => "Action",
        ],
        1 => [
          "id" => 12,
          "name" => "Adventure",
        ],
        2 => [
          "id" => 16,
          "name" => "Animation",
        ],
        3 => [
          "id" => 35,
          "name" => "Comedy",
        ],
        4 => [
          "id" => 80,
          "name" => "Crime",
        ],
        5 => [
          "id" => 99,
          "name" => "Documentary",
        ],
        6 => [
          "id" => 18,
          "name" => "Drama",
        ],
        7 => [
          "id" => 10751,
          "name" => "Family",
        ],
        8 => [
          "id" => 14,
          "name" => "Fantasy",
        ],
        9 => [
          "id" => 36,
          "name" => "History",
        ],
        10 => [
          "id" => 27,
          "name" => "Horror",
        ],
        11 => [
          "id" => 10402,
          "name" => "Music",
        ],
        12 => [
          "id" => 9648,
          "name" => "Mystery",
        ],
        13 => [
          "id" => 10749,
          "name" => "Romance",
        ],
        14 => [
          "id" => 878,
          "name" => "Science Fiction",
        ],
        15 => [
          "id" => 10770,
          "name" => "TV Movie",
        ],
        16 => [
          "id" => 53,
          "name" => "Thriller",
        ],
        17 => [
          "id" => 10752,
          "name" => "War",
        ],
        18 => [
          "id" => 37,
          "name" => "Western",
        ]
      ]
    ]
    ,200);
  }

  public function fakeSingleMovie()
    {
      return Http::response([
        "adult" => false,
        "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
        "genres" => [
            ["id" => 28, "name" => "Action"],
            ["id" => 12, "name" => "Adventure"],
            ["id" => 35, "name" => "Comedy"],
            ["id" => 14, "name" => "Fantasy"],
        ],
        "homepage" => "http://jumanjimovie.com",
        "id" => 12345,
        "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
        "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
        "release_date" => "2019-12-04",
        "runtime" => 123,
        "title" => "Fake Jumanji: The Next Level",
        "vote_average" => 6.8,
        "credits" => [
            "cast" => [
                [
                    "cast_id" => 2,
                    "character" => "Dr. Smolder Bravestone",
                    "credit_id" => "5aac3960c3a36846ea005147",
                    "gender" => 2,
                    "id" => 18918,
                    "name" => "Dwayne Johnson",
                    "order" => 0,
                    "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                ]
            ],
            "crew" => [
                [
                    "credit_id" => "5d51d4ff18b75100174608d8",
                    "department" => "Production",
                    "gender" => 1,
                    "id" => 546,
                    "job" => "Casting Director",
                    "name" => "Jeanne McCarthy",
                    "profile_path" => null,
                ]
            ]
        ],
        "videos" => [
            "results" => [
                [
                    "id" => "5d1a1a9b30aa3163c6c5fe57",
                    "iso_639_1" => "en",
                    "iso_3166_1" => "US",
                    "key" => "rBxcF-r9Ibs",
                    "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                    "site" => "YouTube",
                    "size" => 1080,
                    "type" => "Trailer",
                ]
            ]
        ],
        "images" => [
            "backdrops" => [
                [
                    "aspect_ratio" => 1.7777777777778,
                    "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                    "height" => 2160,
                    "iso_639_1" => null,
                    "vote_average" => 5.388,
                    "vote_count" => 4,
                    "width" => 3840,
                ]
            ],
            "posters" => [
                [

                ]
            ]
        ]
      ], 200);
    }

}
