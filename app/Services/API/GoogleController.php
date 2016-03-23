<?php

namespace App\Services\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

class location{
  public $lat;
  public $lng;
}

class GoogleController extends Controller
{
    function showMap(Request $request){
      $address = $request->input('address');
      $address = urlencode($address);
      $key = strtolower($address);
      if(!$address){
        $location = new location;
        $location->lat =  34.0522342;
        $location->lng = -118.2436849 ;
        return view("googleMap", [
          'status' => "empty",
          'location' =>$location
        ]);
      }
      if(Cache::has($key)){
        $location = Cache::get($key);
        return view("googleMap", [
            'status' => "OK",
          'location' =>$location
        ]);
      }else{
        $url="https://maps.googleapis.com/maps/api/geocode/json?address=%" . $address;
        $result = file_get_contents($url);
        $json = json_decode($result);
        if(strcmp($json->status, "OK") === 0){
          $location = $json->results[0]->geometry->location;
          Cache::put($key, $location, 30);
          return view("googleMap", [
            'status' => $json->status,
            'location' =>$location
          ]);
        }else{
          $location = new location;
          $location->lat =  34.0522342;
          $location->lng = -118.2436849 ;
          return view("googleMap", [
            'status' => $json->status,
            'location' =>$location
          ]);
        }
      }
    }
}
