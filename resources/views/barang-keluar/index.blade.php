@extends('adminlte::page')

@section('title', 'Data Barang Keluar')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Barang Keluar
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".barangKeluar">Tambah Data</a>
                        @include('barang-keluar.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangKeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pengiriman</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tujuan Pengiriman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangKeluar as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->customer->kode }}
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pengiriman }}</td>
                                            <td>{{ $data->total_harga }}</td>
                                            <td>{{ $data->tgl_pengiriman }}</td>
                                            <td>{{ $data->tujuan }}</td>
                                            <td>
                                                <form action="{{ route('barang-keluar.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('barang-keluar.edit', $data->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('barang-keluar.show', $data->id) }}"
                                                        class="btn btn-warning">Show</a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>

                                </tbody>

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
    @include('sweetalert::alert')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#barangKeluar').DataTable();
        });
    </script>
@endsection
