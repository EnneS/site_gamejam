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
    return Student::where('admin', 0)->orderBy('team_id')->get();
  }

  public function getGroups(){
    return Group::withCount('teams')->get();
  }

  // ==================
  // TEAMS
  public function getTeams(){
    return Team::with('game')->get();
  }

  public function getTeam(Request $request){
    $team = Team::with(['game', 'group', 'students'])->find($request->id);
    return $team;
  }

  // ==================
  // STEPS
  public function getSteps(){
    return Step::all();
  }

  public function getStep(Request $request){
    $step = Step::find($request->id);
    return $step;
  }

  public function deleteStep(Request $request){
    $step = Step::find($request->id);
    $step->delete();
    return response()->json(['success' => true, 'message' => 'Tutoriel supprimé'], 200);
  }

  public function updateStep(Request $request){
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $step = Step::find($request->id);
    $step->fill($request->all());
    $step->save();
    return response()->json(['success' => true, 'message' => 'Etape mise à jour'], 200);
  }

  public function createStep(Request $request){
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $step = new Step;
    $step->fill($request->all());
    $step->save();
    return response()->json(['success' => true, 'message' => 'Etape créée'], 200);
  }

  // ==================
  // RULES
  public function getRules(){
    return Rule::all();
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
