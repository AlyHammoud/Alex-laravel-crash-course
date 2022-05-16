<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        
        //$posts = Post::orderBy('created_at', 'DESC')->get();
                                                            //user and likes are hasMany in Post Model, and used in postView
                                                            //to avoid multi queryies we used them in with
                                                            ///composer require barryvdh/laravel-debugbar --dev
                                                            
        //$posts = Post::orderBy('created_at', 'DESC')->with(['user', 'likes'])->paginate(20);
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
        
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

    public function destroy(Post $post)
    {
        //use policy instead
        // if(!$post->ownedBy(auth()->user())){
        //     dd('no');
        // }
        // $post->delete();
        // return back();

        //sail artisan make:policy
        //generate a function and make the policy
        //in AuthServiceProvider add in polices that Model Post::class => PostPolicy::class
        //                 the name of the method defined in the policy


        $this->authorize('delete', $post);
        $post->delete();

        return back();

    }
}
