@extends('layouts.main_userview')
@section('title', 'LibraLoan')
@section('content')

    {{-- content --}}
    <div class="container-fluid py-4">

        <div class="container-fluid py-4">

            <div id="message" class="alert " style="display:none;"></div>
            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('storage/' . $bukus->image) }}" class="img-fluid border-radius-lg h-auto ">
                </div>
                <div class="col-9">
                    <h2>{{ $bukus->judul }}</h2>
                    <p>{{ $bukus->pengarang }}</p>
                    <p>{{ $bukus->deskripsi }}</p>
                    <p>{{ $bukus->kategori_bukus->nama_kategori }}</p>

                    {{-- <a href="/keranjang/{{ $bukus->id }}" class="btn btn-warning">
                        keranjang </a> --}}

                    {{-- <button class="btn btn-warning" type="button" onclick='addCart({{ $bukus->id }})'>keranjang</button> --}}

                    <button id="keranjang-button" data-id="{{ $bukus->id }}" class="btn btn-success">Keranjang</button>

                </div>

            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#keranjang-button').on('click', function() {
                var bukuId = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: '/keranjang/' + bukuId,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Display a success message
                        //$('#sukses').show().delay(3000).fadeOut();
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
