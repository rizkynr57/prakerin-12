@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')

<h2><br></h2>

@endsection

@section('content')
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
                    @if ($barang['jumlah_barang'] < 1) 
                        @foreach($barang as $item)
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
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
                                    <td>{{ $data->jumlah_barang }}</td>                                    
                                    <td>{{ $data->satuan }}</td>                                    
                                        <form action="{{ route('barang.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-outline-success">Edit</a>
                                        <a href="{{ route('barang.show', $data->id) }}" class="btn btn-outline-warning">Show</a>
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger">
                                            Delete
                                        </button>
                                        </tbody>
                                        </form>
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
        $('#barang').DataTable();
    });
</script>
@endsection
