<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
    public function label(){
      return $this->belongsTo('App\Models\Label');
    }
    public function rating(){
      return $this->belongsTo('App\Models\Rating');
    }
    public function genre(){
      return $this->belongsTo('App\Models\Genre');
    }

    protected $hidden = ['release_date', 'label_id', 'sound_id', 'format_id', 'created_at', 'updated_at', 'genre', 'rating'];
}
