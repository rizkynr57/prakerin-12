@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')
<i class="fas fa-user"></i> Data Supplier
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div style="float: left;">
                         <a href="{{ route('exportPDF.suppliersAll') }}" class="btn btn-danger active">
                            <i class="fas fa-file-export"></i>  <span class="glyphicon glyphicon-export"></span> Export PDF
                        </a>
                    </div>
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".supplier"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('supplier.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="supplier">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($supplier as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->nama_supplier }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->no_telp }}</td>
                                            <td>{{ $data->nama_perusahaan }}</td>
                                            <td>
                                            <form action="{{ route('supplier.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-primary btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".supplier-edit-{{ $data->id }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".supplier-show-{{ $data->id }}">
                                                        <i class="fas fa-id-card"></i></a>
                                                <button class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Are you sure')">
                                                <i class="fas fa-trash"></i></button>
                                            </form>
                                        </tbody>
                                    </td>
                                </tr>
                                @include('supplier.edit')
                                @include('supplier.show')
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
            $('#supplier').DataTable();
        });
    </script>
@endsection
