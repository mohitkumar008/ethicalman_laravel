@extends('admin/layout')
@section('page_title', 'Product | The Ethical Man')
@section('product_select', 'active')
{{-- Additional CSS --}}
@section('additional_css')
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                        <li class="breadcrumb-item active">Product List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            {{-- contents --}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header  d-flex justify-content-between align-items-center">
                            @if (session('add_msg'))
                                <h6 class="card-title text-success">
                                    {{ session('add_msg') }}
                                </h6>
                            @endif
                            @if (session('update_msg'))
                                <h6 class="card-title text-success">
                                    {{ session('update_msg') }}
                                </h6>
                            @endif
                            @if (session('delete_msg'))
                                <h6 class="card-title text-warning">
                                    {{ session('delete_msg') }}
                                </h6>
                            @endif
                            @if (session('activate_msg'))
                                <h6 class="card-title text-success">
                                    {{ session('activate_msg') }}
                                </h6>
                            @endif
                            @if (session('deactivate_msg'))
                                <h6 class="card-title text-warning">
                                    {{ session('deactivate_msg') }}
                                </h6>
                            @endif
                            <a href="{{ url('admin/product/add-product') }}" class="btn bg-gradient-primary ml-auto">Add
                                Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="S.No: activate to sort column ascending"
                                                        aria-sort="descending">S.No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Image: activate to sort column ascending">
                                                        Image</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Name: activate to sort column ascending">
                                                        Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Slug: activate to sort column ascending">
                                                        Slug</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Category: activate to sort column ascending">
                                                        Category</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Stock: activate to sort column ascending">
                                                        Stock</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Featured: activate to sort column ascending">
                                                        Featured</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Keywords: activate to sort column ascending">
                                                        Keywords</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Action: activate to sort column ascending">
                                                        Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $list)
                                                    <tr class="odd">
                                                        <td class="dtr-control sorting_1" tabindex="0">
                                                            {{ $loop->iteration }}</td>
                                                        <td><img style="width:100px"
                                                                src="{{ asset('storage/media/' . $list->image . '') }}"
                                                                alt=""></td>
                                                        <td>{{ $list->name }}</td>
                                                        <td>{{ $list->slug }}</td>
                                                        <td>{{ $list->cid }}</td>
                                                        @if ($list->stock == 1)
                                                            <td class="text-success">In Stock</td>
                                                        @else
                                                            <td class="text-danger">Out of Stock</td>
                                                        @endif
                                                        @if ($list->featured == 1)
                                                            <td class="text-success">Yes</td>
                                                        @else
                                                            <td class="text-danger">No</td>
                                                        @endif
                                                        <td>{{ $list->keywords }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/product/edit-product/' . $list->slug . '') }}"
                                                                class="btn btn-app m-0 p-1 h-auto">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if ($list->status == '1')
                                                                <a href="{{ url('admin/product/status/deactivate/' . $list->id) }}"
                                                                    class="btn btn-app m-0 p-1 h-auto">
                                                                    <i class="fas fa-eye-slash"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ url('admin/product/status/activate/' . $list->id) }}"
                                                                    class="btn btn-app m-0 p-1 h-auto">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            @endif
                                                            <a href="{{ url('admin/product/delete/' . $list->id) }}"
                                                                class="btn btn-app m-0 p-1 h-auto">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Additional JS --}}
@section('additional_js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
