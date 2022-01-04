@extends('adminlte::page')

@section('title', 'Barang Masuk')

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
                        <label for="">ID Supplier</label>
                        <input type="number" name="id_supplier" class="form-control" value="{{ $barangMasuk->id_supplier }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">ID Barang</label>
                        <input type="number" name="id_barang" class="form-control" value="{{ $barangMasuk->id_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" name="jenis" class="form-control" value="{{ $barangMasuk->jenis_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="number" name="jumlah" class="form-control" value="{{ $supplier->jumlah_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Pemasukan Barang</label>
                        <input type="date" name="tgl_masuk" class="form-control" value="{{ $supplier->tgl_pemasukan}}" readonly>
                    </div>
                    <div class="form-group">
                        <br>
                        <a href="{{ route('barang-masuk.index') }}" class="btn btn-outline-primary">Kembali</a>
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
