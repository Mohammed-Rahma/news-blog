@extends('layouts.admin')

@section('content')

<div class="ml-4 mr-4">

<form action="{{route('categories.store')}}" method="post">
    @csrf
    <div class="form-floating mb-3">
        <label for="name"> Create Category</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Porduct Name" value="{{old('name' , $categories->name)}}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
</form>
</div>
@endsection('content')