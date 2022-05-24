@extends('admin/layout')
@section('page_title', 'Review | The Ethical Man')
@section('review_select', 'active')
{{-- Additional CSS --}}
@section('additional_css')
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reviews</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Review</li>
                        <li class="breadcrumb-item active">Review List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (session('update_msg'))
                                <h3 class="card-title text-warning">
                                    {{ session('update_msg') }}
                                </h3>
                            @endif
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover projects">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Rating</th>
                                        <th>Date</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $list)
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $list->product_name }}</td>
                                            <td>{{ $list->customer_name }}</td>
                                            <td>{{ $list->stars }}</td>
                                            <td>{{ \Carbon\Carbon::parse($list->created_at)->isoFormat('MMM Do, YYYY') }}
                                            </td>
                                            <td class="project-actions text-right">
                                                <a href="{{ url('admin/review/' . $list->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                @if ($list->status == '1')
                                                    <a href="{{ url('admin/review/deactivate/' . $list->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye-slash"></i> Deactivate
                                                    </a>
                                                @else
                                                    <a href="{{ url('admin/review/activate/' . $list->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-eye"></i> Activate
                                                    </a>
                                                @endif
                                                <a href="{{ url('admin/review/delete/delete-review/' . $list->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="expandable-body d-none">
                                            <td colspan="6">
                                                <p style="display: none;">
                                                    {{ $list->comment }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
