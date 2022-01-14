<div class="modal fade supplier-show-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Supplier</label>
                        <input type="text" class="form-control" name="kode" value="{{ $data->kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <input type="text" class="form-control" name="nama" value="{{ $data->nama_supplier }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ $data->no_telp }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="perusahaan"
                            value="{{ $data->nama_perusahaan }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('supplier') }}" class="btn btn-outline-primary"><i class="fas fa-backward"></i>Kembali</a>
                </div>
        </div>
    </div>
</div>
