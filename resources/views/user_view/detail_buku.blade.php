@extends('layouts.main_userview')
@section('title', 'LibraLoan')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
    </style>
    {{-- content --}}
    <div class="container-fluid py-4">

        <div class="container-fluid py-4">


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('storage/' . $bukus->image) }}" class="img-fluid border-radius-lg h-auto ">
                </div>
                <div class="col-9">
                    <h2>{{ $bukus->judul }}</h2>
                    <p>{{ $bukus->pengarang }}</p>
                    <p>{{ $bukus->deskripsi }}</p>
                    <p>stok : {{ $bukus->stok }}</p>
                    <p>{{ $bukus->kategori_bukus->nama_kategori }}</p>
                    <p>rating : {{ $bukus->avg_rating }}</p>
                    @if ($saved->isEmpty())
                        <form action="{{ route('save.book', $bukus->id) }}" method="POST">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="save" value="{{ $bukus->id }}">
                            <button type="submit" class="btn btn-danger mx-1">Save</button>
                        </form>
                    @else
                        @foreach ($saved as $item)
                            <button type="submit" class="btn btn-danger mx-1">Saved</button>
                            <form action="{{ route('delete.save', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>

                            </form>
                        @endforeach
                    @endif




                    @php
                        $isFound = false;
                    @endphp
                    @foreach ($keranjang as $peminjaman)
                        @foreach ($detail_peminjaman->where('peminjaman_id', $peminjaman->id) as $item)
                            @if ($item->bukus_id == $bukus->id)
                                @php
                                    $isFound = true;
                                @endphp
                                @if ($peminjaman->status == 1)
                                    <button type="submit" class="btn btn-outline-warning mx-1">waiting</button>
                                @elseif ($peminjaman->status == 2)
                                    <button type="submit" class="btn btn-outline-dark mx-1">approve</button>
                                @endif
                            @break
                        @endif
                    @endforeach
                    @if ($isFound)
                    @break
                @endif
            @endforeach

            @if (!$isFound)
                @if ($bukus->stok > 0)
                    <form action="{{ route('tambah.keranjang', $bukus->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger mx-1">Pinjam</button>
                    </form>
                @else
                    <button type="submit" class="btn btn-danger mx-1">habis</button>
                @endif

            @endif
            <div class="card h-auto">
                <div class="row">
                    <div class="col-6">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h4 class="mb-0">Write a review</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ route('add.rating', $bukus->id) }}" method="POST" name="ratingForm"
                                id="ratingForm">
                                @csrf
                                <input type="hidden" name="bukus_id" value="{{ $bukus->id }}">
                                <div class="rate" aria-required="true">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="form-group">
                                    <label for="" class="mt-3">your review</label>
                                    {{-- <textarea name="review" id="" style="" required style="width: 100%; height: 300px;"></textarea> --}}
                                </div>
                                <div class="form-group">
                                    <textarea name="review" id="" style="" cols="50" rows="10" required></textarea>
                                </div>
                                <div>&nbsp;</div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-light mx-1">kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h4 class="mb-0">Books review</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @foreach ($ratings as $rating)
                                <div>
                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                        <span>&#9733;</span>
                                    @endfor
                                    <p>{{ $rating->review }}</p>
                                    <p>{{ $rating->user->name }}</p>
                                    <p>{{ $rating->created_at }}</p>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </div>

</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 1000);
    });
</script>
@endsection
