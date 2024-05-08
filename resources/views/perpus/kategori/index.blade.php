@extends('layouts.main')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createKategori">
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

                                                <td class="d-flex">

                                                    <form action="{{ route('kategori.delete', $kategori->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-1">Delete</button>

                                                    </form>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
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
