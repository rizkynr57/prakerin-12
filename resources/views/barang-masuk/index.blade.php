@extends('adminlte::page')

@section('title', 'Data Barang Masuk')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
@include('layouts._flash')
@role('admin')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Barang Masuk
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".barangMasuk"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('barang-masuk.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangMasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Supplier</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pemasukan</th>
                                        <th>Tanggal Masuk Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangMasuk as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->supplier->nama_supplier }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pemasukan }}</td>
                                            <td>{{ $data->tgl_masuk }}</td>
                                            <td>
                                                <form action="{{ route('barang-masuk.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary"
                                                        data-toggle="modal"
                                                        data-target=".barangMasuk-edit-{{ $data->id }}">
                                                     <i class="fas fa-edit"></i></a>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure ?')">
                                                      <i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                </tbody>
                                </td>
                                </tr>
                                @include('barang-masuk.edit')
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
 @endrole

@role('petugas')
<div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Barang Masuk
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".barangMasuk">Tambah Data</a>
                        @include('barang-masuk.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangMasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Supplier</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pemasukan</th>
                                        <th>Tanggal Masuk Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangMasuk as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->supplier->kode }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pemasukan }}</td>
                                            <td>{{ $data->tgl_masuk }}</td>
                                            <td>
                                               <a class="btn btn-primary" data-toggle="modal"
                                                  data-target=".barangMasuk-edit-{{ $data->id }}">
                                                  <i class="fas fa-edit"></i></a>
                                               </a>
                                            </td>
                                       </tbody>
                                    </td>
                                </tr>
                                @include('barang-masuk.edit')
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endrole
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#barangMasuk').DataTable();
        });
    </script>
@endsection
