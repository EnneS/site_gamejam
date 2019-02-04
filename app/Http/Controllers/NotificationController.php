<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function getNotifications(){
      $notifications = array();
      $user = auth()->user();

      // First, get the join requests notification
      $team = $user->team;
      if($team){
        $joinRequests = count($team->joinRequests);
        if($joinRequests > 0){
          array_push($notifications, "Votre équipe a " . $joinRequests . " demande(s) d'adhésion.");
        }
      }

      $n = Notification::all();
      foreach($n as $notif){
        array_push($notifications, $notif->body);
      }

      return $notifications;
    }
}
