@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 8%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> <span><a href="{{route('posts.index')}}">Back</a></span> Product Name : {{$post->title}}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Title : {{$post->title}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Content : {{$post->content}}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Author : {{$author->name}}</p>
        </div>

    </div>
</div>



<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Categorie Name : {{$post->category->title}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Date Written : {{$post->date_written}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Votes Up : {{$post->votes_up}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Post Votes Down : {{$post->votes_down}}</p>
        </div>
    </div>
</div>



<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <img src="{{asset('storage/' . $post->featured_image)}}" alt="..." class="img-thumbnail">
        </div>
    </div>
</div>



@endsection