@extends('layouts.main_newuserview')
@section('title', 'Categories')
@section('content')
    {{-- <h1 style="margin-bottom: 15px; font-size: 30px;">Categories</h1> --}}

    <div class="category-container">
        @foreach ($kategoris as $kategori)
            <a href="/kategoriBuku/{{ $kategori->id }}" class="category" style="text-decoration: none; color: black; "
                data-url="{{ url('/kategoriBuku/' . $kategori->id) }}">
                <div>{{ $kategori->nama_kategori }}</div>
            </a>
        @endforeach

    </div>
    <div class="bookList">
        @foreach ($bukus as $buku)
            <div>
                <a href="/detailBuku/{{ $buku->id }}" style="text-decoration: none; color: black">
                    <img class="cover" src="{{ asset('storage/' . $buku->image) }}">
                    <span>
                        <div class="booknameWAuthor">
                            <h1>{{ $buku->judul }}</h1>
                            <p>{{ $buku->pengarang }}</p>
                        </div>
                        <p>rating : {{ $buku->avg_rating }}</p>
                        {{-- <span id="popularity"></span> --}}
                    </span>
                </a>

            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const categories = document.querySelectorAll('.category');
            var currentUrl = window.location.href;


            categories.forEach(function(category) {
                var categoryUrl = category.getAttribute('data-url');
                if (currentUrl === categoryUrl) {
                    category.classList.add('active');
                } else {
                    category.classList.remove('active');
                }
            });
        });
    </script>
@endsection
