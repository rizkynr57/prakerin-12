@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')

<h2><br></h2>

@endsection

@section('content')
@role('admin')
<div class="container">
    <div class="'row">
        <div class="col">
            <div class="card">
                <div class="card-header">Data Barang
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah Barang</th>
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
                                    <td>{{ $data->barang_masuk->id }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jenis_barang }}</td>
                                    <td>{{ $data->jumlah_barang }}</td>                                    <td>
                                    <td>{{ $data->satuan }}</td>                                    <td>
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
