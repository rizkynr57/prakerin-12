<div class="modal fade barang-edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <select name="jenis" class="form-control">
                         @foreach($jenis as $data)
                            <option value="{{ $data->id}}">{{ $data->nama_jenis }}</option>
                         @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenis" value="{{ $data->jenis_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="harga" value="{{ $data->harga }}">
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select name="satuan" class="form-control">
                         @foreach($satuan as $data)
                            <option value="{{ $data->id}}">{{ $data->nama_satuan }}</option>
                         @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
