
@extends('master')
@section('content')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="shop-grid-right.html">{{$product->categoryInfo->category_name}}</a> <span></span>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">


                                <figure class="border-radius-10">
                                    <img src="{{asset('uploads/product/'.$product->product_thumbnail)}}" alt="product image" />
                                </figure>

                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">

                                <div><img src="{{asset('uploads/product/'.$product->product_thumbnail)}}" alt="product image" /></div>

                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <span class="stock-status out-stock"> In Stock </span>
                            <h2 class="title-detail" id="dproduct_name">{{$product->product_name}}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">

                                    <span class="current-price text-brand" id="dproduct_descount_price">{{$product->product_sel_price}}</span>

                                </div>
                            </div>
                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Order Now</button>
                                   
                                </div>
                            </div>

                        <div class="font-xs">
                            <ul class="mr-50 float-start">

                                <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li>
                            </ul>
                        </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
