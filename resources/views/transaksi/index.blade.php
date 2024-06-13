@extends('layouts.main')

@section('title', 'Transaksi')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/transaksi/semua') }}">
                semua
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/transaksi/belumdipinjam') }}">
                waiting
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
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('transaksi/tolakPeminjaman') }}">
                tolak
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between">
                            <h6></h6>
                            {{-- {{ dd($peminjaman) }} --}}
                            @if (count($peminjaman) > 0)
                                @php
                                    $statusSemuaSama = true;
                                    $statusPertama = $peminjaman[0]->status;

                                    foreach ($peminjaman as $peminjamanItem) {
                                        if ($peminjamanItem->status != $statusPertama) {
                                            $statusSemuaSama = false;
                                            break;
                                        }
                                    }
                                @endphp
                                <form action="{{ route('transaksi.pdf') }}" method="GET" class="d-inline"
                                    target="__blank">
                                    @csrf
                                    @method('GET')
                                    {{-- {{ dd($peminjaman[0]->status) }} --}}
                                    <input type="hidden" value="{{ $statusSemuaSama ? $statusPertama : 'beragam' }}"
                                        name="status">
                                    <button type="submit" class="btn btn-outline-warning mx-1">pdf</button>
                                </form>
                            @endif

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                @php

                                    $hasKerusakan = $peminjaman->contains('status', 2);
                                @endphp
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                kode pinjam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                peminjam id</th>

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


                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                colspan="2">
                                                Kondisi dan Action</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $item)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $loop->iteration }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $item->kode_pinjam }}
                                                    </p>
                                                </td>
                                                <td>

                                                    @foreach ($item->detail_peminjaman as $buku)
                                                      
                                                        @if ($buku->buku)
                                                            <p class="text-xs text-secondary mb-0 lis-3">
                                                                {{ $buku->buku->judul }}
                                                            </p>
                                                        @endif
                                                    @endforeach


                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $item->user ? $item->user->name : 'N/A' }}
                                                    </p>
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
                                                    @if ($item->tanggal_pengembalian > $item->tanggal_kembali)
                                                        <p class="text-xs text-danger mb-0 ps-3">
                                                            {{ $item->tanggal_pengembalian }}
                                                        </p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0 ps-3">
                                                            {{ $item->tanggal_pengembalian }}
                                                        </p>
                                                    @endif
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
                                                    @elseif ($item->status == 5)
                                                        <span class="badge bg-success">ditolak</span>
                                                    @else
                                                        <span class="badge bg-danger">denda</span>
                                                    @endif
                                                </td>


                                                <td class="d-flex" colspan="2">
                                                    @if ($item->status == 1)
                                                        <form action="{{ route('transaksi.pinjam', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-danger mx-1">Pinjam</button>
                                                        </form>
                                                        <form action="{{ route('transaksi.tolak', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-danger mx-1">Tolak</button>
                                                        </form>
                                                    @elseif ($item->status == 2)
                                                        <form action="{{ route('transaksi.kembali', $item->id) }}"
                                                            method="POST" class="d-flex">
                                                            @csrf
                                                            @method('POST')
                                                            <select name="kondisi[{{ $item->id }}]" class="form-select"
                                                                aria-label="Default select example">
                                                                <option value="normal" hidden></option>
                                                                <option value="normal">normal</option>
                                                                <option value="hilang">hilang</option>
                                                                <option value="rusak">rusak</option>
                                                            </select>
                                                            <button type="submit"
                                                                class="btn btn-warning mx-1">Kembali</button>
                                                        </form>
                                                    @elseif ($item->status == 4)
                                                        <p class="text-xs text-secondary  p-3">{{ $item->kondisi }}
                                                        </p>
                                                        <form action="{{ route('transaksi.bayar', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-warning mx-1">bayar</button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="btn mx-1">detail</button>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
