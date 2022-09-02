<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Project;

use App\Events\NotificationSent;

class NotificationController extends Controller
{
    public function getNotifications(Request $request){
        $user = $request->user();

        $notifications = Notification::where('receiver_id', $user->id)->get();
        return $notifications;
    }
    public function sendNotification(Request $request){
        $user = $request->user();
        $request = $request->validate([
            'receiver_id' => 'required',
            'project_id' => 'required',
        ]);

        $project = Project::find($request["project_id"]);

        $message = $user->name . " wants to add you to Project ". $project->name ."!";
        $notification = $user->notifications()->create([
            'message' => $message,
            'receiver_id' => $request['receiver_id'],
            'project_id' => $request['project_id']
        ]);
        broadcast(new NotificationSent($user, $notification))->toOthers();

        return ['status' => 'Notifications Sent!'];
    }
}
