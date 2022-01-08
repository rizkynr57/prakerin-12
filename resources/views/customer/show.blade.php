@extends('adminlte::page')

@section('title', 'Data Customer')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Show</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" name="nama" class="form-control" value="{{ $customer->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $customer->alamat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $customer->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $customer->no_telp }}" readonly>
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
@stop

@section('css')

@stop

@section('js')

@stop
