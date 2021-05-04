<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryPostsResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;


use function GuzzleHttp\json_encode;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::latest()->paginate(50);
        return PostResource::collection($post);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }

    public function postsByCategory($id)
    {
        $category = Category::find($id);
        $posts = $category->posts()->paginate();
        return PostResource::collection($posts);
    }

    public function votes(Request $request, $id)
    {



        $request->validate([
            'vote' => 'required'
        ]);

        $post = Post::find($id);

        if ($request->get('vote') == 'up') {

            $voters_up = json_decode($post->voters_up);
            if ($voters_up == null) {
                $voters_up = [];
            }

            if (!in_array($request->user()->id, $voters_up)) {

                $post->votes_up += 1;
                array_push($voters_up, $request->user()->id);
                $post->voters_up = json_encode($voters_up);
                $post->save();
            }
        }

        if ($request->get('vote') == 'down') {

            $voters_down = json_decode($post->voters_down);
            if ($voters_down == null) {
                $voters_down = [];
            }

            if (!in_array($request->user()->id, $voters_down)) {

                $post->votes_down += 1;
                array_push($voters_down, $request->user()->id);
                $post->voters_down = json_encode($voters_down);
                $post->save();
            }
        }


        return new PostResource($post);
    }
}
