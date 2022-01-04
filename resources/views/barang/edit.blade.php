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
                <div class="card-header">Edit Supplier</div>
                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <input type="text" name="nama" value="{{ $supplier->nama_perusahaan }}" class="form-control"
                        @error('fistname')
                        is-invalid
                        @enderror>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" value="{{ $supplier->alamat }}" class="form-control"
                        @error('alamat')
                            is-invalid
                        @enderror>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="no_telp" value="{{ $supplier->no_telp }}" class="form-control"
                        @error('no_telp')
                            is-invalid
                        @enderror>
                        @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Perusahaan</label>
                        <input type="text" name="perusahaan" value="{{ $supplier->nama_perusahaan }}" class="form-control"
                        @error('perusahaan')
                            is-invalid
                        @enderror>
                        @error('perusahaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                        <button type="reset" class="btn btn-outline-warning">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')

@stop

@section('js')

@stop
