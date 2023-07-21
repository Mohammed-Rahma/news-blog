@extends('layouts.admin')

@section('content')
<h2 class="mb-4">{{$title}}</h2>

<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf 
    @include('admin.products._form')
</form>

@endsection('content') 