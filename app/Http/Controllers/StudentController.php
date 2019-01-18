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
   * Get all missions from the authentified user.
   *
   * @return \App\Team
   */
  public function getTeam(){
    $user = Auth::user();
    if($user != null){
      $team = $user->team;
      if($team != null){
        $payload = array();
        array_push($payload, $team); // On récupère l'équipe
        array_push($payload, $team->students); // Ses membres
        array_push($payload, $team->game); // Son jeu
        return $payload;
      } else {
        return null;
      }
    } else {
      return response()->json(['error' => 'not connected'], 402);
    }
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
    $user->team_id = $request['teamId'];
    $user->save();
    return $user->team_id;
  }
}
