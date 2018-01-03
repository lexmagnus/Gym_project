<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chat;
use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function getPT()
    {
        $posts = Chat::orderBy('created_at', 'asc')->get();
        return view('pt',['posts' => $posts]);
    }

    public function postCreate(Request $request)
    {
        $this->validate($request,
            [
            'body' =>  'required|max:1000'
            ]);
        $post = new Chat();
        $post->body = $request['body'];
        $message = 'There was an error!';
        if($request->user()->chats()->save($post)){
            $message = 'Message send';
        }
        return redirect()->route('pt')->with(['message'=> $message]);
    }
}
