<!-- Modal -->
<div class="modal fade" id="editKategori_{{ $kategori->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">edit kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.update', ['id' => $kategori->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editKategoriId" value="{{ $kategori->id }}">
                    <div class="modal-body container-fluid">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">nama_kategori</label>
                            <input autocomplete="off" required type="text"
                                class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
