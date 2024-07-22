@extends('layouts.main_newuserview')
@section('title', 'Welcome Back !!!')
@section('content')
    {{-- content --}}

    {{-- <h1 style="margin-bottom: 15px;">My Activity</h1> --}}
    <main class="MyActivity">
        <div class="requestBook">
            <div class="goPage">
                <a href="{{ url('/show/keranjang') }}" class="go">Request Book</a>
                <span class="material-symbols-outlined">
                    <a href="{{ url('/show/keranjang') }}" style="font-size: 30px;">east</a>
                </span>
            </div>
            <table>
                <tr>
                    <th class="name">Book Name</th>
                    <th class="action">Action</th>
                </tr>
                @php
                    $rowCount = 0;
                @endphp
                @foreach ($keranjang as $peminjaman)
                    @foreach ($detail_peminjaman->where('peminjaman_id', $peminjaman->id) as $item)
                        <tr>
                            <td class="name">
                                {{ $item->buku->judul }}
                            </td>

                            @if ($peminjaman->status == 1)
                                <td class="action">
                                    waiting
                                </td>
                            @elseif ($peminjaman->status == 2)
                                <td class="action">
                                    approve
                                </td>
                            @elseif ($peminjaman->status == 3)
                                <td class="action">
                                    done
                                </td>
                            @elseif ($peminjaman->status == 4)
                                <td class="action">
                                    fines
                                </td>
                            @elseif ($peminjaman->status == 5)
                                <td class="action">
                                    tolak
                                </td>
                            @endif
                        </tr>
                        @php
                            $rowCount++;
                        @endphp
                    @endforeach
                @endforeach
                @for ($i = $rowCount; $i < 3; $i++)
                    <tr>
                        <td class="name">
                            <!-- Nama buku kosong -->
                        </td>
                        <td class="action">
                            <!-- Status kosong -->
                        </td>
                    </tr>
                @endfor
            </table>
            <p>for offline book</p>
        </div>
        <div class="continueReading">
            <div class="goPage">
                <a href="{{ url('/profile') }}" class="go">Saved</a>
                <span class="material-symbols-outlined">
                    <a href="{{ url('profile') }}" style="font-size: 30px;">east</a>
                </span>
            </div>

            <div class="preview">
                @if ($saved->isEmpty())
                    <div class="noImage"></div>
                @else
                    @foreach ($saved->take(4) as $save)
                        @if (isset($save->bukus->image) && $save->bukus->image)
                            <img src="{{ asset('storage/' . $save->bukus->image) }}" alt="">
                        @endif
                    @endforeach
                @endif


            </div>
            <p>for online book</p>
        </div>
    </main>
    <h1 style="margin: 30px 0;">Categories</h1>
    <main class="kategori">
        @foreach ($kategoris as $kategori)
            <a href="/kategoriBuku/{{ $kategori->id }}" style="text-decoration: none">
                <div style="background-image: url('{{ asset('storage/' . $kategori->image_kategori) }}'); ">
                    <p>{{ $kategori->nama_kategori }}</p>
                </div>
            </a>
        @endforeach


    </main>
    <span style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin:30px 0; font-size: 25px;">Popular</h1>
        <a href="/popular" style="text-decoration: none; color: black;">
            <span style="display: flex; align-items: center; gap: 6px;">
                <h4>More</h4>
                <span style="font-size: 20px;" class="material-symbols-outlined">
                    east
                </span>
            </span>
        </a>

    </span>
    <main class="popular">
        @foreach ($bukus as $buku)
            <div class="book">
                <a href="/detailBuku/{{ $buku->id }}" class>
                    <img class="cover" src="{{ asset('storage/' . $buku->image) }}">
                    {{-- <div class="ratingInput">
                        <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                        <p id="rating">4.0</p>
                    </div> --}}
                </a>
                <span>
                    <div class="booknameWAuthor">
                        <h1>{{ $buku->judul }}</h1>
                        <p>{{ $buku->pengarang }}</p>
                        <p>rating : {{ $buku->avg_rating }}</p>
                    </div>
                </span>

            </div>
        @endforeach


    </main>


@endsection
