<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Game;
use App\Group;
use App\Student;
use App\Step;
use App\Team;
use App\Rule;

class AdminController extends Controller
{
  public function __construct(){
    // Middleware ADMIN => only authentified users who are admins can execute functions in this controller
    $this->middleware('admin');
  }

  // ==================
  // CONFIGURATION
  public function getConfiguration(){
    $configuration = array(
      "maxTeamCount" => setting('app.max_teams'),
      "studentsPerTeam" => config('app.max_students'),
    );
    return $configuration;
  }

  public function updateConfiguration(Request $request){
    setting(['app.max_teams' => $request->maxTeamCount]);
    setting(['app.max_students' => $request->studentsPerTeam]);
    return response()->json(['success' => true, 'message' => 'Configuration mise à jour'], 200);
  }

  // ==================
  // STUDENTS
  public function getStudents(){
    return Student::where('admin', 0)->orderBy('team_id')->get();
  }

  // ==================
  // ADMINS
  public function getAdmins(){
    return Student::where('admin', 1)->where('id', '!=', 1)->get();
  }

  public function deleteAdmin(Request $request){
    if($request->id != auth()->user()->id){
      $admin = Student::find($request->id);
      $admin->delete();
      return response()->json(['success' => true, 'message' => 'Administrateur supprimé'], 200);
    } else {
      return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas vous supprimer vous même'], 422);
    }
  }

  public function createAdmin(Request $request){
    $request->validate([
        'login' => 'unique:students',
        'first_name' => 'required',
        'last_name' => 'required',
    ]);

    $admin = new Student;
    $admin->fill($request->all());
    $admin->admin = 1;
    $admin->save();
    return response()->json(['success' => true, 'message' => 'Administrateur créé'], 200);
  }


  // ==================
  // GROUPS
  public function getGroups(){
    return Group::withCount('teams')->get();
  }

  public function generateGroups(Request $request){
    // Check if there are enough groups for the number of teams;
    if(($request->nbGroups * $request->teamsPerGroup) >= count(Team::all())){
      // Delete the already existing groups
      Team::all()->each(function($team){
        $team->group_id = null;
        $team->save();
      });
      Group::all()->each(function($group){
        $group->delete();
      });

      // reset the id autoincrement to 0 so the ids are 1, 2, 3 etc...
      DB::statement("ALTER TABLE groups AUTO_INCREMENT=0");

      // Create the groups
      for($i = 0; $i < $request->nbGroups; $i++){
        $group = new Group;
        $group->name = '10' . $i;
        $group->save();
      }

      // Put the teams in the groups
      $i = 1;
      $counter = 0;
      Team::all()->shuffle()->each(function($team) use ($request, $counter, $i){
        if($counter == $request->teamsPerGroup) $i++;
        $team->group_id = $i;
        $team->save();
        $counter++;
      });

      // Return the new groups
      return response()->json(['success' => true, 'message' => 'Poules générées', 'groups' => Group::withCount('teams')->get()], 200);
    } else {
      return response()->json(['success' => false, 'message' => "Il n'y a pas assez de poules pour la totalité des équipes"], 422);
    }
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
