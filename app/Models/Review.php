<?php
  namespace App\Models;
  use DB;
  class Review{

    public function __construct($data){
        $this->dvdID  = $data['dvdID'];
        $this->title  = $data['title'];
        $this->rating  = $data['rating'];
        $this->description  = $data['description'];
    }
    public function save(){
      DB::table('reviews')->insert([
        'dvd_id'=> $this->dvdID,
        'title' => $this->title,
        'description' => $this->description,
        'rating' => $this->rating
      ]);
    }

    public static function All($data){
      $dvdID = $data['dvdID'];
      return DB::table('reviews')
          ->select('id', 'title', 'description', 'rating')
          ->where('dvd_id', '=', "$dvdID")->get();
    }
  }
 ?>
