<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hall_of_fame';

    public function games(){
        return $this->hasMany('App\Game')->select('hall_of_fame_id', 'hash', 'name');
    }
}
