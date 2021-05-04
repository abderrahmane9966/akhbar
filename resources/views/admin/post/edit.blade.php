@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 8%  ">
    <div class="card container">
        <div class="card-body">

            <p class="card-text"> <span><a href="{{route('posts.index')}}">Back</a></span> Post Name : {{$post->title}}</p>
        </div>
    </div>
</div>



<div class="container" style="padding-top: 2% ">
    <form action="{{ route('posts.update',$post->id)}}" method="Post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="exampleFormControlInput1">Post Title</label>
            <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Post title">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Post Content</label>
            <input type="text" name="content" value="{{$post->content}}" class="form-control" placeholder="Post Content">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Post Image</label>
            <input type="file" name="featured_image" class="form-control-file" require>
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Categorie Name</label>
            <select name="category_id" id="category_id" class="form-control" require>
                <option>{{$post->category->title}}</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">
                    {{$category->title}}
                </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>
@endsection