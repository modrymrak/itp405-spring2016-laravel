@extends('layouts.master')

@section('title')
  Google Map API
@endsection

@section('extraTags')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsE9bj4En3EUdUhkPjm2c6QRYQljt4Rz4&callback=initMap"
    async defer></script>
@endsection


@section('content')
  <h1>
     Google Map API
  </h1>
  <ul class="errorListRed" id="errorList">
  </ul>
{{-- Google Map API sample used modified from https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple --}}
  <form role="form" class = "form-horizontal" action="/API/google" method="get">
    <div class="form-group">
      <label for = "address" class = "col-md-2 control-label ">Address: </label>
      <div class = " col-md-4">
        <input id="address" type="text" name="address" class="form-control" >
      </div>
      <div class = "col-md-4" >
        <input id="submit" type="submit" value="Find" class="form-control btn btn-primary">
      </div>
    </div>
  </form>
  <div id='map' class="mapObject">
  </div>
  <script>
  var map;
  var geocoder;
  var marker, prevMarker;
  function initMap() {
    var status = "{{$status}}";
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: {lat: {{$location->lat}}, lng: {{$location->lng}} }
    });
    if(status == "OK"){
      marker = new google.maps.Marker({
        map: map,
        position: {lat: {{$location->lat}}, lng: {{$location->lng}} }
      });
    }else if(status == "ZERO_RESULTS"){
      var li = document.createElement("li");
      var text = document.createTextNode('Address not found.');
      li.appendChild(text);
      document.getElementById('errorList').appendChild(li);
    }else if(status != "empty"){
      var li = document.createElement("li");
      var text = document.createTextNode('Geocode was not successful for the following reason: ' + status);
      li.appendChild(text);
      document.getElementById('errorList').appendChild(li);
    }
  }
  </script>

@endsection
