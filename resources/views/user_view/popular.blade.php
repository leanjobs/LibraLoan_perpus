@extends('layouts.main_newuserview')
@section('title', 'Popular')
@section('content')
    {{-- <h1 style="margin-bottom: 15px; font-size: 30px;">Popular</h1> --}}

    <div class="bookList">
        @foreach ($bukus as $buku)
            <div>
                <img class="cover" src="{{ asset('storage/' . $buku->image) }}">
                <span>
                    <div class="booknameWAuthor">
                        <h1>{{ $buku->judul }}</h1>
                        <p>{{ $buku->pengarang }}</p>
                    </div>
                    <p>rating : {{ $buku->avg_rating }}</p>
                    {{-- <span id="popularity"></span> --}}
                </span>
            </div>
        @endforeach


    </div>
@endsection
