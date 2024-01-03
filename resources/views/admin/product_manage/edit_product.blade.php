@extends('admin.admin_master')
@section('content')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product Information</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.all.product')}}" class="btn btn-primary">All Product</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <form action="{{route('admin.update.product')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product Information</h5>
                <hr/>
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">

                                <div class="form-group mb-3 ">
                                    <label for="product_name" na class="form-label">Product Name</label>

                                    <input type="hidden" id="slug" name="slug" value="{{$data->product_slug}}">

                                    <input type="text" class="form-control @error('product_name')
                                        is-invalid
                                    @enderror" id="product_name" name="product_name"
                                        placeholder="Enter Product Name"  value="@if($data->product_name){{$data->product_name}}@else{{old('product_name')}}@endif" />

                                        @error('product_name')
                                            <span class="text-danger"></span>{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="col-12">
                                    <label for="category_id" class="form-label">Category</label>

                                    @php
                                        $all_category = App\Models\Category::orderBy('category_name', 'ASC')
                                            ->get();
                                    @endphp

                                    <select class="form-select @error('category_id')
                                        is-invalid
                                    @enderror" id="category_id" name="category_id">
                                        <option value=" ">Please Select Category</option>
                                        @foreach ($all_category as $category)
                                            <option value="{{ $category->id }}" @if ($category->id == $data->category_id) selected @endif>{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Sell Price</label>
                                        <input type="number" class="form-control @error('product_sel_price')
                                            is-invalid
                                        @enderror" id="product_sel_price"
                                            placeholder="800" name="product_sel_price" value="@if($data->product_sel_price){{$data->product_sel_price}}@else{{old('product_sel_price')}}@endif">
                                            @error('product_sel_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('product_quantity')
                                            is-invalid
                                        @enderror" id="product_quantity"
                                            placeholder="800" name="product_quantity" value="@if($data->product_quantity){{$data->product_quantity}}@else{{old('product_quantity')}}@endif">
                                            @error('product_quantity')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="inputProductTitle" class="form-label">Main Thambnail</label>
                            @if ($data->vendor_id == null)
                                <input name="product_thumbnail" class="form-control @error('product_thumbnail')
                                    is-invalid
                                @enderror" type="file" id="formFile"
                                    onChange="mainThamUrl(this)">
                            @endif
                            @error('product_thumbnail')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <img class="my-3" src="@if ($data->product_thumbnail)
                                {{asset('uploads/product/'.$data->product_thumbnail)}}
                            @endif" id="mainThmb" style="width: 150px"/>
                        </div>
                    </div>
                </div>
                @if ($data->vendor_id == null)
                <div class="input-group mb-3">
                    <input type="reset" class="btn btn-danger" id="admin_product_add_reset_btn" />
                    <button type="submit" class="btn btn-success" id="admin_product_add_btn">Update Product</button>
                </div>
                @endif
            </div><!--end row-->
        </div>
    </form>


    </div>
    </div>

    </div>


    {{-- for sub category load  --}}
    <script>
        $(document).ready(function() {

            // for search and select option
            $('.searchAndSelect').select2();

            $('.summernote').summernote();

        });

        // single image preview
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection


