@extends('adminlte::page')

@section('title', 'Data Barang Keluar')

@section('content_header')

    <h2><br></h2>

@endsection

@section('content')
@include('layouts._flash')
@role('admin')
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
                                        <th>Harga Satuan</th>
                                        <th>Satuan</th>
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
                                            <td>{{ $data->harga_satuan }}</td
                                            <td>{{ $data->satuan }}</td>
                                            <td>{{ $data->jumlah_pengiriman }}</td>
                                            <td>{{ $data->total_harga }}</td>
                                            <td>{{ $data->tgl_pengiriman }}</td>
                                            <td>{{ $data->tujuan }}</td>
                                            <td>
                                                <form action="{{ route('barang-keluar.destroy', $data->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-outline btn-sm btn-outline-warning"
                                                        data-toggle="modal"
                                                        data-target=".barangKeluar-edit-{{ $data->id }}">
                                                      <i class="fas fa-edit"> Edit</a>
                                                    <a href="{{ route('laporanBarangKeluar', $data->id) }}"
                                                     class="btn btn-warning" target="_blank">
                                                        <i class="fas fa-print"></i> Print</a>
                                                    <button type="submit" class="btn btn-danger">
                                                     <i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </td>

                                </tbody>

                                </td>
                                </tr>
                                @include('barang-keluar.edit')
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
   @endrole

@role('petugas')
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
                                        <th>Harga Satuan</th>
                                        <th>Satuan</th>
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
                                            <td>{{ $data->harga_satuan }}</td
                                            <td>{{ $data->satuan }}</td>
                                            <td>{{ $data->jumlah_pengiriman }}</td>
                                            <td>{{ $data->total_harga }}</td>
                                            <td>{{ $data->tgl_pengiriman }}</td>
                                            <td>{{ $data->tujuan }}</td>
                                            <td>
                                               <a class="btn btn-outline btn-sm btn-outline-warning"
                                                   data-toggle="modal"
                                                   data-target=".barangKeluar-edit-{{ $data->id }}">
                                                  <i class="fas fa-edit"> Edit</a>                                            </td>
                                           </tbody>
                                      </td>
                                </tr>
                                @include('barang-keluar.edit')
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endrole
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

    <script type="text/javascript">
        var table = $('#barangKeluar').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.BarangKeluar') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama_customer', name 'nama_customer'},
                {data: 'nama_barang', name: 'nama_barang'},
                {data: 'jumlah_pengiriman', name: 'jumlah'},
                {data: 'tujuan', name: 'tujuan'},
                {data: 'tgl_pengiriman', name 'tgl_pengiriman'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Data');
        }
        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('barang-keluar') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Products');
                    $('#id').val(data.id);
                    $('#id_customer').val(data.id_customer);
                    $('#id_barang').val(data.id_barang);
                    $('#jumlah_pengiriman').val(data.jumlah);
                    $('#tujuan').val(data.tujuan);
                    $('#tgl_pengiriman').val(data.tgl_pengiriman);
                },
                error : function() {
                    alert("Tidak ada data");
                }
            });
        }
        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Apakah anda yakin ?',
                text: "Anda tidak akan bisa mengembalikan!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Iya, hapus!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('barang-keluar') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }
        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('barang-keluar') }}";
                    else url = "{{ url('barang-keluar') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
