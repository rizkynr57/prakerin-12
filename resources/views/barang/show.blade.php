<div class="modal fade barang-show-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Show Data Barang</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" value="{{ $data->nama_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenis" value="{{ $data->jenis_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="harga" value="{{ $data->harga }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <input type="text" class="form-control" name="satuan" value="{{ $data->satuan }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
        </div>
    </div>
</div>
