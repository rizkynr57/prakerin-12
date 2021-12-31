@extends('adminlte::page')

@section('title', 'Barang Masuk')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
@role('admin')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">Add Supplier</div>
                <div class="card-body">
                    <form action="{{route('barang-masuk.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama" class="form-control @error('nama')
                            is-invalid
                        @enderror">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" name="jenis" class="form-control @error('jenis')
                            is-invalid
                        @enderror">
                        @error('jenis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="text" name="jumlah" class="form-control @error('jumlah')
                            is-invalid
                        @enderror">
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">ID Supplier</label>
                       <select name="id_supplier" class="form-control">
                        <option value="">Pilih Supplier</option>
                       @foreach ($supplier as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_supplier }}</option>
                       @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Masuk Barang</label>
                        <input type="date" name="tgl_masuk" class="form-control @error('tgl_masuk')
                            is-invalid
                        @enderror">
                        @error('tgl_masuk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success">Tambah</button>
                        <button type="reset" class="btn btn-outline-warning">Reset</button>
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
