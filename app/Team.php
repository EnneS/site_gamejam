<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function students() {
        return $this->hasMany('App\Student');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function game(){
        return $this->hasOne('App\Game');
    }

    public function joinRequests(){
      return $this->hasMany('App\JoinRequest')->with('student');
    }
}
