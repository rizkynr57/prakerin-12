<div class="modal fade satuan-show-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Show Data Satuan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Satuan</label>
                        <input type="text" class="form-control" name="satuan"
                            value="{{ $data->nama_satuan }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
        </div>
    </div>
</div>
