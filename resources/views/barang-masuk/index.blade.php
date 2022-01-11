@extends('adminlte::page')

@section('title', 'Data Barang Masuk')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Barang Masuk
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".barangMasuk">Tambah Data</a>
                        @include('barang-masuk.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="barangMasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Supplier</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pemasukan</th>
                                        <th>Tanggal Masuk Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barangMasuk as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->supplier->kode }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_pemasukan }}</td>
                                            <td>{{ $data->tgl_masuk }}</td>
                                            <td>
                                                <form action="{{ route('barang-masuk.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-outline btn-sm btn-outline-warning"
                                                        data-toggle="modal"
                                                        data-target=".barangMasuk-edit-{{ $data->id }}">Edit
                                                    </a>
                                                    <a href="{{ route('barang-masuk.show', $data->id) }}"
                                                        class="btn btn-warning">Show</a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                </tbody>
                                </td>
                                </tr>
                                @include('barang-masuk.edit')
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
            $('#barangMasuk').DataTable();
        });
    </script>
@endsection
