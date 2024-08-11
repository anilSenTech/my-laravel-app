<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Chat; // Ensure the Chat event is correctly imported

class ChatController extends Controller
{
    public function index()
    {
        return view('welcome'); // Ensure this view exists
    }

    public function notFound()
    {
        return abort(404,'Not Found'); // Ensure this view exists
    }

    public function chat(Request $request)
    {
        $request->validate(
            [
                'username'=>'required',

            ]
            );
            $username = $request->username;

        return view('chat')->with(['name'=>$username]); // Ensure this view exists
    }

    public function broadcastChat(Request $request)
    {
        // Trigger the Chat event
        $request->validate([
            'username'=>'required',
            'msg'=>'required'
        ]);
        event(new Chat($request->username, $request->msg));
        return response()->json($request->all());
    }
}