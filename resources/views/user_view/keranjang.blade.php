@extends('layouts.main_userview')
@section('title', 'LibraLoan')
@section('content')

    {{-- content --}}
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/show/keranjang') }}">
                semua
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/show/peminjaman') }}">
                peminjaman
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/show/denda') }}">
                denda
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/show/history') }}">
                history
            </a>
            <a class="btn bg-gradient-primary mt-0 w-15" id="btn-status" href="{{ url('/show/penolakan') }}">
                tolak
            </a>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header pb-0">
                                    {{-- <h6> My Activity</h6> --}}
                                </div>
                                <div class="card-body  pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                {{-- {{ dd($keranjang) }} --}}
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        Judul</th>

                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        pengarang</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        tanggal pinjam</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        tenggat</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        tanggal pengembalian</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        action</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        status</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-4">
                                                        denda</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($keranjang as $peminjaman)
                                                    @foreach ($detail_peminjaman->where('peminjaman_id', $peminjaman->id) as $item)
                                                        <tr>
                                                            <td class="p-4">
                                                                <p class="text-xs text-secondary ">
                                                                    {{-- {{ dd($item->buku) }} --}}
                                                                    <a href="/detailBuku/{{ $item->buku->id }}">
                                                                        {{ $item->buku->judul }}
                                                                    </a>
                                                                </p>

                                                            </td>


                                                            <td class="p-4">
                                                                <p class="text-xs text-secondary ">
                                                                    {{ $item->buku->pengarang }}
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
                                                            <td class="p-4">
                                                                {{-- @if ($peminjaman->status == 1)
                                                                    <form
                                                                        action="{{ route('delete.keranjang', $item->buku->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger mx-1">Delete</button>

                                                                    </form>
                                                                @elseif ($peminjaman->status == 3)
                                                                    <form
                                                                        action="{{ route('delete.keranjang', $item->buku->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-warning mx-1">Review</button>

                                                                    </form>
                                                                @endif --}}


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
                                                            <td>
                                                                <p class="text-xs text-secondary mb-0 ps-3">Rp.
                                                                    {{ $peminjaman->denda >= 0 ? number_format($peminjaman->denda) : '-' }}
                                                                </p>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @if (!$keranjang->tanggal_pinjam)
                        <button class="btn btn-sm btn-danger">Hapus Masal</button>
                    @endif --}}

                </div>

            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">



            {{-- <script>
                $(document).ready(function() {
                    $(document).on('click', '#deleteButton', function() {
                        var bukuId = $(this).data('id');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('/delete/keranjang/') }}/" + bukuId,

                            success: function(response) {

                                if (response.status === 'success') {
                                    // Display a success message
                                    $('#message').html(
                                            `<div class="alert alert-success" role="alert">
                                                ${response.message}</div>`)
                                        .show().delay(3000).fadeOut();
                                } else if (response.status === 'error') {
                                    // Display an error message
                                    $('#message').html(
                                            `<div class="alert alert-danger" role="alert">
                                                ${response.message}</div>`)
                                        .show().delay(3000).fadeOut();
                                } else {
                                    alert('wrrrjodis');
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $('#gagal').show().delay(3000).fadeOut();
                            }
                        });
                    });

                });
            </script> --}}

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
