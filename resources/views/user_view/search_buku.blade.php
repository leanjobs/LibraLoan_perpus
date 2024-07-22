@extends('layouts.main_newuserview')
@section('title', 'Search')
@section('content')
    {{-- <h1 style="margin-bottom: 15px; font-size: 30px;">Popular</h1> --}}

    <form action="/search" method="GET" style="margin-bottom:  20px">
        <div class="search">
            <span class="material-symbols-outlined">
                search
            </span>
            <input type="text" class="search" placeholder="Search" name="search" value="{{ old('search', $search) }}">
        </div>
    </form>
    <div class="bookList" style="margin-left:  15px">
        @foreach ($result as $buku)
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
