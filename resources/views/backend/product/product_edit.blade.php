@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('update.product') }}" id="myForm" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $products->id }}">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">

                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ $products->product_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Tags </label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_tags }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Weight (gram, kg)</label>
                                        <input type="text" name="product_weight" class="form-control"
                                            value="{{ $products->product_weight }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Dimensions</label>
                                        <input type="text" name="product_dimensions" class="form-control"
                                            value="{{ $products->product_dimensions }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description <span
                                                class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control" rows="5">{{ $products->short_description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_description">{!! $products->long_description !!}</textarea>
                                    </div>
                                    <br>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="form-group numbers-only col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price (USD) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="selling_price" class="form-control"
                                                id="product_selling_price" value="{{ $products->selling_price }}">
                                        </div>
                                        <div class="form-group numbers-only col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price (USD) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="product_discount_price" value="{{ $products->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $products->product_code }}">
                                            @error('product_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group numbers-only col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="product_quantity" class="form-control"
                                                id="inputStarPoints" value="{{ $products->product_quantity }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Manufacturing Date </label>
                                            <input type="date" id="mfg_product" name="manufacturing_date"
                                                class="form-control"
                                                value="{{ $products->manufacturing_date == null ? '' : $products->manufacturing_date->format('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Expiry Date </label>
                                            <input type="date" id="exp_product" name="expiry_date"
                                                class="form-control"
                                                value="{{ $products->expiry_date == null ? '' : $products->expiry_date->format('Y-m-d') }}">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand <span
                                                    class="text-danger">*</span></label>
                                            <select name="brand_id" class="form-select single-select">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option
                                                        value="{{ $brand->id }}"{{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category <span
                                                    class="text-danger">*</span></label>
                                            <select name="category_id" class="form-select single-select">
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $products->category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product SubCategory <span
                                                    class="text-danger">*</span></label>
                                            <select name="subcategory_id" class="form-select single-select">
                                                <option></option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcat->subcategory_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Select Vendor </label>
                                            <select name="vendor_id" class="form-select single-select">
                                                <option></option>
                                                @foreach ($activeVendor as $vendor)
                                                    <option value="{{ $vendor->id }}"
                                                        {{ $vendor->id == $products->vendor_id ? 'selected' : '' }}>
                                                        {{ $vendor->shop_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1"
                                                            {{ $products->hot_deals == 1 ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Hot Deals</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1"
                                                            {{ $products->featured == 1 ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1"
                                                            {{ $products->special_offer == 1 ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offer</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1"
                                                            {{ $products->special_deals == 1 ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- // end row  -->
                                        </div>

                                        <hr>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary px-4 updateProduct"
                                                    value="Save Changes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Image Thumbnail Update --}}
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Main Thumbnail</h6>
        <hr>
        <div class="card">
            <form action="{{ route('update.product.thumbnail') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_image" value="{{ $products->product_thumbnail }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Main Thumbnail</label>
                        <input name="product_thumbnail" class="form-control" type="file" id="updatemainimage">
                        @if ($errors->has('product_thumbnail'))
                            <span class="text-danger">{{ $errors->first('product_thumbnail') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label"></label><br>
                        <img id="showImage" src="{{ asset($products->product_thumbnail) }}" alt=""
                            style="width: 160px; height: 150px;">
                    </div>
                    <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                </div>
            </form>
        </div>
    </div>
    {{-- End Main Image Thumbnail Update --}}

    {{-- Add New Multiple Image --}}
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Add New Multiple Images</h6>
        <hr>
        <div class="card">
            <form action="{{ route('add.new.product.multipleimages') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $products->id }}">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="inputProductTitle" class="form-label">Multiple Images </label>
                        <input class="form-control" name="add_new_multiple_image[]" type="file"
                            id="addNewMultipleImage" multiple="">
                        @error('add_new_multiple_image.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row" id="preview_new_image" style="margin-top: 10px;">

                        </div>
                    </div>
                    <br>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary px-4" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Add New Multiple Image --}}

    {{-- Update Multiple Image --}}
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Multiple Images</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                @error('multiple_image.*')
                    <div class="text-danger">{{ $message }}</div><br>
                @enderror
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('update.product.multipleimages') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @foreach ($multipleImages as $key => $image)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><img src="{{ asset($image->photo_name) }}" alt=""
                                            style="width: 100px; height: 100px;"></td>
                                    <td>
                                        <input type="file" class="form-group"
                                            name="multiple_image[{{ $image->id }}]">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary px-4" value="Update Image">
                                        <a href="{{ route('product.multipleimages.delete', $image->id) }}"
                                            class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- End Update Multiple Image --}}


    <script type="text/javascript">
        $(document).ready(function() {
            $('#updatemainimage').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#multipleImage').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|jpg|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(140)
                                        .height(140); //create image element
                                    $('#preview_image').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addNewMultipleImage').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|jpg|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(140)
                                        .height(140); //create image element
                                    $('#preview_new_image').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                        maxlength: 255,
                    },
                    short_description: {
                        required: true,
                        maxlength: 255,
                    },
                    product_thumbnail: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_quantity: {
                        required: true,
                        digits: true,
                        min: 1,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please enter product name.',
                        maxlength: 'The product name must not be greater than 255 characters.',
                    },
                    short_description: {
                        required: 'Please enter short description.',
                        maxlength: 'The short description must not be greater than 255 characters.',
                    },
                    product_thumbnail: {
                        required: 'Please select product thumbnail image.',
                    },
                    selling_price: {
                        required: 'Please enter selling price.',
                    },
                    product_code: {
                        required: 'Please enter product code.',
                    },
                    product_quantity: {
                        required: 'Please enter product quantity.',
                        digits: 'Please enter numbers only.',
                        min: 'The number of products must be greater than 0.',
                    },
                    brand_id: {
                        required: 'Please select a brand name.',
                    },
                    category_id: {
                        required: 'Please select a category name.',
                    },
                    subcategory_id: {
                        required: 'Please select a subcategory name.',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(".numbers-only").keypress(function(e) {
            if (e.which == 46) {
                if ($(this).val().indexOf('.') != -1) {
                    return false;
                }
            }
            if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".updateProduct", function() {

                var manufacturing_date = $('#mfg_product').val().split("-");
                var expiry_date = $('#exp_product').val().split("-");
                var p_selling_price = $('#product_selling_price').val();
                var p_discount_price = $('#product_discount_price').val();


                if ((p_selling_price <= p_discount_price) && p_discount_price != '') {
                    $.notify("There is an error in the selling price and discount!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                } else if ((p_selling_price > p_discount_price) && p_discount_price != '') {
                    if (manufacturing_date == '' || expiry_date == '') {
                        return true;
                    } else {
                        manufacturing_day = manufacturing_date[2];
                        manufacturing_month = manufacturing_date[1];
                        manufacturing_year = manufacturing_date[0];

                        expiry_day = expiry_date[2];
                        expiry_month = expiry_date[1];
                        expiry_year = expiry_date[0];

                        if (manufacturing_year > expiry_year) {
                            $.notify("You have selected invalid production and expiry date!", {
                                globalPosition: 'top right',
                                className: 'error'
                            });
                            return false;
                        } else if (manufacturing_year == expiry_year && manufacturing_month >
                            expiry_month) {
                            $.notify("You have selected invalid production and expiry date!", {
                                globalPosition: 'top right',
                                className: 'error'
                            });
                            return false;
                        } else if (manufacturing_year == expiry_year && manufacturing_month ==
                            expiry_month &&
                            manufacturing_day > expiry_day) {
                            $.notify("You have selected invalid production and expiry date!", {
                                globalPosition: 'top right',
                                className: 'error'
                            });
                            return false;
                        } else if (manufacturing_year == expiry_year && manufacturing_month ==
                            expiry_month &&
                            manufacturing_day == expiry_day) {
                            $.notify("You have selected invalid production and expiry date!", {
                                globalPosition: 'top right',
                                className: 'error'
                            });
                            return false;
                        }
                    }
                }
            });
        });
    </script>
@endsection
