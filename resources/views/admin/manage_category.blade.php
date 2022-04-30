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
                    <h1 class="m-0">Manage Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            {{-- contents --}}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                @if (!isset($data))
                                    Add Category
                                @else
                                    Edit Category
                                @endif
                            </h3>
                            <a href="{{ url('admin/category') }}" class="btn bg-gradient-success ml-auto">Back</a>
                        </div>
                        <form method="post"
                            action="@if (isset($data)) {{ url('admin/category/manage-category/update') }} @else {{ url('admin/category/manage-category/add') }} @endif">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputCategory">Category Name</label>
                                    <input type="text" class="form-control" id="exampleInputCategory" name="catname"
                                        placeholder="Enter category name"
                                        value="@if (isset($data)) {{ $data[0]->category_name }} @endif"
                                        required>
                                    @if (isset($data))
                                        <input type="text" class="form-control" id="exampleInputCategory" name="catid"
                                            placeholder="Enter category name" value=" {{ $data[0]->id }} " hidden>
                                    @endif
                                    <p class="text-danger">
                                        @error('catname')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Cateogry Slug</label>
                                    <input type="text" class="form-control" id="exampleInputCategory"
                                        value="@if (isset($data)) {{ $data[0]->category_slug }} @endif"
                                        name="catslug" placeholder="Enter category name" required>
                                    <p class="text-danger">
                                        @error('catslug')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    @if (!isset($data))
                                        Add Category
                                    @else
                                        Save Changes
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Additional JS --}}
@section('additional_js')
@endsection
