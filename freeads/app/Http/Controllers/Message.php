<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use App\Jobs\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Message extends Controller
{
    public function index()
    {
        $items = MessageModel::all();

        return view('message',['items' => $items]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

       

        
       

        $message = MessageModel::create([
            'content' => $request->input('content'),
            'user'=> Auth::user()->name
        ]);
        Got::dispatch($message);

     

         return back()->with('success', 'Mesage send ');
    }
}
