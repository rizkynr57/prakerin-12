<div class="modal fade barangMasuk-edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang-masuk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <input type="number" name="id_supplier" class="form-control" value="{{ $data->id_supplier }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="number" name="id_barang" class="form-control" value="{{ $data->id_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="text" class="form-control" name="jumlah" value="{{ $data->jumlah_pemasukan }}"required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Barang Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control" value="{{ $data->tgl_masuk }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

