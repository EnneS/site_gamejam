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
    $user = auth()->user();
    if($user) $user->load('joinRequests');
    return response()->json(['user' => $user]);
  }

  /**
   * Get the authentified user's team.
   *
   * @return \App\Team
   */
  public function getTeam(){
    $user = Auth::user();
    $team = \App\Team::with(['students', 'game', 'joinRequests'])->where('id', $user->team_id)->first();
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

  // Send a join request
  public function joinTeam(Request $request){
    $user = Auth::user();
    $team = \App\Team::find($request['teamId']);
    // On vérifie que la team peut encore accepter des membres
    if(count($team->students)+1 <= config('app.max_students')){
      // Create a join request
      $joinRequest = new \App\JoinRequest;
      $joinRequest->team_id = $request['teamId'];
      $joinRequest->student_id = $user->id;
      $joinRequest->save();

      return response()->json(['success' => true, "message" => "Demande d'adhésion envoyée", "joinRequest" => $joinRequest], 200);
    } else {
      return response()->json(['success' => false, "message" => "Cette équipe a atteint le nombre maximum d'élèves"], 423);
    }
  }
}
