<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
  /**
   * Return the authentified user (or null if he is not authentified)
   *
   * @return \App\User
   */
  public function getUser(){
    return response()->json(['user' => auth()->user()]);
  }

  /**
   * Get the authentified user's team.
   *
   * @return \App\Team
   */
  public function getTeam(){
    $user = Auth::user();
    $team = \App\Team::with(['students', 'game'])->where('id', $user->team_id)->first();
    return response()->json(['success' => true, 'team' => $team], 200);
  }

  public function leaveTeam(){
    $user = Auth::user();
    $team = \App\Team::with(['students', 'game'])->where('id', $user->team_id)->first(); // Avant d'enlever l'équipe on la récupère

    $user->team_id = null; // On enlève l'équipe à l'utilisateur
    $user->save();
    if($team->students->count() == 1){ // Il s'agit du dernier membre de l'équipe
      // On supprime l'équipe et son jeu.
      // Storage (dossier de l'équipe contenant jaquette & zip)
      File::deleteDirectory(storage_path('app/public/games/' . $team->id));
      // Data
      $team->game->delete();
      $team->delete();
    }

    return response()->json(['success' => true], 200);
  }

  public function joinTeam(Request $request){
    $user = Auth::user();
    $team = \App\Team::find($request['teamId']);
    // On vérifie que la team peut encore accepter des membres
    if(count($team->students) <= config('app.max_students')){
      $user->team_id = $request['teamId'];
      $user->save();
      return $user->team_id;
    } else {
      return response()->json(['error' => "Cette équipe a atteint le nombre maximum d'élèves"], 423);
    }
  }
}
