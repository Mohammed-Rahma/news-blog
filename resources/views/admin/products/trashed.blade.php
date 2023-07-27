@extends('layouts.admin')

@section('title' , 'Products')

@section('content')
<div class="container-fluid d-flex justify-content-end">
</div>

@if(session()->has('success'))
<div class="alert alert-success mt-2">{{session('success')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Delete At</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>
                <a href="{{$product->image_url}}">
                    <img src="{{$product->image_url}}" width="60" alt="">
                </a>
            </td>
            <td>{{$product->delete_at}}</td>

            <td>
                <form action="{{route('products.restore' , $product->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-sm btn-primary"><i class="fas fa-trash"></i> Restore</button>
                </form>
            </td>
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