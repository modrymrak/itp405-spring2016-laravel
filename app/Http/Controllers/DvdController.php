<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class DvdController extends Controller
{
    public function dvds(Request $request){

        $dvds = DB::table('dvds')
            ->select('title', 'rating_name', 'genre_name', 'label_name', 'sound_name', 'format_name')
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
        if(strcmp("All", $dvd_genre) != 0){
            $dvds = $dvds->where('genre_name', '=', $dvd_genre);
            if($somethingSet){
                $buildString .= ", " .$dvd_genre;
            }else{
                $buildString .= $dvd_genre;
                $somethingSet = true;
            }
        }

        $dvd_rating = $request->input('dvd_rating');
        if(strcmp("All", $dvd_rating) != 0){
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
        $ratings = DB::table('ratings')
            ->select("rating_name")
            ->get();
        return view('search',[
            'myGenres' => $genres,
            'myRatings'=> $ratings
        ]);
    }
}
