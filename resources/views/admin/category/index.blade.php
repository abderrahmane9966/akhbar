@extends('layouts.app')

@section('content')


<div class="jumbotron container">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="{{route('categories.create')}}" role="button">Create</a>
</div>

<div class="container">
    @if($message = Session::get('success'))
    <div class="alert alert-primary" role="alert">
        {{$message}}
    </div>
    @endif
</div>

<div class="container">
    <form action="{{route('search-categories')}}" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <input type="text" name="search_categories" class="form-control" placeholder="Categorie Search">
            </div>

            <div class="form-group col-md-6">
                <button class="btn btn-primary" type="submit">SEARCH</button>
            </div>
        </div>

    </form>
</div>

<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Id</th>
                <th scope="col" style="width: 400px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 0;
            @endphp

            @foreach($categories as $category)
            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$category->title}}</td>
                <td>{{$category->id}} </td>
                <td>

                    <div class="row">
                        <div class="col-sm">
                            <a class="btn btn-success" href="{{route('categories.edit',$category->id)}}">Edit</a>
                        </div>
                        <div class="col-sm">
                            <a class="btn btn-primary" href="{{route('categories.show',$category->id)}}">Show</a>
                        </div>
                        <div class="col-sm">
                            <form action="{{route('categories.destroy',$category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>

    {{ (!is_null ($showLinks) &&  $showLinks ) ? $categories->links() : '' }}

</div>

@endsection