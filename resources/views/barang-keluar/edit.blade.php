<div class="modal fade barangKeluar-edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang-keluar.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Customer</label>
                        <input type="number" name="id_customer" value="{{ $data->id_customer }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="number" name="id_barang" value="{{ $data->id_barang }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Pengiriman</label>
                        <input type="text" class="form-control" name="jumlah" value="{{ $data->jumlah_pengiriman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pengiriman Barang</label>
                      <input type="date" name="tgl_pengiriman" class="form-control" value="{{ $data->tgl_pengiriman }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tujuan Pengiriman</label>
                        <input type="text" name="tujuan" class="form-control" value="{{ $data->tujuan }}" required>
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
