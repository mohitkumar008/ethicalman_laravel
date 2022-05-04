@extends('admin/layout')
@section('page_title', 'Manage Category | The Ethical Man')
{{-- Additional CSS --}}
@section('additional_css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            {{-- contents --}}
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                    <form method="post"
                        action="@if (isset($data)) {{ url('admin/product/manage-product/update') }} @else {{ url('admin/product/manage-product/add') }} @endif"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    @if (!isset($data))
                                        Add Product
                                    @else
                                        Edit Product
                                    @endif
                                </h3>
                                <a href="{{ url('admin/product/product-list') }}"
                                    class="btn bg-gradient-success ml-auto">Back</a>
                            </div>
                            <div class="card-body">
                                {{-- Product ID --}}
                                @if (isset($data))
                                    <input type="text" class="form-control" id="exampleInputCategory" name="pid"
                                        placeholder="Enter category name" value=" {{ $data[0]->id }} " hidden>
                                @endif
                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="exampleInputCategory">Name</label>
                                    <input type="text" id="pname" class="form-control" name="product_name"
                                        placeholder="Enter Product Name"
                                        value="@if (isset($data)) {{ $data[0]->name }} @endif">
                                    <p class="text-danger">
                                        @error('product_name')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>

                                {{-- Product Slug --}}
                                <div class="form-group">
                                    <label for="exampleInputCategory">Slug</label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($data)) {{ $data[0]->slug }} @endif" name="slug"
                                        id="pslug" placeholder="Enter category name">
                                    <p class="text-danger">
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>

                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-12">
                                        {{-- Category --}}
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Category</label>
                                            <select class="custom-select rounded-0" name="cid" id="exampleSelectRounded0">
                                                <option>Select Category</option>
                                                @foreach ($category as $list)
                                                    @if (isset($data) && $data[0]->cid == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            {{ $list->category_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $list->id }}">{{ $list->category_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p class="text-danger">
                                                @error('cid')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">
                                        {{-- Stock --}}
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Stock</label>
                                            <select class="custom-select rounded-0" name="stock" id="exampleSelectRounded0">
                                                <option value="0"
                                                    @if (isset($data) && $data[0]->stock == 0) {{ 'selected' }} @endif>Out of
                                                    Stock
                                                </option>
                                                <option value="1"
                                                    @if (isset($data) && $data[0]->stock == 1) {{ 'selected' }} @endif>In Stock
                                                </option>
                                            </select>
                                            <p class="text-danger">
                                                @error('stock')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        {{-- Featured --}}
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Featured</label>
                                            <select class="custom-select rounded-0" name="featured"
                                                id="exampleSelectRounded0">
                                                <option value="0"
                                                    @if (isset($data) && $data[0]->featured == 0) {{ 'selected' }} @endif>No
                                                </option>
                                                <option value="1"
                                                    @if (isset($data) && $data[0]->featured == 1) {{ 'selected' }} @endif>Yes
                                                </option>
                                            </select>
                                            <p class="text-danger">
                                                @error('featured')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-12">
                                        {{-- Image --}}
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <p class="text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        @if (isset($data))
                                            <img style="width:100px"
                                                src="{{ asset('storage/media/' . $data[0]->image . '') }}" alt="">
                                        @endif
                                    </div>
                                </div>

                                {{-- Short Description --}}
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control summernote" id="" name="short_desc" rows="3">
                                        @if (isset($data))
{{ $data[0]->short_desc }}
@endif
                                        </textarea>
                                    <p class="text-danger">
                                        @error('short_desc')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                {{-- Description --}}
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control summernote" id="" name="desc" rows="3">
                                        @if (isset($data))
{{ $data[0]->desc }}
@endif
                                        </textarea>
                                    <p class="text-danger">
                                        @error('desc')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                {{-- Keywords --}}
                                <div class="form-group">
                                    <label for="exampleInputCategory">Keywords</label>
                                    <input type="text" class="form-control" id="exampleInputCategory"
                                        value="@if (isset($data)) {{ $data[0]->keywords }} @endif"
                                        name="keywords" placeholder="Enter keywords">
                                    <p class="text-danger">
                                        @error('keywords')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div id="product_attr">
                            <?php
                            $arrAttr = array_values((array) $productAttrArr);
                            ?>
                            @if (empty($arrAttr[0]))
                                <div class="card" id='product_attr_1'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- MRP --}}
                                                <div class="form-group">
                                                    <label for="exampleInputCategory">MRP</label>
                                                    <input type="text" class="form-control" id="exampleInputCategory"
                                                        name="mrp[]" placeholder="Enter MRP">
                                                    <p class="text-danger">
                                                        @error('mrp')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- Price --}}
                                                <div class="form-group">
                                                    <label for="exampleInputCategory">Price</label>
                                                    <input type="text" class="form-control" id="exampleInputCategory"
                                                        name="price[]" placeholder="Enter price">
                                                    <p class="text-danger">
                                                        @error('price')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- Quantity --}}
                                                <div class="form-group">
                                                    <label for="exampleInputCategory">Quantity</label>
                                                    <input type="text" class="form-control" id="exampleInputCategory"
                                                        name="quantity[]" placeholder="Enter quantity">
                                                    <p class="text-danger">
                                                        @error('quantity')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- SKU --}}
                                                <div class="form-group">
                                                    <label for="exampleInputCategory">SKU</label>
                                                    <input type="text" class="form-control" id="exampleInputCategory"
                                                        name="sku[]" placeholder="Enter sku">
                                                    <p class="text-danger">
                                                        @error('sku')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- Size --}}
                                                <div class="form-group">
                                                    <label for="exampleSelectRounded0">Size</label>
                                                    <select class="custom-select rounded-0" name="size[]"
                                                        id="exampleSelectRounded0">
                                                        <option value="0">Select Size</option>
                                                        @foreach ($size as $list)
                                                            <option value="{{ $list->id }}">{{ $list->size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        @error('size')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                {{-- Color --}}
                                                <div class="form-group">
                                                    <label for="exampleSelectRounded0">Color</label>
                                                    <select class="custom-select rounded-0" name="color[]"
                                                        id="exampleSelectRounded0">
                                                        <option value="0">Select Color</option>
                                                        @foreach ($color as $list)
                                                            <option value="{{ $list->id }}">{{ $list->color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        @error('color')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                                {{-- Imageattr --}}
                                                <div class="form-group">
                                                    <label for="exampleSelectRounded0">Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="attrimg[]"
                                                                id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                Image</label>
                                                        </div>
                                                    </div>
                                                    <p class="text-danger">
                                                        @error('size')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <button class="btn btn-success" type="button" onclick="add_more()">Add
                                                More</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach ($productAttrArr as $key => $val)
                                    <div class="card" id='product_attr_{{ $loop->iteration }}'>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- paid --}}
                                                    <input type="text" class="form-control" id="exampleInputCategory"
                                                        value="@if (isset($val)) {{ $val->id }} @endif"
                                                        name="paid[]" hidden>
                                                    {{-- MRP --}}
                                                    <div class="form-group">
                                                        <label for="exampleInputCategory">MRP</label>
                                                        <input type="text" class="form-control" id="exampleInputCategory"
                                                            value="@if (isset($val)) {{ $val->mrp }} @endif"
                                                            name="mrp[]" placeholder="Enter MRP">
                                                        <p class="text-danger">
                                                            @error('mrp')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- Price --}}
                                                    <div class="form-group">
                                                        <label for="exampleInputCategory">Price</label>
                                                        <input type="text" class="form-control" id="exampleInputCategory"
                                                            value="@if (isset($val)) {{ $val->price }} @endif"
                                                            name="price[]" placeholder="Enter price">
                                                        <p class="text-danger">
                                                            @error('price')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- Quantity --}}
                                                    <div class="form-group">
                                                        <label for="exampleInputCategory">Quantity</label>
                                                        <input type="text" class="form-control" id="exampleInputCategory"
                                                            value="@if (isset($val)) {{ $val->qty }} @endif"
                                                            name="quantity[]" placeholder="Enter quantity">
                                                        <p class="text-danger">
                                                            @error('quantity')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- SKU --}}
                                                    <div class="form-group">
                                                        <label for="exampleInputCategory">SKU</label>
                                                        <input type="text" class="form-control" id="exampleInputCategory"
                                                            value="@if (isset($val)) {{ $val->sku }} @endif"
                                                            name="sku[]" placeholder="Enter sku">
                                                        <p class="text-danger">
                                                            @error('sku')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- Size --}}
                                                    <div class="form-group">
                                                        <label for="exampleSelectRounded0">Size</label>
                                                        <select class="custom-select rounded-0" name="size[]"
                                                            id="exampleSelectRounded0">
                                                            <option value="0">Select Size</option>
                                                            @foreach ($size as $list)
                                                                @if (isset($val) && $val->size_id == $list->id)
                                                                    <option selected value="{{ $list->id }}">
                                                                        {{ $list->size }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $list->id }}">
                                                                        {{ $list->size }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <p class="text-danger">
                                                            @error('size')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    {{-- Color --}}
                                                    <div class="form-group">
                                                        <label for="exampleSelectRounded0">Color</label>
                                                        <select class="custom-select rounded-0" name="color[]"
                                                            id="exampleSelectRounded0">
                                                            <option value="0">Select Color</option>
                                                            @foreach ($color as $list)
                                                                @if (isset($val) && $val->color_id == $list->id)
                                                                    <option selected value="{{ $list->id }}">
                                                                        {{ $list->color }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $list->id }}">
                                                                        {{ $list->color }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <p class="text-danger">
                                                            @error('color')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-12">
                                                    {{-- Imageattr --}}
                                                    <div class="form-group">
                                                        <label for="exampleSelectRounded0">Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    name="attrimg[]" id="exampleInputFile">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose
                                                                    Image</label>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger">
                                                            @error('attrimg')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                    <img style="width:100px"
                                                        src="{{ asset('storage/media/' . $val->attr_img . '') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                @if ($loop->iteration > 1)
                                                    <a href="{{ url('admin/product/edit-product/delete-attr/' . $val->id . '/' . $data[0]->slug . '') }}"
                                                        class="btn btn-danger" type="button">Remove</a>
                                                @else
                                                    <button class="btn btn-success" type="button" onclick="add_more()">Add
                                                        More</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div>
                            <div class="card">
                                <div class="card-body" id="product_images">
                                    <h4>Product Images</h4>
                                    <?php
                                    $arrimg = array_values((array) $productImageArr);
                                    ?>
                                    @if (empty($arrimg[0]))
                                        <div class="row" id="product_img_1">
                                            <div class="col-lg-9 col-md-9 col-12">
                                                {{-- Image Gallery --}}
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            {{-- paid --}}
                                                            <input type="text" class="form-control"
                                                                id="exampleInputCategory" value="" name="piid[]" hidden>
                                                            <input type="file" class="custom-file-input"
                                                                name="productimg[]" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                Image</label>
                                                        </div>
                                                    </div>
                                                    <p class="text-danger">
                                                        @error('productimg')
                                                            {{ $message }}
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <button class="btn btn-success" type="button" onclick="add_more_img()">Add
                                                    More</button>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($productImageArr as $key => $val)
                                            <div class="row" id="product_img_{{ $loop->iteration }}">
                                                <div class="col-lg-9 col-md-9 col-12">
                                                    {{-- Image Gallery --}}
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                {{-- paid --}}
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputCategory"
                                                                    value="@if (isset($val)) {{ $val->id }} @endif"
                                                                    name="piid[]" hidden>
                                                                <input type="file" class="custom-file-input"
                                                                    name="productimg[]" id="exampleInputFile">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose
                                                                    Image</label>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger">
                                                            @error('productimg')
                                                                {{ $message }}
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                    <img style="width:100px"
                                                        src="{{ asset('storage/media/' . $val->images . '') }}"
                                                        alt="sdfs">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    @if ($loop->iteration > 1)
                                                        <a href="{{ url('admin/product/edit-product/delete-image/' . $val->id . '/' . $data[0]->slug . '') }}"
                                                            class="btn btn-danger" type="button">Remove</a>
                                                    @else
                                                        <button class="btn btn-success" type="button"
                                                            onclick="add_more_img()">Add
                                                            More</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-footer text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    @if (!isset($data))
                                        Add Product
                                    @else
                                        Save Changes
                                    @endif
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Additional JS --}}
@section('additional_js')
    <script>
        $(document).ready(function() {
            $("#pname").change(function() {
                let pname = $("#pname").val();
                $("#pslug").val(pname.toLowerCase().replace(/ /g, "-"));
            });
        });
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin_assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var IMAGE_PATH = 'http://localhost/techverse/images/blogs/';

            $('.summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    }
                }
            });

            function uploadImage(image) {
                var data = new FormData();
                data.append("image", image);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "uploader.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        var image = IMAGE_PATH + url;
                        $('#summernote').summernote('insertImage', image);
                        console.log(image);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

        });
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        @if (!empty($arrAttr[0]))
            let loop_count = {{ count($productAttrArr) }};
        @else
            let loop_count = 1;
        @endif

        function add_more() {
            loop_count++;
            var html = `<div class='card' id='product_attr_${loop_count}'><div class='card-body'><div class='row'>`;
            html +=
                `<div class="col-lg-6 col-md-6 col-12">
                    {{-- paid --}}
                    <input type="text" class="form-control" id="exampleInputCategory"
                        value=""
                        name="paid[]" hidden>
                    <div class="form-group">
                        <label for="exampleInputCategory">MRP</label>
                        <input type="text" class="form-control" id="exampleInputCategory"value="@if (isset($data)) {{ $data[0]->mrp }} @endif"name="mrp[]" placeholder="Enter MRP">
                        <p class="text-danger"></p>
                    </div >
                </div>`;
            html +=
                `<div class="col-lg-6 col-md-6 col-12">
                    {{-- Price --}}
                    <div class="form-group">
                        <label for="exampleInputCategory">Price</label>
                        <input type="text" class="form-control" id="exampleInputCategory" value="@if (isset($data)) {{ $data[0]->price }} @endif" name="price[]" placeholder="Enter price">
                        <p class="text-danger">
                        @error('price')
                            {{ $message }}
                        @enderror
                        </p>
                    </div >
                </div>`

            html += `
                <div class="col-lg-6 col-md-6 col-12">
                    {{-- Quantity --}}
                    <div class="form-group">
                        <label for="exampleInputCategory">Quantity</label>
                        <input type="text" class="form-control" id="exampleInputCategory"
                            value="@if (isset($data)) {{ $data[0]->quantity }} @endif"
                            name="quantity[]" placeholder="Enter quantity">
                        <p class="text-danger">
                            @error('quantity')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>`;

            html += `
                <div class="col-lg-6 col-md-6 col-12">
                    {{-- SKU --}}
                    <div class="form-group">
                        <label for="exampleInputCategory">SKU</label>
                        <input type="text" class="form-control" id="exampleInputCategory"
                            value="@if (isset($data)) {{ $data[0]->sku }} @endif"
                            name="sku[]" placeholder="Enter sku">
                        <p class="text-danger">
                            @error('sku')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>`;

            html += `
                <div class="col-lg-6 col-md-6 col-12">
                    {{-- Size --}}
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Size</label>
                        <select class="custom-select rounded-0" name="size[]"
                            id="exampleSelectRounded0">
                            <option value="0">Select Size</option>
                            @foreach ($size as $list)
                                @if (isset($data) && $data[0]->cid == $list->id)
                                    <option selected value="{{ $list->id }}">
                                        {{ $list->size }}
                                    </option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->size }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <p class="text-danger">
                            @error('size')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    {{-- Color --}}
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Color</label>
                        <select class="custom-select rounded-0" name="color[]"
                            id="exampleSelectRounded0">
                            <option value="0">Select Color</option>
                            @foreach ($color as $list)
                                @if (isset($data) && $data[0]->cid == $list->id)
                                    <option selected value="{{ $list->id }}">
                                        {{ $list->color }}
                                    </option>
                                @else
                                    <option value="{{ $list->id }}">{{ $list->color }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <p class="text-danger">
                            @error('color')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    {{-- Imageattr --}}
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="attrimg[]"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose
                                    Image</label>
                            </div>
                        </div>
                        <p class="text-danger">
                            @error('size')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <button class="btn btn-danger" type="button" onclick="remove_attr(${loop_count})">Remove</button>
                </div>
                `;

            html += "</div></div></div>";
            $('#product_attr').append(html);
            bsCustomFileInput.init();
        }

        function remove_attr(loop_count) {
            $('#product_attr_' + loop_count).remove()
        }

        @if (!empty($arrimg[0]))
            let img_loop = {{ count($productImageArr) }};
        @else
            let img_loop = 1;
        @endif

        function add_more_img() {
            img_loop++;
            var html = `
                        <div class="row" id="product_img_${img_loop}">
                `;
            html += `
                <div class="col-lg-9 col-md-9 col-12">
                    {{-- Image Gallery --}}
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                {{-- paid --}}
                                <input type="text" class="form-control" id="exampleInputCategory" name="piid[]" hidden>
                                <input type="file" class="custom-file-input" name="productimg[]"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose
                                    Image</label>
                            </div>
                        </div>
                        <p class="text-danger">
                            @error('productimg')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <img src="" alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <button class="btn btn-danger" type="button" onclick="remove_more_img(${img_loop})">Delete</button>
                </div>
                `;
            html += `
                </div>
            `;
            $('#product_images').append(html);
            bsCustomFileInput.init();
        }

        function remove_more_img(img_loop) {
            $('#product_img_' + img_loop).remove()
        }
    </script>
@endsection
