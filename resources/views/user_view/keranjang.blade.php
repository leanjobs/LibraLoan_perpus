@extends('layouts.main_userview')
@section('title', 'LibraLoan')
@section('content')

    {{-- content --}}
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12 mb-4">

                    <div class="row">
                        <div class="col-md-12 mb-2">

                            @if ($keranjang->tanggal_pinjam)
                                <strong>Tanggal Pinjam: {{ $keranjang->tanggal_pinjam }}</strong>
                            @else
                                <form action="{{ route('pinjam.keranjang', $keranjang->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                    <input autocomplete="off" required type="date"
                                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                        id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">
                                    {{-- @error('tanggal_pinjam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                    <button type="submit" class="btn btn-success mx-1">PINJAM</button>
                                    @if (session('error'))
                                        <div>{{ session('error') }}</div>
                                    @endif

                                </form>
                            @endif
                            <strong class="float-right">Kode Pinjam : {{ $keranjang->kode_pinjam }}</strong>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header pb-0">
                                    <h6>Daftar Buku</h6>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                {{-- {{ dd($keranjang) }} --}}
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        No</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        image</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Judul</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        pengarang</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        action</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($keranjang->detail_peminjaman as $item)
                                                    <tr>
                                                        <td>
                                                            <p class="text-xs text-secondary mb-0 ps-3">
                                                                {{ $loop->iteration }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            @if ($item->buku->image)
                                                                <img src="{{ asset('storage/' . $item->buku->image) }}"
                                                                    alt="" class="rounded mb-0 "
                                                                    style="height: 100px;">
                                                            @else
                                                                <img src="https://pngtree.com/freepng/no-image-vector-illustration-isolated_4979075.html"
                                                                    alt="" class="rounded" style="width: 150px;">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p class="text-xs text-secondary mb-0 ps-3">
                                                                {{ $item->buku->judul }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs text-secondary mb-0 ps-3">
                                                                {{ $item->buku->pengarang }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            @if (!$keranjang->tanggal_pinjam)
                                                                <button id="deleteButton_" data-id="{{ $item->id }}"
                                                                    class="btn btn-danger">Hapus</button>
                                                            @endif

                                                            {{-- <form action="{{ route('delete.keranjang', $item->buku->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-1">Delete</button>

                                                    </form> --}}
                                                        </td>
                                                        <td>
                                                            @if ($keranjang->status == 1)
                                                                <p class="text-xs text-danger mb-0 ps-3">
                                                                    waiting
                                                                </p>
                                                            @elseif ($keranjang->status == 2)
                                                                <p class="text-xs text-danger mb-0 ps-3">
                                                                    approve
                                                                </p>
                                                            @elseif ($keranjang->status == 3)
                                                                <p class="text-xs text-danger mb-0 ps-3">
                                                                    done
                                                                </p>
                                                            @elseif ($keranjang->status == 4)
                                                                <p class="text-xs text-danger mb-0 ps-3">
                                                                    fines
                                                                </p>
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
                    @if (!$keranjang->tanggal_pinjam)
                        <button class="btn btn-sm btn-danger">Hapus Masal</button>
                    @endif

                </div>

            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">



            <script>
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
            </script>

        @endsection
