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

<div class="row">
    <div class="col-md-8">
        <div class="form-floating mb-3">
            <label for="name">Name Product</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" placeholder="Porduct Name" value="{{old('name' , $product->name)}}">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror " id="slug" name="slug" placeholder="Slug" value="{{old('slug' , $product->slug)}}">
            @error('slug')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug">Category_id</label>
            <select name="category_id" id="category_id" class="form-control form-select ">
                <option>Select Category</option>
                @foreach($categories as $category)
                <option @selected ($category->id == old('category_id', '$product->category_id')) value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror " id="price" name="price" placeholder="Price" value="{{old('price' , $product->price)}}">
            @error('price')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="compare_price">Compare Price</label>
            <input type="number" class="form-control  @error('compare_price') is-invalid @enderror" id="compare_price" name="compare_price" placeholder="Compare Price" value="{{old('compare_price' , $product->compare_price)}}">
            @error('compare_price')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="status">Status</label>
            <div>
                <option></option>
                @foreach ($status_options as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_{{$key}}" value="{{$key}}" @checked($key==old('status', $product->status))>
                    <label class="form-check-label" for="status_{{$key}}">
                        {{$value}}
                    </label>
                </div>
                @endforeach

            </div>

        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{old('description' , $product->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" placeholder="Short Description" rows="2">{{old('short_description' , $product->short_description)}}</textarea>
        </div>


        <div class="mb-3">
            <label for="formFile">Image</label>
            <input class="form-control" type="file" name="image" id="formFile">
        </div>

    </div>

</div>

<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">{{$submit??'Save'}}</button>
</div>