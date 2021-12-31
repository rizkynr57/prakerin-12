<div class="modal fade supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang-keluar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <select name="id_barang" id="" class="form-control">
                            @foreach ($barang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <select name="id_supplier" id="" class="form-control">
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Pengiriman</label>
                        <input type="text" class="form-control" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pengiriman Barang</label>
                      <input type="date" name="tgl_pengiriman" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tujuan Pengiriman</label>
                        <input type="text" name="tujuan" class="form-control">
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
