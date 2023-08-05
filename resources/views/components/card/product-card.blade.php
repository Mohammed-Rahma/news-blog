<div class="single-product">
    <div class="product-image">
        <img src="{{$product->imageURL}}" alt="#">
        <div class="button">  
            <a href="{{route('products-details' , $product->slug)}}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{$product->category->name}}</span>
        <h4 class="title">
            <a href="{{route('products-details' , $product->slug)}}">{{$product->name}}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{$product->price_formmated}}</span>
            @if($product->ComparePriceFormmated)
            <span class="discount-price">{{$product->ComparePriceFormmated}}</span>
            @endif                          
        </div>
    </div>
</div>