@extends('adminlte::page')

@section('title', 'Data Barang Masuk')

@section('content_header')

<h2><br></h2>

@endsection

@section('content')
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
                                <th>Nama Supplier</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan</th>
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
                                    <td>{{ $data->jenis_barang }}</td>
                                    <td>{{ $data->jumlah_barang }}</td>
                                    <td>{{ $data->satuan }}</td>
                                    <td>{{ $data->tgl_masuk }}</td>
                                    <td>
                                        
                                        @include('barang-masuk.edit')
                                        <a href="{{ route('laporanBarangMasuk', $data->id) }}" class="btn btn-outline-warning" target="_blank">Print</a>
                                        @include('barang-masuk.delete')
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
@include('sweetalert::alert')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('DataTables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#barangMasuk').DataTable();
    });
</script>
@endsection
