<div class="modal fade barangMasuk" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-item" action="{{ route('barang-masuk.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <select class="form-control" name="id_supplier" id="id_supplier">
                            <option value=""></option>
                            @foreach ($supplier as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <select class="form-control" name="id_barang" id="id_barang">
                            <option value=""></option>
                            @foreach ($barang as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Pemasukan</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Barang Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
