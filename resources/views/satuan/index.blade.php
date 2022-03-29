@extends('adminlte::page')

@section('title', 'Data Satuan')

@section('content_header')
 Data Satuan
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a type="button" style="float: right;" class="btn btn-primary" data-toggle="modal"
                            data-target=".satuan"><i class="fas fa-plus"></i> Tambah Data</a>
                        @include('satuan.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="satuan">
                                <thead>
                                    <tr>
                                        <th>No</th> 
                                        <th>Nama Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($satuan as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_satuan }}</td>
                                            <td>
                                            <form action="{{ route('satuan.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-primary btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".satuan-edit-{{ $data->id }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm rounded-circle" data-toggle="modal"
                                                    data-target=".satuan-show-{{ $data->id }}">
                                                        <i class="fas fa-id-card"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Are you sure?');">
                                                <i class="fas fa-trash"></i></button>
                                            </form>
                                        </tbody>
                                    </td>
                                </tr>
                                @include('satuan.edit')
                                @include('satuan.show')
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
            $('#satuan').DataTable();
        });
    </script>s
@endsection
