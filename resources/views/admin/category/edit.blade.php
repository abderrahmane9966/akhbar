@extends('layouts.app')

@section('content')

<div class="container" style="padding-top: 8%  ">
    <div class="card container">
        <div class="card-body">

            <p class="card-text"> <span><a href="{{route('categories.index')}}">Back</a></span> Categorie Name : {{$categories->title}}</p>
        </div>
    </div>
</div>



<div class="container" style="padding-top: 2% ">
    <form action="{{ route('categories.update',$categories->id)}}" method="Post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="exampleFormControlInput1">Categorie Name</label>
            <input type="text" name="title" value="{{$categories->title}}" class="form-control" placeholder="categorie title">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Categorie Image</label>
            <input type="file" name="image" class="form-control-file" require>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

</div>
@endsection