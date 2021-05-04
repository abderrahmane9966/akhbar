<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate();
        return CommentResource::collection($comments);
    }

    public function show($id)
    {
        $post = Post::find($id);
        $co = $post->comments();
        return CommentResource::collection($co);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->date_written = Carbon::now()->format('Y-m-d H:i:s');

        $comment->save();
        return new CommentResource($comment);
    }
}
