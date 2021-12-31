@extends('adminlte::page')

@section('title', 'Data Barang Masuk')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
@role('admin')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Edit Barang Masuk</div>
                <div class="card-body">
                    <form action="{{ route('barang-masuk.update', $masuk->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama" value="{{ $masuk->nama_barang }}" class="form-control"
                        @error('nama')
                        is-invalid
                        @enderror>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" name="jenis" value="{{ $masuk->jenis_barang }}" class="form-control"
                        @error('jenis')
                            is-invalid
                        @enderror>
                        @error('jenis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="text" name="jumlah" value="{{ $masuk->jumlah_barang }}" class="form-control"
                        @error('jumlah')
                            is-invalid
                        @enderror>
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <select name="id_supplier" class="form-control" readonly>
                            @foreach ($supplier as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Masuk Barang</label>
                        <input type="text" name="tgl_masuk" value="{{ $masuk->tgl_masuk }}" class="form-control"
                        @error('tgl_masuk')
                            is-invalid
                        @enderror>
                        @error('tgl_masuk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-outline-primary">Edit</button>
                    </div>
                    </form>
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
