</main>

<footer class="main">

    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2022, <strong class="text-brand">Nest</strong> - HTML Ecommerce
                    Template <br />All rights reserved</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/phone-call.svg"
                        alt="hotline" />
                    <p>1900 - 8888<span>24/7 Support Center</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    <a href="#"><img
                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-facebook-white.svg"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-twitter-white.svg"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-instagram-white.svg"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-pinterest-white.svg"
                            alt="" /></a>
                    <a href="#"><img
                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-youtube-white.svg"
                            alt="" /></a>
                </div>
                <p class="font-sm">Up to 15% discount on your first subscribe</p>
            </div>
        </div>
    </div>
</footer>

{{-- <!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend') }}/assets/imgs/theme/loading.gif" alt="" />
            </div>
        </div>
    </div>
</div> --}}


    <!-- Vendor JS-->
    <script src="{{ asset('frontend') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/slick.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/waypoints.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/wow.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/counterup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/images-loaded.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/isotope.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/scrollup.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend') }}/assets/js/main.js?v=5.3"></script>
    <script src="{{ asset('frontend') }}/assets/js/shop.js?v=5.3"></script>

    <script>
        // import Swal from 'sweetalert2';
        $(function() {
            $(".knob").knob();
        });
    </script>

     {{-- toaster cnd  --}}
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
           case 'info':
           toastr.info(" {{ Session::get('message') }} ");
           break;

           case 'success':
           toastr.success(" {{ Session::get('message') }} ");
           break;

           case 'warning':
           toastr.warning(" {{ Session::get('message') }} ");
           break;

           case 'error':
           toastr.error(" {{ Session::get('message') }} ");
           break;
        }
        @endif
       </script>

        {{-- for sub category load  --}}
    <script>
        $(document).ready(function() {

            $('#category_id').on('change', function() {

                $category_id = $(this).val();
                if ($category_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/find/subcategory') }}/" + $category_id,
                        // data: $category_id,
                        dataType: "json",
                        success: function(data) {
                            $inputProductSubcategory = $('#sub_category_id').html('');
                            $('#sub_category_id').empty();
                            $.each(data, function(indexInArray, valueOfElement) {
                                $inputProductSubcategory.append('<option value = "' +
                                    valueOfElement.sub_category_id + '">' +
                                    valueOfElement.sub_category_name + '</option>');
                                // console.log(valueOfElement.sub_category_id);
                            });
                        }
                    });
                }

            });

        });
    </script>

    {{-- product quick view  --}}
    <script>
        function productView(id) {

            $.ajax({
                type: "GET",
                url: "{{url('/product/quick/view')}}/"+id,
                dataType: "json",
                success: function (data) {
                    // basic data
                    $('#product_name').html(data.product.product_name);
                    $('#vendor_shop_name').html(data.product.vendor_info.vendor_shop_name);
                    $('#product_code').html(data.product.product_code);
                    $('#brand').html(data.product.brand_info.brand_name);
                    $('#category').html(data.product.category_info.category_name);
                    $('#product_quantity_type').html(data.product.product_quantity_type);
                    $('#product_id').html(data.product.product_id);
                    $('#quantity').val();

                    // pricing
                    if (data.product.product_discount_price == null) {
                        $('#product_descount_price').text('');
                        $('#discount').text('');
                        $('#product_descount_price').text(data.product.product_sel_price);
                    } else {

                        $price = data.product.product_sel_price - data.product.product_discount_price;
                        $discount = Math.round(($price / data.product.product_sel_price) * 100);

                        $('#product_descount_price').text($price);
                        $('#discount').text($discount + ' % off');
                        $('#product_sel_price').text(data.product.product_sel_price);
                    }

                    // size
                    $('select[name = "size"]').empty();
                    $.each(data.product_size, function (indexInArray, valueOfElement) {
                        $('select[name = "size"]').append('<option value = "'+valueOfElement+'">'+valueOfElement+'</option>');
                        if (data.product_size == "") {
                            $('#product_size_area').hide();
                        } else {
                            $('#product_size_area').show();
                        }
                    });


                    // color
                    $('select[name = "color"]').empty();
                    $.each(data.product_color, function (indexInArray, valueOfElement) {
                        $('select[name = "color"]').append('<option value = "'+valueOfElement+'">'+valueOfElement+'</option>');
                        if (data.product_color == "") {
                            $('#product_color_area').hide();
                        } else {
                            $('#product_color_area').show();
                        }
                    });



                    // images
                    // $.each(data.product_multi_img, function (indexInArray, valueOfElement) {
                    //     $('#product-image-slider').append('<figure class="border-radius-10">
                    //                 <img src="{{asset("uploads/product/multi_image/".' +valueOfElement.product_multi_image+ ')}}" alt="product image" />
                    //             </figure>');
                    // });
                }
            });
         }
        //  product quick view with ajax end



        // product add to cart start

         function addToCart(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var product_name = $('#product_name').text();
            var product_id = $('#product_id').text();
            var product_color = $('#product_color option:selected').text();
            var product_size = $('#product_size option:selected').text();
            var product_quantity = $('#quantity').val();
            var product_discount_price = $('#product_descount_price').text();

            $.ajax({
                type: "POST",
                url: "{{url('/product/add/to/cart')}}/"+product_id,
                data: {
                    product_name:product_name, product_color:product_color, product_size:product_size, product_quantity:product_quantity
                },
                dataType: "json",
                success: function (data) {
                    $('#close_modal').click();

                    Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Successfully added on your cart",
                    showConfirmButton: false,
                    timer: 1500
                    });
                }
            });
         }

        // product add to cart end
    </script>
</body>

</html>

