@extends('layouts.admin')

@section('title' , 'Products')

@section('content')

<div class="container-fluid d-flex justify-content-end">
    <a href="{{route('products.create')}}"><button type="button" class="btn btn-outline-primary mb-2">Create News</button></a>
</div>

@if(session()->has('success'))
<div class="alert alert-success mt-2">{{session('success')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Price</th>
            <th>Compare Price</th>
            <th>Status</th>
            <th>Image</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->category_name}}</td>
            <td>{{$product->slug}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->compare_price}}</td>
            <td>{{$product->status}}</td>
            <td>
                @if($product->image)
                <img src="{{asset('storage/'. $product->image)}}" width="60" alt="">
                @else
                <img src="https://placehold.co/100x100" width="60" alt="">
                @endif
            </td>
            <td><a href="{{route('products.edit' , $product->id)}}" class="btn btn-sm btn-outline-dark">Edit</a></td>
            <td>
                <form action="{{route('products.destroy' , $product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection('content')