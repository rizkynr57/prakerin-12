@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
@role('admin')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Show</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control" value="{{ $supplier->nama_supplier }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $supplier->alamat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $supplier->no_telp }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Perusahaan</label>
                        <input type="text" name="perusahaan" class="form-control" value="{{ $supplier->nama_perusahaan }}" readonly>
                    </div>
                    <div class="form-group">
                        <br>
                        <a href="{{ route('supplier.index') }}" class="btn btn-outline-primary">Kembali</a>
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
