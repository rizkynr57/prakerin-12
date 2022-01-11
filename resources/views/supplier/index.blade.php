@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')

    <h2><br></h2>

@endsection
@section('content')
@include('layouts._flash')
    <div class="container">
        <div class="'row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Supplier
                        <a type="button" style="float: right;" class="btn btn-outline-primary" data-toggle="modal"
                            data-target=".supplier">Tambah Data</a>
                        @include('supplier.create')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="supplier">
                                <a type="button" href="{{ route('exportPDF.suppliersAll') }}" class="btn btn-success">
                                    <i class="fas fa-file-export">Cetak data dan Export PDF</i>
                                </a>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($supplier as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->nama_supplier }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->no_telp }}</td>
                                            <td>{{ $data->nama_perusahaan }}</td>
                                            <td>
                                                
                                                    <a class="btn btn-outline btn-sm btn-outline-warning"
                                                        data-toggle="modal"
                                                        data-target=".supplier-edit-{{ $data->id }}">Edit
                                                    </a>
                                                    <a href="{{ route('supplier.show', $data->id) }}"
                                                        class="btn btn-warning">Show</a>
                                                    <a href="#" class="btn btn-danger delete"
                                                         data-id="{{ $data->id }}">Delete</button>
                                                
                                </tbody>

                                </td>
                                </tr>
                                @include('supplier.edit')
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
            $('#supplier').DataTable();
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
       var supplierid = $(this).attr('data-id');
       swal({
          title: "Apakah Anda Yakin?",
          text: "Jika data ini dihapus, maka anda tidak bisa mengembalikan!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
       })
         .then((willDelete) => {
          if (willDelete) {
             window.location = "/delete/"+supplierid+""
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
