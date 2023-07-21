@if ($errors->any())
<div class="alert alert-danger">
    You have some errors
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="form-floating mb-3">
        <label for="name">Name Product</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Porduct Name" value="{{old('name' , $product->name)}}">
    </div>
    <div class="mb-3">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{old('slug' , $product->slug)}}">
    </div>
    <div class="mb-3">
        <label for="slug">Category_id</label>
        <select name="category_id" id="category_id" class="form-control form-select">
            <option></option>
            @foreach($categories as $category)
            <option @selected ($category->id == $product->category_id) value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{old('price' , $product->price)}}">
    </div>
    <div class="mb-3">
        <label for="compare_price">Compare Price</label>
        <input type="number" class="form-control" id="compare_price" name="compare_price" placeholder="Compare Price" value="{{old('compare_price' , $product->compare_price)}}">
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{old('description' , $product->description)}}</textarea>
    </div>
    <div class="mb-3">
        <label for="short_description">Short Description</label>
        <textarea class="form-control" id="short_description" name="short_description" placeholder="Short Description" rows="2">{{old('short_description' , $product->short_description)}}</textarea>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
        <label class="form-check-label" for="flexRadioDefault2">
            Default checked radio
        </label>
    </div>

    <div class="mb-3">
        <label for="formFile">Image</label>
        <input class="form-control" type="file" name="image" id="formFile">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">{{$submit??'Save'}}</button>
    </div>
</div>