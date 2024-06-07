@extends('layouts.main_userview')
@section('title', 'LibraLoan')
@section('content')
    {{-- content --}}
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <div class="row">
                @foreach ($bukus as $buku)
                    <div class="col-2">
                        <div class="card">
                            <a href="/detailBuku/{{ $buku->id }}">
                                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                    <img src="{{ asset('storage/' . $buku->image) }}" class="img-fluid border-radius-lg">
                                </div>
                                <div class="card-body pt-2">
                                    <span
                                        class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{ $buku->pengarang }}</span>
                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                        {{ $buku->judul }}
                                    </a>
                                    <p>{{ $buku->avg_rating }}</p>
                                    {{-- @foreach ($bukus as $item)
                                        @foreach ($item->rating as $rating)
                                            @if ($rating->bukus_id == $buku->id)
                                                @php
                                                    $averageRating = $item->rating->avg('rating');
                                                @endphp
                                                <p>{{ $averageRating }}</p>
                                            @endif
                                        @endforeach
                                    @endforeach --}}

                                    {{-- <p class="card-description mb-4">
                                        {{ $buku->deskripsi }}
                                    </p> --}}
                                </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection
