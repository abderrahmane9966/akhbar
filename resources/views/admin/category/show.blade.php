@extends('layouts.app')


@section('content')

<div class="container" style="padding-top: 8%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> <span><a href="{{route('categories.index')}}">Back</a></span> Categorie : {{$categories->title}}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Categorie Name : {{$categories->title}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <p class="card-text"> Categorie ID : {{$categories->id}}</p>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 2%  ">
    <div class="card container">
        <div class="card-body">
            <img src="{{asset('storage/' . $categories->image)}}" alt="..." class="img-thumbnail">
        </div>
    </div>
</div>


@endsection