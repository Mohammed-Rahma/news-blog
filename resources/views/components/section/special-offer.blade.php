<section class="special-offer section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Special Offer</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-4 col-12">
                        <!-- Start Single Product -->
                        <x-card.product-card :product="$product" />
                        <!-- End Single Product -->
                    </div>
                    @endforeach

                </div>
                <!-- Start Banner -->
                <div class="single-banner right" style="background-image:url('https://via.placeholder.com/730x310');margin-top: 30px;">
                    <div class="content">
                        <h2>Samsung Notebook 9 </h2>
                        <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                            incididunt ut labore.</p>
                        <div class="price">
                            <span>$590.00</span>
                        </div>
                        <div class="button">
                            <a href="product-grids.html" class="btn">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- End Banner -->
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <div class="offer-content">
                    <div class="image">
                        <img src="https://via.placeholder.com/510x600" alt="#">
                        <span class="sale-tag">-50%</span>
                    </div>
                    <div class="text">
                        <h2><a href="product-grids.html">Bluetooth Headphone</a></h2>
                        <ul class="review">
                            <li><i class="lni lni-star-filled"></i></li>
                            <li><i class="lni lni-star-filled"></i></li>
                            <li><i class="lni lni-star-filled"></i></li>
                            <li><i class="lni lni-star-filled"></i></li>
                            <li><i class="lni lni-star-filled"></i></li>
                            <li><span>5.0 Review(s)</span></li>
                        </ul>
                        <div class="price">
                            <span>$200.00</span>
                            <span class="discount-price">$400.00</span>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry incididunt ut
                            eiusmod tempor labores.</p>
                    </div>
                    <div class="box-head">
                        <div class="box">
                            <h1 id="days">000</h1>
                            <h2 id="daystxt">Days</h2>
                        </div>
                        <div class="box">
                            <h1 id="hours">00</h1>
                            <h2 id="hourstxt">Hours</h2>
                        </div>
                        <div class="box">
                            <h1 id="minutes">00</h1>
                            <h2 id="minutestxt">Minutes</h2>
                        </div>
                        <div class="box">
                            <h1 id="seconds">00</h1>
                            <h2 id="secondstxt">Secondes</h2>
                        </div>
                    </div>
                    <div style="background: rgb(204, 24, 24);" class="alert">
                        <h1 style="padding: 50px 80px;color: white;">We are sorry, Event ended ! </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>