@extends('layouts.admin')

@section('title' , 'Products')

@section('content')

<div class="container-fluid d-flex justify-content-end">
    <a href="{{route('products.create')}}"><button type="button" class="btn btn-outline-primary mb-2">Create News</button></a>
    <div class="ml-2">
        <a href="{{route('products.trashed')}}"><button type="button" class="btn btn-outline-danger mb-2">Trashed</button></a>
    </div>
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
            <td>{{$product->PriceFormmated}}</td>
            <td>{{$product->compare_price}}</td>
            <td>{{$product->status}}</td>
            <td>
                <a href="{{$product->image_url}}">
                    <img src="{{$product->image_url}}" width="60" alt="">
                </a>
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
{{$products->links()}}
@endsection('content')