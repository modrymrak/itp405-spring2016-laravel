<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Label;
use App\Models\Sound;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Dvd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class DvdController extends Controller
{
    public function dvds(Request $request){

        $dvds = DB::table('dvds')
            ->select('dvds.id', 'title', 'rating_name', 'genre_name', 'label_name', 'sound_name', 'format_name')
            ->leftJoin('ratings', 'dvds.rating_id', '=', 'ratings.id')
            ->leftJoin('genres', 'dvds.genre_id', '=', 'genres.id')
            ->leftJoin('labels', 'dvds.label_id', '=', 'labels.id')
            ->leftJoin('sounds', 'dvds.sound_id', '=', 'sounds.id')
            ->leftJoin('formats', 'dvds.format_id', '=', 'formats.id');
        $buildString = "";
        $somethingSet = false;
        $dvd_title = $request->input('dvd_title');
        if(!empty($dvd_title)){
            $dvds = $dvds->where('title', 'like', "%$dvd_title%");
            $buildString .= $dvd_title;
            $somethingSet = true;
        }

        $dvd_genre = $request->input('dvd_genre');
        if(strcmp("All", $dvd_genre) != 0 && !empty($dvd_genre)) {
            $dvds = $dvds->where('genre_name', '=', $dvd_genre);
            if($somethingSet){
                $buildString .= ", " .$dvd_genre;
            }else{
                $buildString .= $dvd_genre;
                $somethingSet = true;
            }
        }

        $dvd_rating = $request->input('dvd_rating');
        if(strcmp("All", $dvd_rating) != 0 && !empty($dvd_rating)){
            $dvds = $dvds->where('rating_name', '=', $dvd_rating);
            if($somethingSet){
                $buildString .= ", " .$dvd_rating;
            }else{
                $buildString .= $dvd_rating;
                $somethingSet = true;
            }
        }
        $searchedString = "";
        if($somethingSet){
            $searchedString = "You searched for: " . $buildString;
        }else{
            $searchedString = "No search criteria";
        }
        $dvds = $dvds->get();
        return view('dvds',[
            'myDvds' => $dvds,
            'searchedString' => $searchedString
        ]);
    }

    public function search(){

        $genres = DB::table('genres')
            ->select("genre_name")
            ->get();

        $genres = new Genre();
        $ratings = DB::table('ratings')
            ->select("rating_name")
            ->get();
        return view('search',[
            'myGenres' => $genres->all(),
            'myRatings'=> $ratings
        ]);
    }

    public function create(){
      $labels = new Label();
      $sounds = new Sound();
      $genres = new Genre();
      $ratings = new Rating();
      $formats = new Format();
      return view('create', [
        'labels' => $labels->all(),
        'sounds' => $sounds->all(),
        'genres' => $genres->all(),
        'ratings' => $ratings->all(),
        'formats' => $formats->all(),

      ]);
    }

    public function createDVD(Request $request){

            $validation = Validator::make($request->all(), [
              'title' => 'required',
              'rating' => 'required',
              'label' => 'required',
              'genre' => 'required',
              'sound' => 'required',
              'format' => 'required'
            ]);
            if($validation->fails()){
              return redirect("dvds/create")->withErrors($validation)->withInput();
            }

            $dvd = new Dvd();
            $dvd->title = $request->input('title');
            $dvd->award = $request->input('award');
            $dvd->label_id = $request->input('label');
            $dvd->sound_id = $request->input('sound');
            $dvd->genre_id = $request->input('genre');
            $dvd->rating_id = $request->input('rating');
            $dvd->format_id = $request->input('format');
            $dvd->save();

            return redirect("dvds/create")->with('success', true);
    }

    public function genreDVDsPage($genre_name){
      $genre = new Genre();
      $genre = $genre->where('genre_name', $genre_name)
                    ->take(1)
                    ->get();
      $empty = [];
      $dvds = new Dvd();
      $dvds = $dvds->with('label', 'rating', 'genre')->where('genre_id', '=', $genre[0]->id)->get(); //Looking up genre again is redundant, but included for posteriority
      return view("genreDVDs", [
        "myGenre" => $genre[0],
        "myDvds" => $dvds
      ]);
    }
}
