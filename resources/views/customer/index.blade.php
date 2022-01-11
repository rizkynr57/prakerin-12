@extends('adminlte::page')

@section('title', 'Data Customer')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
@include('layouts._flash')
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
                                        <th>Kode Customer</th>
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
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->telepon }}</td>
                                            <td>
                                                
                                                    <a class="btn btn-outline btn-sm btn-outline-warning"
                                                        data-toggle="modal"
                                                        data-target=".customer-edit-{{ $data->id }}">Edit
                                                    </a>
                                                    <a href="{{ route('customer.show', $data->id) }}"
                                                        class="btn btn-warning">show</a>
                                                    <a type="submit" class="btn btn-danger delete"
                                                        data-id="{{ $data->id }}">Delete</a>
                                                
                                </tbody>

                                </td>
                                </tr>
                                @include('customer.edit')
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
            $('#customer').DataTable();
        });
    </script>

    <script
  src="https://code.jquery.com/jquery-3.6.0.slim.js"
         integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
        crossorigin="anonymous">
  </script>


   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    $('.delete').click(function () {
       var customerid = $(this).attr('data-id');
       swal({
          title: "Apakah Anda Yakin?",
          text: "Jika data ini dihapus, maka anda tidak bisa mengembalikan!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
       })
         .then((willDelete) => {
          if (willDelete) {
             window.location = "/delete/"+customerid+""
             swal("Data Terhapus!", {
             icon: "success",
       });
      } else {
           swal("Penghapusan Data Dibatalkan!");
        }
       });
     });
</script>
@endsection
