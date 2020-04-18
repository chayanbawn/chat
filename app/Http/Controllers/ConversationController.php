<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getChatsWith($id)
    {
        $messages = Message::where(static function($q) use ($id){
            $q->where('from', auth()->user()->id);
            $q->where('to', $id);
        })->orWhere(static function ($q) use ($id){
            $q->where('from', $id);
            $q->where('to', auth()->user()->id);
        })->get();

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
