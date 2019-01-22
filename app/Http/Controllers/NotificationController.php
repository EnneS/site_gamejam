<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications(){
      $notifications = array();
      $user = auth()->user();

      // First, get the join requests notification
      $team = $user->team;
      $joinRequests = count($team->joinRequests);
      if($joinRequests > 0){
        array_push($notifications, "Votre équipe a " . $joinRequests . " demande(s) d'adhésion.");
      }

      // TODO:  Then get the global notifications

      return $notifications;
    }
}
