<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;

class RuleController extends Controller
{
  public function allRules(){
      return Rule::all();
    }
}
