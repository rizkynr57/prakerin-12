@extends('adminlte::page')

@section('title', 'Data Barang Keluar')

@section('content_header')

<h2><br></h2>

@endsection

@section('content')
@role('admin')
<div class="container">
    <div class="'row">
        <div class="col">
            <div class="card">
                <div class="card-header">Data Barang Keluar</div>
                    <a href="{{route('barang-keluar.create')}}" class="btn btn-outline-primary">Tambah Data</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pengiriman</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($keluar as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->id_supplier }}</td>
                                    <td>{{ $data->id_barang }}</td>
                                    <td>{{ $data->jumlah_pengiriman }}</td>
                                    <td>{{ $data->tgl_pengiriman }}</td>                                    <td>
                                        <form action="{{ route('barang-keluar.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('barang-keluar.edit', $data->id) }}" class="btn btn-outline-success">Edit</a>
                                        <a href="{{ route('barang-keluar.show', $data->id) }}" class="btn btn-outline-warning">Show</a>
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
@endrole
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('DataTables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#example').DataTable();
    });
</script>
@endsection
