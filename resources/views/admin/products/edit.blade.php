@extends('layouts.admin')

@section('content')

<h2 class="mb-4">{{$title}}</h2>
<form action="{{route('products.update' , $product->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- form method spoofing -->
    @method('put')
    @include('admin.products._form' , [
    'submit'=>'Update'
    ])
</form>

@endsection('content')