<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function group(){
        return $this->belongsTo('App/Group');
    }

    public function year(){
        return $this->belongsTo('App/HallOfFame');
    }
}
