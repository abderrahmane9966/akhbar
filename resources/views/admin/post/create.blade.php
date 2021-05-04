@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 8%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> <span><a href="{{route('posts.index')}}">Back</a></span> Some quick exampled make up the bulk of the card's content.</p>
        </div>
    </div>
</div>



<div class="container" style="padding-top: 2% ">
    <form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Post Title</label>
            <input type="text" name="title" class="form-control" placeholder="post title" require>
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Post Content</label>
            <input type="text" name="content" class="form-control" placeholder="post content" require>
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Post Image</label>
            <input type="file" name="featured_image" class="form-control-file" require>
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Categorie Name</label>
            <select name="category_id" id="category_id" class="form-control" require>
                <option>Select Categorie</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">
                    {{$category->title}}
                </option>
                @endforeach
            </select>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

</div>
@endsection