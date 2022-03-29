<div class="modal fade jenis-show-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Show Data Jenis</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Jenis</label>
                        <input type="text" class="form-control" name="jenis"
                            value="{{ $data->nama_jenis }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
        </div>
    </div>
</div>
