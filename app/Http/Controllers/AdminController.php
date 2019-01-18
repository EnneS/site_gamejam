<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Group;
use App\Student;
use App\Step;
use App\Team;
use App\Rule;

class AdminController extends Controller
{
  public function __construct(){
       $this->middleware('admin');
  }

  // GETTERS
  public function getStudents(){
    return Student::where('admin', 0)->get();
  }

  public function getTeams(){
    return Team::with('game')->get();
  }

  public function getGroups(){
    return Group::all();
  }

  public function getRules(){
    return Rule::all();
  }

  public function getSteps(){
    return Steps::all();
  }

  public function deleteRule(Request $request){
    $rule = Rule::find($request->id);
    $rule->delete();
    return response()->json(['success' => true, 'message' => 'Règle supprimée'], 200);
  }

  public function getRule(Request $request){
    $rule = Rule::find($request->id);
    return $rule;
  }

  public function updateRule(Request $request){
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $rule = Rule::find($request->id);
    $rule->fill($request->all());
    $rule->save();
    return response()->json(['success' => true, 'message' => 'Règle mise à jour'], 200);
  }

  public function createRule(Request $request){
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $rule = new Rule;
    $rule->fill($request->all());
    $rule->save();
    return response()->json(['success' => true, 'message' => 'Règle créée'], 200);
  }
}
