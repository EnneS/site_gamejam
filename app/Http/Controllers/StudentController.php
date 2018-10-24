<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

  /**
   * Get all missions from the authentified user.
   *
   * @return \App\Team
   */

  public function getTeam(){
    $team = Auth::user()->team;
    if($team != null){
      return $team;
    } else {
      return null;
    }
  }
}
