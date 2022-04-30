@extends('admin/layout');
@section('page_title', 'Manage Coupon | The Ethical Man')
{{-- Additional CSS --}}
@section('additional_css')
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Coupon</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Coupon</li>
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
                                    Add Coupon
                                @else
                                    Edit Coupon
                                @endif
                            </h3>
                            <a href="{{ url('admin/coupon') }}" class="btn bg-gradient-success ml-auto">Back</a>
                        </div>
                        <form method="post"
                            action="@if (isset($data)) {{ url('admin/coupon/manage-coupon/update') }} @else {{ url('admin/coupon/manage-coupon/add') }} @endif">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputCategory">Coupon Title</label>
                                    <input type="text" class="form-control" id="exampleInputCategory" name="coupon_title"
                                        placeholder="Enter coupon title"
                                        value="@if (isset($data)) {{ $data[0]->title }} @endif" required>
                                    @if (isset($data))
                                        <input type="text" class="form-control" id="exampleInputCategory" name="catid"
                                            value=" {{ $data[0]->id }} " hidden>
                                    @endif
                                    <p class="text-danger">
                                        @error('coupon_title')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Coupon Code</label>
                                    <input type="text" class="form-control" id="exampleInputCategory"
                                        value="@if (isset($data)) {{ $data[0]->code }} @endif"
                                        name="coupon_code" placeholder="Enter coupon code" required>
                                    <p class="text-danger">
                                        @error('coupon_code')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Coupon Value</label>
                                    <input type="text" class="form-control" id="exampleInputCategory"
                                        value="@if (isset($data)) {{ $data[0]->value }} @endif"
                                        name="coupon_value" placeholder="Enter coupon value" required>
                                    <p class="text-danger">
                                        @error('coupon_value')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    @if (!isset($data))
                                        Add Coupon
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
