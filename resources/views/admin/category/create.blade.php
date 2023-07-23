@extends('layouts.admin')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
<div class="ml-4 mr-4">

    <form action="{{route('categories.store')}}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <label for="name"> Create Category</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Porduct Name" value="{{old('name' , $categories->name)}}">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
</div>
@endsection('content')