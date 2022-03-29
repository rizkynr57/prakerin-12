@extends('adminlte::page')

@section('title', 'Data Jenis')

@section('content_header')
 Data Jenis
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".jenis"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('jenis.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="jenis">
                                <thead>
                                    <tr>
                                        <th>No</th> 
                                        <th>Nama Jenis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($jenis as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_jenis }}</td>
                                            <td>
                                            <form action="{{ route('jenis.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-primary btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".jenis-edit-{{ $data->id }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".jenis-show-{{ $data->id }}">
                                                        <i class="fas fa-id-card"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Are you sure?');">
                                                <i class="fas fa-trash"></i></button>
                                            </form>
                                        </tbody>
                                    </td>
                                </tr>
                                @include('jenis.edit')
                                @include('jenis.show')
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
            $('#jenis').DataTable();
        });
    </script>s
@endsection
