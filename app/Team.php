<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function students() {
        return $this->hasMany('App\Student')->select(array('id', 'team_id', 'first_name', 'last_name'));
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function game(){
        return $this->belongsTo('App\Game');
    }

    public function joinRequests(){
      return $this->hasMany('App\JoinRequest')->with('student');
    }
}
