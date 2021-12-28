@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
@role('admin')
<div class="container">
    <div class="'row">
        <div class="col">
            <div class="card">
                <div class="card-header">Data Supplier</div>
                    <a href="{{route('supplier.create')}}" class="btn btn-outline-primary">Tambah Data</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Nama Perusahaan</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($supplier as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_supplier }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->nama_perusahaan }}</td>
                                    <td>
                                        <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="" class="btn btn-outline-success">Edit</a>
                                        <a href="" class="btn btn-outline-warning">Show</a>
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger">
                                            Delete
                                        </button>
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
@stop

@section('css')

@stop

@section('js')

@stop
