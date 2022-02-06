@extends('adminlte::page')

@section('title', 'Beranda')

@section('content_header')
<hr>
@endsection

@section('content')
    @role('admin')
        <div class="container">
            <div class="row mt-5">
                <div class="col-xl-8 col-md-6">
                    <div class="card mb-4" style="width: 20rem;">
                        <img src="{{ asset('assets/img/supplier.jpeg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Supplier</h5>
                            <h3 class="card-text">{{ $supplier }}</h3>
                            <a href="{{ url('supplier') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4" style="width: 20rem;">
                        <img src="{{ asset('assets/img/customer.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Customer</h5>
                            <h3 class="card-text">{{ $customer }}</h3>
                                <a href="{{ url('customer') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Data Barang Di Gudang
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                   <th>No</th>
                                   <th>Nama Barang</th>
                                   <th>Jenis Barang</th>
                                   <th>Stok Barang</th>
                                   <th>Harga Beli</th>
                                   <th>Harga Jual</th>
                                   <th>Satuan</th>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barang as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jenis_barang }}</td>
                                    <td>{{ $data->stok_barang }}</td>
                                    <td>{{ $data->harga }}</td>
                                    <td>{{ $data->harga_jual }}</td>
                                    <td>{{ $data->satuan }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
    @role('petugas')
       <div class="container">
            <div class="row mt-5">
                <div class="col-xl-8 col-md-6">
                    <div class="card mb-4" style="width: 20rem;">
                        <img src="{{ asset('assets/img/supplier.jpeg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Barang Masuk</h5>
                            <h3 class="card-text">{{ $masuk }}</h3>
                                <a href="{{ url('barang-masuk') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mb-4" style="width: 20rem;">
                        <img src="{{ asset('assets/img/customer.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Barang Keluar</h5>
                            <h3 class="card-text">{{ $keluar }}</h3>
                                <a href="{{ url('barang-keluar') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection

@section('css')

@endsection

@section('js')

@endsection
