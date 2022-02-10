@extends('adminlte::page')

@section('title', 'Data Customer')

@section('content_header')

    <i class="fas fa-user-circle"></i> Data Customer

@endsection

@section('content')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div style="float: left;">
                            <a href="{{ route('exportPDF.customersAll') }}" class="btn btn-danger active">
                                <i class="fas fa-file-export"></i>  <span class="glyphicon glyphicon-export"></span> Export PDF
                            </a>
                        </div>
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".customer"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('customer.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="customer">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Customer</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($customer as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->telepon }}</td>
                                            <td>
                                                <form action="{{ route('customer.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary btn-sm rounded-circle" data-toggle="modal"
                                                        data-target=".customer-edit-{{ $data->id }}"><i
                                                            class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-info btn-sm rounded-circle" data-toggle="modal"
                                                        data-target=".customer-show-{{ $data->id }}">
                                                    <i class="fas fa-id-card"></i></a>
                                                    <button class="btn btn-danger btn-sm rounded-circle" id="delete-confirm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                </tbody>
                                </td>
                                </tr>
                                @include('customer.edit')
                                @include('customer.show')
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#customer').DataTable();
        });
    </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("#delete-confirm").click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
