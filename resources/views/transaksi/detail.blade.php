@extends('layouts.main')

@section('title', 'Denda')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h3 class="mb-0">User Information</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">

                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Id :</strong> &nbsp; {{ $user->id }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Username:</strong>
                                    &nbsp; {{ $user->name }}</li>
                                {{-- <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Password
                                        :</strong>
                                    &nbsp; {{ $user->password }}</li> --}}
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp; {{ $user->email }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="card h-80">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h3 class="mb-0">Book Information</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">
                                        Judul :</strong> &nbsp; {{ $detail_peminjaman->buku->judul }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pengarang
                                        :</strong>
                                    &nbsp; {{ $detail_peminjaman->buku->pengarang }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tahun terbit
                                        :</strong>
                                    &nbsp; {{ $detail_peminjaman->buku->tahun_terbit }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Stok :</strong>
                                    &nbsp; {{ $detail_peminjaman->buku->stok }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            {{-- <h6>Daftar Buku</h6> --}}
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- <form action="{{ route('daftar_buku') }}" method="post" enctype="multipart/form-data">                                                                                                                                                                                                                                                  @csrf -->
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kode pinjam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal pinjam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tenggat</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal pengembalian</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                status </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ps-3">{{ $peminjaman->kode_pinjam }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ps-3">
                                                    {{ $peminjaman->tanggal_pinjam }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ps-3">
                                                    {{ $peminjaman->tanggal_kembali }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ps-3">
                                                    {{ $peminjaman->tanggal_pengembalian }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ps-3">
                                                    {{ $peminjaman->status }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary  ps-3">
                                                    Rp.
                                                    {{ $peminjaman->denda >= 0 ? number_format($peminjaman->denda) : '-' }}
                                                </p>

                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                <!-- </form> -->

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning mx-1" onclick="history.back()">back</button>

                    </div>

                </div>
            </div>

        </div>

    @endsection
