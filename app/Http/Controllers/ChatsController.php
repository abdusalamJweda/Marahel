<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ChatsController extends Controller
{
    public function getChatList(Request $request){
        $user = $request->user();
        
        $receiverIds = Message::where('user_id', $user->id)->pluck('receiver_id')->toArray();
        $receiverIds = array_unique($receiverIds);
        $users = User::whereIn('id', $receiverIds)->get();
        return $users;
    }
    public function getChat(Request $request){
        $user = $request->user();

        $request = $request->validate([
            "receiver_id" => 'required',
        ]);
        $request["receiver_id"] = $request["receiver_id"] +0;
        $messages = Message::where(function ($query) use($user, $request){
                                    $query->where('user_id', $user->id);
                                    $query->where('receiver_id', $request["receiver_id"]);
                                })->orWhere(function ($query) use($user, $request){
                                    $query->where('user_id', $request["receiver_id"]);
                                    $query->where('receiver_id', $user->id);
                                })->orderBy('created_at', 'asc')->get();

        return $messages;
    }
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = $request->user();
        $request = $request->validate([
            'message' => 'required',
            'receiver_id' => 'required',

        ]);
        $message = $user->messages()->create([
            'message' => $request['message'],
            'receiver_id' => $request['receiver_id']
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
