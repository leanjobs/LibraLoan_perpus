@extends('layouts.main')
@section('title', 'Update Buku')
@section('content')
    {{-- content --}}
    <div class="container-fluid py-4">
        <form action="{{ route('buku.update', ['id' => $buku->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editBookId" value="{{ $buku->id }}">
            <div class="modal-body container-fluid">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                        value="{{ old('judul', $buku->judul) }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="image" class="form-label">image Buku</label>

                    <input autocomplete="off" type="file" class="form-control @error('image') is-invalid @enderror"
                        id="image" name="image" value="{{ old('image', $buku->image) }}">
                    <img src="{{ asset('storage/' . $buku->image) }}" alt="" class="p-2 h-50 d-flex"
                        style="width: 150px;">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror


                    <label for="pengarang" class="form-label">pengarang</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang"
                        value="{{ old('pengarang', $buku->pengarang) }}">
                    @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="stok" class="form-label">Stok Buku</label>
                    <input autocomplete="off" required type="number"
                        class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                        value="{{ old('stok', $buku->stok) }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="tahun_terbit" class="form-label">tahun_terbit</label>
                    <input autocomplete="off" required type="date"
                        class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                        name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                        value="{{ old('deskripsi', $buku->deskripsi) }}">
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="kategori_bukus_id" class="form-label">kategori_bukus_id</label>
                    <select name="kategori_bukus_id" class="form-select" aria-label="Default select example">
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ $kategori->id == $buku->kategori_bukus_id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_bukus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
            </div>
            <div class="modal-footer">
                <a class="btn bg-gradient-secondary" href="{{ url('/perpus') }}">Back</a>
                {{-- <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Back</button> --}}
                <button type="submit" class="btn bg-gradient-primary ms-3">Save changes</button>

            </div>
        </form>


    </div>
@endsection
