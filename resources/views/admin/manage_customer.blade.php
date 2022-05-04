@extends('admin/layout');
@section('page_title', 'Manage Customer | The Ethical Man')
{{-- Additional CSS --}}
@section('additional_css')
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Customer</li>
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
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                @if (!isset($data))
                                    Add Customer
                                @else
                                    Customer Details
                                @endif
                            </h3>
                            <a href="{{ url('admin/customer') }}" class="btn bg-gradient-success ml-auto">Back</a>
                        </div>
                        <form method="post"
                            action="@if (isset($data)) {{ url('admin/customer/manage-customer/update') }} @else {{ url('admin/customer/manage-customer/add') }} @endif">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Name</label>
                                            <input type="text" class="form-control" id="exampleInputCategory" name="cname"
                                                placeholder="Enter customer name"
                                                value="@if (isset($data)) {{ $data[0]->name }} @endif"
                                                required>
                                            @if (isset($data))
                                                <input type="text" class="form-control" id="exampleInputCategory"
                                                    name="customer_id" value=" {{ $data[0]->id }} " hidden>
                                            @endif
                                            <p class="text-danger">
                                                @error('cname')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Email</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->email }} @endif"
                                                name="cemail" placeholder="Enter email" required>
                                            <p class="text-danger">
                                                @error('cemail')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Phone</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->phone }} @endif"
                                                name="cphone" placeholder="Enter phone" required>
                                            <p class="text-danger">
                                                @error('cphone')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">City</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->city }} @endif"
                                                name="ccity" placeholder="Enter City" required>
                                            <p class="text-danger">
                                                @error('ccity')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">State</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->state }} @endif"
                                                name="cstate" placeholder="Enter State" required>
                                            <p class="text-danger">
                                                @error('cstate')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">ZIP</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->zip }} @endif"
                                                name="czip" placeholder="Enter ZIP" required>
                                            <p class="text-danger">
                                                @error('czip')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Address</label>
                                            <textarea name="caddress" id="" class="form-control">
@if (isset($data))
{{ $data[0]->address }}
@endif
</textarea>
                                            <p class="text-danger">
                                                @error('caddress')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">Company</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->company }} @endif"
                                                name="ccompany" placeholder="Enter company" required>
                                            <p class="text-danger">
                                                @error('ccompany')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputCategory">GSTIN</label>
                                            <input type="text" class="form-control" id="exampleInputCategory"
                                                value="@if (isset($data)) {{ $data[0]->gstin }} @endif"
                                                name="cgstin" placeholder="Enter GSTIN" required>
                                            <p class="text-danger">
                                                @error('cgstin')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    @if (!isset($data))
                                        Add Customer
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
