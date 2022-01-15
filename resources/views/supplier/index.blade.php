@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')

    <h2><br></h2>

@endsection
@section('content')
    @include('layouts._flash')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header"><i class="fas fa-user"></i> Data Supplier
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".supplier">Tambah Data</a>
                        @include('supplier.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="supplier">
                                <a type="button" href="{{ route('exportPDF.suppliersAll') }}" class="btn btn-success">
                                    <i class="fas fa-file-export">Cetak data dan Export PDF</i>
                                </a>
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
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        data-target=".supplier-edit-{{ $data->id }}"><i
                                                            class="fas fa-edit"></i>Edit
                                                    </a>
                                                    <a class="btn btn-outline btn-sm btn-outline-info" data-toggle="modal"
                                                        data-target=".supplier-show-{{ $data->id }}">Show
                                                          <i class="fas fa-id-card"></i> Show</a>
                                                    <button class="btn btn-danger delete"
                                                        onclick="return confirm('Are You Sure ?')"><i
                                                            class="fas fa-trash"></i>Delete</button>
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
