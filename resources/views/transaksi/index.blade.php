@extends('layouts.main')

@section('title', 'Transaksi')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/transaksi/semua') }}">
                semua
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/transaksi/belumdipinjam') }}">
                belum dipinjam
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/transaksi/sedangdipinjam') }}">
                sedang dipinjam
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('transaksi/selesaidipinjam') }}">
                selesai dipinjam
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('transaksi/denda') }}">
                denda
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            {{-- <h6>@yield('status')</h6> --}}
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- <form action="{{ route('daftar_buku') }}" method="post" enctype="multipart/form-data">                                                                                                                            @csrf -->
                                <table class="table align-items-center mb-0">
                                    <thead>

                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>

                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                kode pinjam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul</th>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            peminjam id</th> --}}
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            petugas peminjam</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            petugas kembali</th> --}}
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                tanggal pinjam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                tenggat</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                tanggal pengembalian</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                denda</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $item)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $loop->iteration }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $item->kode_pinjam }}</p>
                                                </td>
                                                <td>
                                                    @foreach ($item->detail_peminjaman as $buku)
                                                        <li class="text-xs text-secondary mb-0 lis-3">
                                                            {{ $buku->buku->judul }}
                                                        </li>
                                                    @endforeach

                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $item->tanggal_pinjam }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $item->tanggal_kembali }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $item->tanggal_pengembalian }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">Rp.
                                                        {{ $item->denda >= 0 ? number_format($item->denda) : '-' }}</p>
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-info">belum dipinjam</span>
                                                    @elseif ($item->status == 2)
                                                        <span class="badge bg-warning">sedang dipinjam</span>
                                                    @elseif ($item->status == 3)
                                                        <span class="badge bg-success">selesai dipinjam</span>
                                                    @else
                                                        <span class="badge bg-danger">denda</span>
                                                    @endif
                                                </td>
                                                <td>

                                                    @if ($item->status == 1)
                                                        <form action="{{ route('transaksi.pinjam', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-danger mx-1">Pinjam</button>
                                                        </form>
                                                    @elseif ($item->status == 2)
                                                        <form action="{{ route('transaksi.kembali', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-warning mx-1">Kembali</button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="btn mx-1">detail</button>
                                                    @endif


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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('#btn-status');
            var currentUrl = window.location.href;

            buttons.forEach(function(button) {
                if (currentUrl.includes(button.href)) {
                    button.classList.remove('bg-gradient-primary');
                    button.classList.add('bg-gradient-light');
                } else {
                    button.classList.remove('bg-gradient-light');
                    button.classList.add('bg-gradient-primary');
                }
            });
        });
    </script>

@endsection
