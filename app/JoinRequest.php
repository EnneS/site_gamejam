<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    public function student(){
      return $this->belongsTo('App\Student');
    }

    public function team(){
      return $this->belongsTo('App\Team');
    }
}
