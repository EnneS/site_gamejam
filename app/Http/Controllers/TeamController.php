<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;
use App\Game;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    function createTeam(Request $request){
      $user = \App\Student::where('id', Auth::user()['id'])->first();

      // On vérifie si jamais que l'utilisateur n'a pas déjà une équipe.
      if($user->team_id == null){
        // Création de l'équipe et du jeu
        $team = new Team;
        $team->name = $request['teamName'];
        $team->save();

        $game = new Game;
        $game->name = $request['gameName'];
        $game->description = "Description";
        $game->save();

        $team->game_id = $game->id;
        $team->save();
        // Ajout de l'équipe à l'utilisateur connecté
        $user = \App\Student::where('id', Auth::user()['id'])->first();
        $user->team_id = $team->id;
        $user->save();

      } else {
        return response()->json(['error' => 'Cet utilisateur a déjà une équipe'], 402);
      }
    }
}
