<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate();
        return view('admin.post.index')->with([
            'posts' => $posts,
            'showLinks' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$request->validate([
        //  'title' => 'required',
        // 'content' => 'required',
        // 'user_id' => 'required',
        // 'category_id' => 'required',
        // ]);

        //dd($request->all());

        $post = new Post;


        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        if (intval($request->input('category_id')) != null) {
            $post->category_id = intval($request->input('category_id'));
        }
        $post->date_written = Carbon::now()->format('Y-m-d H:i:s');
        $post->votes_up  = 0;
        $post->votes_down  = 0;

        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->featured_image->store('image');
        }

        $post->save();


        return redirect()->route('posts.index')->with('succes', 'Post added succesfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $user = Auth::user();
        $category = $post->category;
        return view('admin.post.show')->with([
            'author' => $user,
            'category' => $category,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.post.edit')->with([
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        if (intval($request->input('category_id')) != null) {
            $post->category_id = intval($request->input('category_id'));
        }
        $post->date_written = Carbon::now()->format('Y-m-d H:i:s');
        $post->votes_up  = 0;
        $post->votes_down  = 0;

        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->featured_image->store('image');
        }

        $post->update($request->all());



        return redirect()->route('posts.index')->with('succes', 'Post updated succesfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('succes', 'Post Deleted succesfuly');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_posts' => 'required',
        ]);
        $searchTerm = $request->input('search_posts');

        $posts = Post::where(
            'title',
            'LIKE',
            '%' . $searchTerm . '%'
        )->get();

        if (count($posts) > 0) {
            return view('admin.post.index')->with([
                'posts' => $posts,
                'showLinks' => false,
            ]);
        }
        return redirect()->route('posts.index')->with('succes', 'Nothing Found !!');
    }
}
