<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Dvd;
use Response;
use Validator;

class ApiController extends Controller
{
    public function index(){
      return ["genres" =>Genre::all()];
    }

    public function show($id){
      $genre = Genre::find($id);
      if(!$genre){
        return Response::json([
          'error' => "Genre not found"
        ], 404);
      }

      return ["genre" => $genre];
    }

    public function dvdsIndex(){
      $dvds =  Dvd::with('genre', 'rating')->take(20)->get();
      $genres = $this->uniqueGenres($dvds);
      $ratings = $this->uniqueRatings($dvds);
      return [
        "dvds" => $dvds,
        "genres" => $genres,
        "ratings" => $ratings
      ];
    }

    public function dvdsShow($id){
      $dvd =  Dvd::with('genre', 'rating')->find($id);

      if(!$dvd){
        return Response::json([
          'error' => "DVD not found"
        ], 404);
      }
      return [
        "dvd" => $dvd,
        "genres" => $dvd->genre,
        "ratings" => $dvd->rating
      ];
    }

    public function dvdsStore(Request $request){
      $validator = Validator::make($request->all(), [
        'title' => 'required|unique:dvds,title',
        'genre_id' => 'required',
        'rating_id' => 'required'
      ]);

      if ($validator->passes()){
        $dvd = new Dvd();
        $dvd->title = $request->input('title');
        $dvd->award =  $request->input('award');
        $dvd->genre_id =  $request->input('genre_id');
        $dvd->rating_id =  $request->input('rating_id');
        $dvd->save();
        return[
          'dvd' => $dvd
        ];
      }
      $errors = [];
      if($validator->errors()->get('title')){
        $errors['title' ] =$validator->errors()->get('title');
      }
      if($validator->errors()->get('genre_id')){
        $errors['genre_id' ] =$validator->errors()->get('genre_id');
      }
      if($validator->errors()->get('rating_id')){
        $errors['rating_id' ] =$validator->errors()->get('rating_id');
      }
      return Response::json([
        'errors' => [
            $errors
          ]
      ], 422);

    }

    public function uniqueGenres($dvds){
      $uniqueDvds = [];
      $genres = [];
      foreach ($dvds as $dvd){
        if(!array_key_exists($dvd->genre->id, $uniqueDvds)){
          $uniqueDvds[$dvd->genre->id] = true;
          $genres[] = $dvd->genre;
        }
      }
      return $genres;
    }

    public function uniqueRatings($dvds){
      $uniqueDvds = [];
      $ratings = [];
      foreach ($dvds as $dvd){
        if(!array_key_exists($dvd->rating->id, $uniqueDvds)){
          $uniqueDvds[$dvd->rating->id] = true;
          $ratings[] = $dvd->rating;
        }
      }
      return $ratings;
    }

}
