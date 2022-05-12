<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function store(Request $request)
    {
         $this->validate($request,[
             'body' => 'required'
         ]);

         /// since one user can have many posts we will use relation instead
        // Post::create([
        //      'user_id' => auth()->id(),  //auth->user()->id // are the same
        //      'body' => $request->body
        //  ]);


        $request->user()->posts()->create([
            'body' => $request->body
        ]);
        
        return back();
    }
}
