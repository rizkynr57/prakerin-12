@extends('adminlte::page')

@section('title', 'Data Customer')

@section('content_header')

<h2><br></h2>

@endsection

@section('content')
<div class="container">
    <div class="'row">
        <div class="col">
            <div class="card">
                <div class="card-header">Data Customer
                    <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                    data-target=".customer">Tambah Data</a>
                    @include('customer.create')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="customer">
                           <a type="button" href="{{ route('exportPDF.customersAll') }}" class="btn btn-success">
                               <i class="fas fa-file-export">Cetak data dan Export PDF</i>
                           </a>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($customer as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>
                                        <form action="{{ route('customer.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('customer.edit', $data->id) }}" class="btn btn-outline-success">Edit</a>
                                        <a href="{{ route('customer.show', $data->id) }}" class="btn btn-outline-warning">Show</a>
                                        @include('customer.delete')
                                        </tbody>
                                        </form>
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
<script src="{{ asset('DataTables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#customer').DataTable();
    });
</script>
@endsection

