<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sale;
use App\Message;
use Auth;

class MessageController extends Controller
{
    public function index()
    {
        $message = Message::find($request->message);
        return view('', compact('message'));
    } 

    
    public function messages(Request $request){
        
        $this->validate($request, [
            'message_id' => '', 
             'title'=>  '',
              'priority'=> '', 
              'message'=> '', 
             'status'=> ''
             ]);
        $message = new Message([
                'user_id' => Auth::user()->id,
                'message_id' => Str::random(10),
                'title' => $data['title'],
                'priority' => $data['priority'],
                'message' => $data['message'],
                'status' => "Open"
                ]);
        $message->save();    
        

        return back();

    }

  
}
