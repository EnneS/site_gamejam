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

  public function deleteStudent(Request $request){
    $student = Student::find($request->id);
    // Check if the student has a team
    if($student->team_id != null){
      $student->team_id = null;

      $team = $student->team;
      // If he is the last student in the team, delete it
      if($team->students->count() == 0){
        $team->delete();
      }
    }
    // Then delete the student
    $student->delete();
    return response()->json(['success' => true, 'message' => 'Etudiant supprimé'], 200);
  }

  public function readStudentList(){
    $students = Student::where('admin', 0)->delete();
    try {
      $file_lines = file(storage_path('app/studentlist.dat'));
    } catch (\Exception $e){
      return response()->json(['success' => false, 'message' => 'Fichier studentlist.dat manquant dans le dossier storage/app'], 422);
    }
    foreach ($file_lines as $line) {
      $inputs = explode(":", $line);
      $name = explode(" ", $inputs[1]);

      $i = 0;
      $last_name = '';
      $first_name = '';
      while(isset($name[$i]) && $name[$i] == strtoupper($name[$i])){
        $last_name .= $name[$i] . ' ';
        $i++;
      }
      while(isset($name[$i]) && $name[$i] != strtoupper($name[$i])){
        $first_name .= $name[$i] . ' ';
        $i++;
      }
      $login = $inputs[0];

      if(Student::where('login', $login)->first() == null){
        $student = new Student;
        $student->first_name = rtrim($first_name);
        $student->last_name = rtrim($last_name);
        $student->login = $login;
        $student->save();
      }
    }
    return response()->json(['success' => true, 'message' => 'Etudiants générés', 'students' => Student::where('admin', 0)->get()], 200);
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
    $login = $request->login;
    $user = Student::where('login', $login)->first();
    if($user == null){
      $request->validate([
          'login' => 'unique:students',
          'first_name' => 'required',
          'last_name' => 'required',
      ]);
      $admin = new Student;
      $admin->fill($request->all());
      $admin->admin = 1;
      $admin->save();
    } else {
      // Check if the user has a team
      if($user->team_id != null){
        $team = $user->team;
        $user->team_id = null;
        $user->save();
        // If he is the last member in the team, delete it
        if($team->students->count() == 0){
          $team->delete();
        }
      }
      $user->admin = 1;
      $user->save();
    }
    return response()->json(['success' => true, 'message' => 'Administrateur créé'], 200);
  }


  // ==================
  // GROUPS
  public function getGroups(){
    return Group::withCount('teams')->get();
  }

  public function generateGroups(Request $request){
    // Check valid group names
    $names = explode(',', $request->groupsNames);
    if(count($names) == $request->nbGroups){
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
          $group->name = $names[$i];
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
    } else {
      return response()->json(['success' => false, 'message' => "Le nombre de noms de poules ne correspond pas au nombre de poules"], 422);
    }
  }

  public function deleteGroups(){
    Group::all()->each(function($group){
      $group->delete();
    });
    return response()->json(['success' => true, 'message' => 'Poules supprimées'], 200);
  }


  // ==================
  // TEAMS
  public function getTeams(){
    return Team::with('game')->withCount('students')->get();
  }

  public function getTeam(Request $request){
    $team = Team::with(['game', 'group', 'students'])->find($request->id);
    return $team;
  }

  public function deleteTeams(){
    Team::all()->each(function($team){
      // Remove the team from every student in the team
      $team->students()->each(function($student){
        $student->team_id = null;
        $student->save();
      });
      // Then delete the team
      $team->delete();
    });
    return response()->json(['success' => true, 'message' => 'Equipes supprimées'], 200);
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
