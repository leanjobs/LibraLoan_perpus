@extends('layouts.main')

@section('title', 'Daftar Buku')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createBuku">
                Tambah Buku
            </button>
            @include('perpus.buku.createBuku')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Daftar Buku</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- <form action="{{ route('daftar_buku') }}" method="post" enctype="multipart/form-data">
                                                                                                                                          @csrf -->
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul Buku</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cover</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                pengarang</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                stok</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                tahun terbit</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                deskripsi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                kategori</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bukus as $buku)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $buku->judul }}</p>
                                                </td>
                                                <td>
                                                    @if ($buku->image)
                                                        <img src="{{ asset('storage/' . $buku->image) }}" alt=""
                                                            class="rounded mb-0 " style="height: 100px;">
                                                    @else
                                                        <img src="https://pngtree.com/freepng/no-image-vector-illustration-isolated_4979075.html"
                                                            alt="" class="rounded" style="width: 150px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $buku->pengarang }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $buku->stok }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $buku->tahun_terbit }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $buku->deskripsi }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        @if ($buku->kategori_bukus)
                                                            {{ $buku->kategori_bukus->nama_kategori }}
                                                        @else
                                                            <span class="text-danger">tidak tersedia</span>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="d-flex">

                                                    <form action="{{ route('buku.delete', $buku->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-1">Delete</button>

                                                    </form>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editBuku_{{ $buku->id }}"
                                                        data-book-id={{ $buku->id }}>
                                                        Edit buku
                                                    </button>
                                                    @include('perpus.buku.updateBuku')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- </form> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
