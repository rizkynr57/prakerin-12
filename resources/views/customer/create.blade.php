<div class="modal fade customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Customer</label>
                        <input type="text" class="form-control boxed" name="kode" value="{{ $code }}" readonly>
                    </div> --}}
                <div class="form-group">
                    <label for="">Nama Customer</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" required>
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
