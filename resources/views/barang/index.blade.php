@extends('adminlte::page')

@section('title', 'Data Barang')

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
                        <div class="card-header">Data Barang
                            <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                                data-target=".barang">Tambah Data</a>
                            @include('barang.create')
                        </div>
                         <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="barang">
                           @foreach ($barang as $item)
                              @if ($item->stok_barang < 1)                                   
                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                            aria-label="Warning:">
                                            <use xlink:href="#exclamation-triangle-fill" />
                                        </svg>
                                        <div>
                                            <strong>PERINGATAN!</strong>stok <b>$item->nama_barang</b> kosong!!!
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Stok Barang</th>
                                            <th>Harga</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($barang as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->nama_barang }}</td>
                                                <td>{{ $data->jenis_barang }}</td>
                                                <td>{{ $data->stok_barang }}</td>
                                                <td>{{ $data->harga }}</td>
                                                <td>{{ $data->satuan }}</td>
                                                <a class="btn btn-outline btn-sm btn-outline-warning" data-toggle="modal"
                                                    data-target=".barang-edit-{{ $data->id }}"><i
                                                            class="fas fa-edit">edit
                                                </a>
                                                <a class="btn btn-outline btn-sm btn-outline-info" data-toggle="modal"
                                                        data-target=".barang-show-{{ $data->id }}"><i class="fas fa-id-card"></i>show
                                                 </a>
                                    </tbody>

                                    </td>
                                    </tr>
                                    @include('barang.edit')
                                    @include('barang.show')
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
                        <div class="card-header">Data Barang</div>
                        <div class="card-body">
                            @if ($barang['stok_barang'] < 1)
                                @foreach ($barang as $item)
                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                            aria-label="Warning:">
                                            <use xlink:href="#exclamation-triangle-fill" />
                                        </svg>
                                        <div>
                                            <p style="color: red">PERINGATAN! </p>stok <b>$item['nama_barang']</b> kosong!!!
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="table-responsive">
                                <table class="table" id="barang">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Stok Barang</th>
                                            <th>Harga</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($barang as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->nama_barang }}</td>
                                                <td>{{ $data->jenis_barang }}</td>
                                                <td>{{ $data->stok_barang }}</td>
                                                <td>{{ $data->harga }}</td>
                                                <td>{{ $data->satuan }}</td>
                                    </tbody>
                                    </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#barang').DataTable();
        });
    </script>
@endsection
