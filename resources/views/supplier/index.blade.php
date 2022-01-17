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
                    <div class="card-header"><i class="fas fa-user"></i> Data Supplier
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
                                                <form action="{{ route('supplier.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary" data-toggle="modal"
                                                        data-target=".supplier-edit-{{ $data->id }}"><i
                                                            class="fas fa-edit"></i>Edit
                                                    </a>
                                                    <a class="btn btn-outline btn-sm btn-outline-info" data-toggle="modal"
                                                        data-target=".supplier-show-{{ $data->id }}">Show
                                                          <i class="fas fa-id-card"></i> Show</a>
                                                    <button class="btn btn-danger delete"
                                                        onclick="return confirm('Are You Sure ?')"><i
                                                            class="fas fa-trash"></i>Delete</button>
                                                </form>
                                        </tbody>
                                    </td>
                                </tr>
                                @include('supplier.edit')
                                @include('supplier.show')
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

    <script type="text/javascript">
          var table = $(#supplier).DataTables({
                 processing = true;
                 serverSide = true;
                 ajax = "{{ route('api.supplier') }}",
                 column = [
                           {data: 'id', name, 'id'},
                           {data: 'nama_supplier', name, 'nama'},
                           {data: 'alamat', name, 'alamat'},
                           {data: 'no_telp', name, 'no_telp'},
                           {data: 'nama_perusahaan', name, 'perusahaan'},
                           {data: 'action', name, 'action', orderable: false, searchable: false}
                          ]
                   });
        
               function addForm() {
                    save_method = "add";
                    $('input[name=_method]').val('POST');
                    $('#modal-form').modal('show');
                    $('#modal-form form')[0].reset();
                    $'.modal-title').text('Tambah Data');
               }
               
               function editForm($id) {
                    save_method = 'edit';
                    $('input[name=_method').val('PUT');
                    $('#modal-form form')[0].reset();
                    $.ajax({
                           url: "{{ url('supplier') }}" + '/' + id + "/edit",
                           type: "GET",
                           dataType: "JSON",
                           success: function($data) {
                                $('#modal-form').modal('show');
                                $('.modal-title').text('Edit Supplier');

                                $('#id').val(data.id);
                                $('#nama_supplier').val(data.nama);
                                $('#alamat').val(data.alamat);
                                $('#no_telp').val(data.no_telp);
                                $('#nama_perusahaan').val(data.perusahaan);
                             },
                         error : function() {
                             alert('Tidak ada data');
                         } 
                       }); 
                      }

               function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Apakah anda yakin ?',
                text: "Kamu tidak akan bisa mengembalikan !",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Iya, hapus!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('supplier') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('supplier') }}";
                    else url = "{{ url('supplier') . '/' }}" + id;
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
