<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
        $posts = Post::get();
        return view('posts.index',[
            'posts' => $posts
        ]);
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


        // $request->user()->posts()->create([
        //     'body' => $request->body
        // ]);
        //or

        //var_dump($request->user() === auth()->user());die;  TRUE

        //post through user and post relation, check User MODEL hasMany
        $request->user()->posts()->create($request->only('body'));
        return back();
    }
}
