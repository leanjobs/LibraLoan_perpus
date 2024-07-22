<!-- Modal -->
<div class="modal fade" id="createKategori" tabindex="-1" role="dialog" aria-labelledby="createKategoriLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKategoriLabel">Tambah kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container-fluid">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">nama_kategori</label>
                            <input autocomplete="off" required type="text"
                                class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                name="nama_kategori" value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="image_kategori" class="form-label">image_kategori Buku</label>
                            <input autocomplete="off" required type="file"
                                class="form-control @error('image_kategori') is-invalid @enderror" id="image_kategori" name="image_kategori"
                                value="{{ old('image_kategori') }}">
                            @error('image_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
