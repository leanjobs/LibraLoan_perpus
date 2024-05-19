@extends('layouts.main')
@section('title', 'Tambah Buku')
@section('content')
    {{-- content --}}
    <div class="container-fluid py-4">

        <!-- Button trigger modal -->
        <form action="{{ route('buku.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body container-fluid">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                        value="{{ old('judul') }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="image" class="form-label">image Buku</label>
                    <input autocomplete="off" required type="file"
                        class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="pengarang" class="form-label">pengarang</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang"
                        value="{{ old('pengarang') }}">
                    @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="stok" class="form-label">Stok Buku</label>
                    <input autocomplete="off" required type="number"
                        class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                        value="{{ old('stok') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="tahun_terbit" class="form-label">tahun_terbit</label>
                    <input autocomplete="off" required type="date"
                        class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                        name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="deskripsi" class="form-label">deskripsi</label>
                    <input autocomplete="off" required type="text"
                        class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                        value="{{ old('deskripsi') }}">
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="kategori_bukus_id" class="form-label">kategori_bukus_id</label>
                    <select name="kategori_bukus_id" class="form-select" aria-label="Default select example">
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                            </option>
                            {{-- <option value="2"></option>
                    <option value="3"></option> --}}
                        @endforeach
                    </select>
                    @error('kategori_bukus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror


                </div>
            </div>
            <div class="modal-footer">
                <a class="btn bg-gradient-secondary" href="{{ url('/perpus') }}">Back</a>
                {{-- <button type="button" class="btn bg-gradient-secondary">Close</button> --}}
                <button type="submit" class="btn bg-gradient-primary ms-3">Save changes</button>
            </div>
        </form>

    </div>
@endsection
