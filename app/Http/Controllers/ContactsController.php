<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $users = User::where('id', '<>', auth()->user()->id)->get(['id', 'name', 'email', 'profile_image']);
        return response()->json($users);
    }

    public function getMessagesFor($id)
    {
        $messages = Message::where('from', $id)->orWhere('to', $id)->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message =  Message::create([
            'from' => auth()->user()->id,
            'to' => $request->get('to'),
            'message' => $request->get('message')

        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
