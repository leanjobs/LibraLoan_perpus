@extends('layouts.main_newuserview')
@section('title', 'LibraLoan')
@section('content')

    {{-- content --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <h1 style="font-size: 30px;">My Activity</h1>

    <div class="tabs">
        <button class="tab-button" id="btn-status" onclick=" window.location.href='{{ url('/show/keranjang') }}'"
            data-url="{{ url('/show/keranjang') }}">
            semua
        </button>
        <button class="tab-button" id="btn-status" onclick="window.location.href='{{ url('/show/peminjaman') }}'"
            data-url="{{ url('/show/peminjaman') }}">
            peminjaman
        </button>
        <button class="tab-button" id="btn-status" onclick="window.location.href='{{ url('/show/denda') }}'"
            data-url="{{ url('/show/denda') }}">
            denda
        </button>
        <button class="tab-button" id="btn-status" onclick="window.location.href='{{ url('/show/history') }}'"
            data-url="{{ url('/show/history') }}">
            history
        </button>
        <button class="tab-button" id="btn-status" onclick="window.location.href='{{ url('/show/penolakan') }}'"
            data-url="{{ url('/show/penolakan') }}">
            tolak
        </button>
    </div>

    <div id="BorrowingBooks" class="tab-content">
        <table>
            <tr>
                <th>Book Name</th>
                <th>Request Date</th>
                <th>Deadlines</th>
                <th>Return Date</th>
                <th>Penalties</th>
                <th>status</th>
                {{-- <th>Action</th> --}}
            </tr>
            @foreach ($keranjang as $peminjaman)
                @foreach ($detail_peminjaman->where('peminjaman_id', $peminjaman->id) as $item)
                    <tr>
                        <td class="p-4">
                            <p class="text-xs text-secondary ">
                                @if ($item->buku)
                                    <a href="/detailBuku/{{ $item->bukus_id }}">
                                        {{ $item->buku->judul }}
                                    </a>
                                @else
                                    <span>Book not found</span>
                                @endif
                            </p>

                        </td>

                        <td class="p-4">
                            <p class="text-xs text-secondary ">
                                {{ $peminjaman->tanggal_pinjam }}
                            </p>
                        </td>
                        <td class="p-4">
                            <p class="text-xs text-secondary ">
                                {{ $peminjaman->tanggal_kembali }}
                            </p>
                        </td>
                        <td class="p-4">
                            <p class="text-xs text-secondary ">
                                {{ $peminjaman->tanggal_pengembalian }}
                            </p>
                        </td>
                        <td>
                            <p class="text-xs text-secondary mb-0 ps-3">Rp.
                                {{ $peminjaman->denda >= 0 ? number_format($peminjaman->denda) : '-' }}
                            </p>
                        </td>

                        <td class="p-4">
                            @if ($peminjaman->status == 1)
                                <p class="text-xs text-danger ">
                                    waiting
                                </p>
                            @elseif ($peminjaman->status == 2)
                                <p class="text-xs text-danger ">
                                    approve
                                </p>
                            @elseif ($peminjaman->status == 3)
                                <p class="text-xs text-danger ">
                                    done
                                </p>
                            @elseif ($peminjaman->status == 4)
                                <p class="text-xs text-danger ">
                                    fines
                                </p>
                            @elseif ($peminjaman->status == 5)
                                <p class="text-xs text-danger ">
                                    tolak
                                </p>
                            @endif

                        </td>


                    </tr>
                @endforeach
            @endforeach


        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.tab-button');
            var currentUrl = window.location.href;

            buttons.forEach(function(button) {
                var buttonUrl = button.getAttribute('data-url');
                if (currentUrl.includes(buttonUrl)) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("BorrowingBooks").style.display = "flex";
        });
    </script>

@endsection
