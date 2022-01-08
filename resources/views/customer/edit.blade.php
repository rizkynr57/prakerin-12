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
                <div class="card-header">Edit Customer</div>
                <div class="card-body">
                    <form action="{{ route('customer.update', $supplier->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" name="nama" value="{{ $customer->nama }}" class="form-control"
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
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" value="{{ $customer->alamat }}" class="form-control"
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
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{ $customer->email }}" class="form-control"
                        @error('email')
                            is-invalid
                        @enderror>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="no_telp" value="{{ $customer->no_telp }}" class="form-control"
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
@stop

@section('css')

@stop

@section('js')

@stop

