<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Group;
use App\Student;
use App\Step;
use App\Team;

class AdminController extends Controller
{
  public function __construct(){
       $this->middleware('admin');
  }

  // GETTERS
  public function getStudents(){
    return Student::where('admin', 0)->get();
  }
}
