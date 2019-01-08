<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;
use App\Game;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function createTeam(Request $request){
      $user = \App\Student::where('id', Auth::user()['id'])->first();

      // On vérifie si jamais que l'utilisateur n'a pas déjà une équipe.
      if($user->team_id == null){
        // Création de l'équipe et du jeu
        $team = new Team;
        $team->name = $request['teamName'];
        $team->save();

        $game = new Game;
        $game->name = $request['gameName'];
        $game->description = $request['gameDesc'];
        $game->save();

        $team->game_id = $game->id;
        $team->save();

        $game->team_id = $team->id;
        $game->save();

        // Ajout de l'équipe à l'utilisateur connecté
        $user = \App\Student::where('id', Auth::user()['id'])->first();
        $user->team_id = $team->id;
        $user->save();

        return $team;
      } else {
        return response()->json(['error' => 'Cet utilisateur a déjà une équipe'], 402);
      }
    }

    public function editTeam(Request $request){
      $user = Auth::user();

      // On vérifie qu'il a déjà une équipe
      if($user->team_id != null){
        $team = $user->team;
        $game = $team->game;

        // Save jaquette / zip
        if($request['jaquette'] != "null"){
          $isValid = $this->validate($request, [
            'jaquette' => 'mimes:jpeg,png|max:6144|dimensions:min_width=300,min_height=300',
          ]);

          // On upload
          $extension = $request->jaquette->guessExtension();
          $fileName = 'jaquette.' . $extension;
          $request->jaquette->storeAs('public/games/' . $user->team_id . '/', $fileName);
          $game->jaquette_uploaded = true;
        }

        if($request['zip'] != "null"){
          $isValid = $this->validate($request, [
            'zip' => 'mimes:zip|max:51200', // 50 Mo
          ]);

          // On upload
          $request->zip->storeAs('public/games/' . $user_team_id . '/', 'zip.zip');
          $game->zip_uploaded = true;
        }

        $team->name = $request['teamName'];
        $game->name = $request['gameName'];
        $game->description = $request['gameDesc'];
        $team->save();
        $game->save();
        return response()->json(['success' => true], 200);
      } else {
        return response()->json(['error' => 'Cet utilisateur n\'a pas d\'équipe'], 402);
      }
    }

  public function allTeam(){
      return Team::with('students')->get();
    }
}
