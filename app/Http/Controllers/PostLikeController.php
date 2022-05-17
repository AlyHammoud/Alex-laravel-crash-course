<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        if($post1->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count())
        {
            $user = auth()->user();
            Mail::to($post1->user)->send(new PostLiked($user, $post1));
        }

        return back();
    }

    public function destroy(Post $post1, Request $request)
    {
        $request->user()->likes()->where('post_id', $post1->id)->delete();
        return back();
    }
}
