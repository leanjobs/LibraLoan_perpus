@extends('layouts.main')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-primary" data-bs-toggle="modal" data-bs-target="#createKategori">
                Tambah Kategori
            </button>
            @include('perpus.kategori.createKategori')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Kategori Buku</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- <form action="{{ route('kategori_buku') }}" method="post" enctype="multipart/form-data">
                                                                                                                                      @csrf -->
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kategori</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Image</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoris as $kategori)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $kategori->id }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $kategori->nama_kategori }}</p>
                                                </td>
                                                <td>
                                                    @if ($kategori->image_kategori)
                                                        <img src="{{ asset('storage/' . $kategori->image_kategori) }}"
                                                            alt="" class="rounded mb-0 " style="height: 100px;">
                                                    @else
                                                        <img src="https://pngtree.com/freepng/no-image-vector-illustration-isolated_4979075.html"
                                                            alt="" class="rounded" style="width: 150px;">
                                                    @endif
                                                </td>

                                                <td class="d-flex">

                                                    <form action="{{ route('kategori.delete', $kategori->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn mx-1" style="background-color: #FF7917; color: white;">Delete</button>

                                                    </form>
                                                    <button type="button" class="btn" style="background-color: #0D82F9; color: white;" data-bs-toggle="modal"
                                                        data-bs-target="#editKategori_{{ $kategori->id }}"
                                                        data-book-id={{ $kategori->id }}>
                                                        Edit Kategori
                                                    </button>
                                                    @include('perpus.kategori.updateKategori')
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
