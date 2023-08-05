@extends('layouts.admin')

@section('title' , 'categories')

@section('content')

<div class="ml-4 mr-4">

    <div class="container-fluid d-flex justify-content-end">
        <a href="{{route('categories.create')}}"><button type="button" class="btn btn-outline-primary mb-2">Create</button></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name Category</th>
                <th>Products Count</th>
                <th></th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <th>{{$category->products_count}}</th>
                <td> <a href="{{route('categories.edit' , $category->id)}}">Edit</a> </td>
                <td> 
                    <form action="{{route('categories.destroy' , $category->id)}}" method="post">
                        @csrf 
                        @method('delete')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection('content')