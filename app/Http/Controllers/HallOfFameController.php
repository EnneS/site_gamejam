<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HallOfFame;

class HallOfFameController extends Controller
{
    public function getYears(){
      return HallOfFame::with('games')->has('games')->get();
    }
}
