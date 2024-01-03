@extends('master')
    @section('content')


        <section class="popular-categories section-padding">
            <div class="container wow animate__animated animate__fadeIn">
                <div class="section-title">
                    <div class="title">
                        <h3>Featured Categories</h3>

                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                        id="carausel-10-columns-arrows"></div>
                </div>
                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">

                        @php
                            $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
                        @endphp

                        @foreach ($categories as $category)

                            <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                <figure class="img-hover-scale overflow-hidden">
                                    <a href="#"><img
                                            src="{{asset('uploads/category/'.$category->category_image)}}"
                                            alt="" /></a>
                                </figure>
                                <h6><a href="#">{{$category->category_name}}</a></h6>
                                @php
                                    $categoryise__product = App\Models\Product::where('category_id', $category->id)->count();
                                @endphp
                                <span>{{$categoryise__product}}</span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

        @foreach ($categories as $category)
        <!--  Category -->
        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>{{$category->category_name}}</h3>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel"
                        aria-labelledby="tab-one">
                        <div class="row product-grid-4">

                            @php
                            $all_product = App\Models\Product::where('category_id', $category->id)->latest()->get();
                            @endphp

                            @foreach ($all_product as $item)

                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details',$item->product_slug) }}">
                                                <img class="default-img"
                                                    src="{{ asset('uploads/product/'.$item->product_thumbnail) }}"
                                                    alt="" />


                                                <img class="hover-img"
                                                    src="{{ asset('uploads/product/'.$item->product_thumbnail) }}"
                                                    alt="" />
                                            </a>
                                        </div>


                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{$item->categoryInfo->category_name}}</a>
                                        </div>
                                        <h2><a href="{{ route('product.details',$item->product_slug) }}">{{$item->product_name}}</a></h2>



                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>{{round($item->product_sel_price)}}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->

                            @endforeach

                        </div>
                        <!--End product-grid-4-->
                    </div>


                </div>
                <!--End tab-content-->
            </div>


        </section>
        <!-- Category -->
        @endforeach

    @endsection

