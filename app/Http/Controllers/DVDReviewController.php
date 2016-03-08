<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class DVDReviewController extends Controller
{
    public function reviewPage($id, Request $request){
      $dvdID = $id;
      $dvd = DB::table('dvds')
          ->select('dvds.id', 'title', 'rating_name', 'genre_name', 'label_name', 'sound_name', 'format_name', 'award')
          ->leftJoin('ratings', 'dvds.rating_id', '=', 'ratings.id')
          ->leftJoin('genres', 'dvds.genre_id', '=', 'genres.id')
          ->leftJoin('labels', 'dvds.label_id', '=', 'labels.id')
          ->leftJoin('sounds', 'dvds.sound_id', '=', 'sounds.id')
          ->leftJoin('formats', 'dvds.format_id', '=', 'formats.id')
          ->where('dvds.id', '=', "$dvdID")->get();
      //$dvd_title = $request->input('dvdTitle');
      $reviews = DB::table('reviews')
          ->select('id', 'title', 'description', 'rating')
          ->where('dvd_id', '=', "$dvdID")->get();
      return view('review', [
        'dvdID' => $dvdID,
        'dvd' =>  $dvd,
        'reviews' => $reviews
      ]);
    }

    public function newReview($id, Request $request){
      $dvdID = $id;

      $validation = Validator::make($request->all(), [
        'title' => 'required|min:5',
        'rating' => 'required|digits_between:1,10',
        'description' => 'required|min:10',
        'dvdID' => 'required|integer'
      ]);
      if($validation->fails()){
        return redirect("dvds/$dvdID")->withErrors($validation)->withInput();
      }
      $title = $request->input('title');
      $rating = $request->input('rating');
      $description = $request->input('description');

      DB::table('reviews')->insert([
        'dvd_id'=> $dvdID,
        'title' => $title,
        'description' => $description,
        'rating' => $rating
      ]);
      return redirect("dvds/$dvdID")->with('success', true);
    }
}
