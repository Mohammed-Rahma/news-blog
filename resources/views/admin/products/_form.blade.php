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
    <div class="col-md-6">
        <x-form.input label="Product Name" id="name" name="name" value="{{$product->name}}" />
        <x-form.input label="Slug" id="slug" name="slug" value="{{$product->slug}}" />
        <x-form.input label="Price" id="price" name="price" value="{{$product->price}}" type="number" />
        <x-form.input label="Compare Price" id="compare_price" name="compare_price" value="{{$product->compare_price}}" type="number" />
        <x-form.textarea label="Description" name="description" id="description" value="{{$product->description}}" />
        <x-form.textarea label="Short Description" name="short_description" id="short_description" value="{{$product->short_description}}" />
    </div>

    <div class="col-md-6">
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
            <label for="slug">Category Name</label>
            <select name="category_id" id="category_id" class="form-control form-select ">
                <option></option>
                @foreach($categories as $category)
                <option @selected($category->id == old('category_id', '$product->category_id')) value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="gallery">Gallery</label>
            <div>
                <input class="form-control" type="file" name="gallery[]" multiple id="gallery">
            </div>
            @if ($gallery ?? false)
            <div class="row">
                @foreach($gallery as $image)
                <div class="col-md-3">
                    <img src="{{$image->GalleryImage}}" class="img-fluid" alt="">
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="mb-3">
            <img src="{{$product->ImageURL}}" width="70" alt="">
            <x-form.input label="image" type="file" name="image" id="image" />
        </div>
    </div>

</div>

<div class="col-auto">
    <button id="submit" class="btn btn-primary mb-3">{{$submit??'Save'}}</button>
</div>