@extends('adminlte::page')

@section('title', 'Data Supplier')

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
                        <label for="">ID Barang</label>
                        <input type="number" name="alamat" class="form-control" value="{{ $barangKeluar->id_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Pengiriman</label>
                        <input type="number" name="jumlah" class="form-control" value="{{ $barangKeluar->jumlah_pengiriman }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control" value="{{ $barangKeluar->tujuan }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pengiriman Barang</label>
                        <input type="date" name="tgl_pengiriman" class="form-control" value="{{ $barangKeluar->tgl_pengiriman }}">
                    </div>
                    <div class="form-group">
                        <br>
                        <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-primary">Kembali</a>
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
