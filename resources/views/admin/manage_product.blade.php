@extends('admin/layout');
@section('page_title', 'Manage Category | The Ethical Man')
{{-- Additional CSS --}}
@section('additional_css')
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
                                    <input type="text" class="form-control" id="exampleInputCategory" name="product_name"
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
                                    <input type="text" class="form-control" id="exampleInputCategory"
                                        value="@if (isset($data)) {{ $data[0]->slug }} @endif" name="slug"
                                        placeholder="Enter category name">
                                    <p class="text-danger">
                                        @error('slug')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- MRP --}}
                                        <div class="form-group">
                                            <label for="exampleInputCategory">MRP</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->mrp }} @endif"
                                                name="mrp" placeholder="Enter MRP">
                                            <p class="text-danger">
                                                @error('mrp')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- Price --}}
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Price</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->price }} @endif"
                                                name="price" placeholder="Enter price">
                                            <p class="text-danger">
                                                @error('price')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- Quantity --}}
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Quantity</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->quantity }} @endif"
                                                name="quantity" placeholder="Enter quantity">
                                            <p class="text-danger">
                                                @error('quantity')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
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
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        {{-- Stock --}}
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Stock</label>
                                            <select class="custom-select rounded-0" name="stock" id="exampleSelectRounded0">
                                                <option value="1">In Stock</option>
                                                <option value="0">Out of Stock</option>
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
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <p class="text-danger">
                                                @error('featured')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        {{-- SKU --}}
                                        <div class="form-group">
                                            <label for="exampleInputCategory">SKU</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->sku }} @endif"
                                                name="sku" placeholder="Enter sku">
                                            <p class="text-danger">
                                                @error('sku')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                {{-- Image --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    <p class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                {{-- Gallery Image --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">Gallery Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="gallery_img"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    <p class="text-danger">
                                        @error('gallery_img')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                {{-- Short Description --}}
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" name="short_desc" rows="3">
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
                                    <textarea class="form-control" name="desc" rows="3">
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        {{-- Size --}}
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Size</label>
                                            <select class="custom-select rounded-0" name="size" id="exampleSelectRounded0">
                                                <option>Select Size</option>
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
                                            <select class="custom-select rounded-0" name="color" id="exampleSelectRounded0">
                                                <option>Select Color</option>
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
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
