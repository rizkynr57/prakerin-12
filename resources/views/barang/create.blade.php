<div class="modal fade barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenis_barang">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Asli</label>
                        <input type="text" class="form-control" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="text" class="form-control" name="jual">
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <input type="text" class="form-control" name="satuan">
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
