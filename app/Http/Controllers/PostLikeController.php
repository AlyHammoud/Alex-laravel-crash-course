<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post1, Request $request)
    {
        //$post = Post::find($id); instead of doing this w used relation ship to get it directly
        
        if($post1->likedBy($request->user())){
            return response(null, 409);
        }
        $post1->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Post $post1, Request $request)
    {
        $request->user()->likes()->where('post_id', $post1->id)->delete();
        return back();
    }
}
