@extends('adminlte::page')

@section('title', 'Data Customer')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
    @include('layouts._flash')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header"><i class="fas fa-user-circle"></i> Data Customer
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".customer">Tambah Data</a>
                        @include('customer.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="customer">
                                <a type="button" href="{{ route('exportPDF.customersAll') }}" class="btn btn-success">
                                    <i class="fas fa-file-export">Cetak data dan Export PDF</i>
                                </a>
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
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        data-target=".customer-edit-{{ $data->id }}"><i
                                                            class="fas fa-edit"></i>Edit
                                                    </a>
                                                    <a href="{{ route('customer.show', $data->id) }}"
                                                        class="btn btn-warning"><i class="fas fa-id-card"></i> Show</a>
                                                    <button class="btn btn-danger delete"
                                                        onclick="return confirm('Are You Sure ?')"><i
                                                            class="fas fa-trash"></i>Delete</button>
                                                </form>
                                </tbody>
                                </td>
                                </tr>
                                @include('customer.edit')
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

@endsection
