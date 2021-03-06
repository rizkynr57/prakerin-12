@extends('adminlte::page')

@section('title', 'Data Barang Keluar')

@section('content_header')

   <i class="fas fa-truck"></i> Data Barang Keluar

@endsection

@section('content')
@role('admin')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".barangKeluar"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('barang-keluar.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangKeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pengiriman</th>
                                        <th>Harga Satuan</th>
                                        <th>Tujuan Pengiriman</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangKeluar as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->customer->kode }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pengiriman }}</td>
                                            <td>{{ $data->harga_satuan }}</td>
                                            <td>{{ $data->tujuan }}</td>
                                            <td>{{ $data->tgl_pengiriman }}</td>
                                            <td>
                                                <form action="{{ route('barang-keluar.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary btn-sm rounded-circle"
                                                        data-toggle="modal"
                                                        data-target=".barangKeluar-edit-{{ $data->id }}">
                                                     <i class="fas fa-edit"></i></a>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Are you sure?');">
                                                     <i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                </tbody>
                                </td>
                                </tr>
                                @include('barang-keluar.edit')
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
                    <div class="card-header">Data Barang Keluar
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".barangKeluar">Tambah Data</a>
                        @include('barang-keluar.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangKeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pengiriman</th>
                                        <th>Harga Satuan</th>
                                        <th>Tujuan Pengiriman</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangKeluar as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->customer->kode }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pengiriman }}</td>
                                            <td>{{ $data->harga_satuan }}</td>
                                            <td>{{ $data->tujuan }}</td>
                                            <td>{{ $data->tgl_pengiriman }}</td>
                                            <td>
                                               <a class="btn btn-primary btn-sm rounded-circle" data-toggle="modal"
                                                   data-target=".barangKeluar-edit-{{ $data->id }}">
                                                  <i class="fas fa-edit"></i></a>
                                                </td>
                                           </tbody>
                                      </td>
                                </tr>
                                @include('barang-keluar.edit')
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
            $('#barangKeluar').DataTable();
        });
    </script>
@endsection
