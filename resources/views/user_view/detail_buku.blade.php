@extends('layouts.main_newuserview')
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
    </style>
    {{-- content --}}

    <section class="bookDetail">
        <aside class="book">
            <img src="{{ asset('storage/' . $bukus->image) }}" alt="">
            <div class="stokWSave">
                <p>Stok : <total id="total">{{ $bukus->stok }}</total>
                </p>
                <!-- <span class="material-symbols-rounded" id="bookmark-icon">                                                                                                                                                                                </span> -->
            </div>
            <div class="button">
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
                                <button type="submit" class="req" id="req">waiting</button>
                            @elseif ($peminjaman->status == 2)
                                <button type="submit" class="req" id="req">approve</button>
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
                {{-- <form action="{{ route('tambah.keranjang', $bukus->id) }}" method="POST" class="button">
                    @csrf
                    @method('POST')
                    <button type="submit" class="req" id="req" style="cursor: pointer;">Pinjam</button>
                </form> --}}
                <button  class="req" id="req" style="cursor: pointer;">Pinjam</button>
            @else
                <button type="submit" class="req" id="req" style="cursor: pointer;">habis</button>
            @endif

        @endif
        @if ($saved->isEmpty())
            <form action="{{ route('save.book', $bukus->id) }}" method="POST" class="button">
                @csrf
                @method('POST')

                <input type="hidden" name="save" value="{{ $bukus->id }}">
                <button type="submit" class="read" style="cursor: pointer;">Save</button>
            </form>
        @else
            @foreach ($saved as $item)
                {{-- <button type="submit"class="read">Saved</button> --}}
                <form action="{{ route('delete.save', $item->id) }}" method="POST" class="button">
                    @csrf
                    @method('DELETE')
                    <button type="submit"class="read" style="cursor: pointer;">Delete Saved</button>

                </form>
            @endforeach
        @endif
        {{-- <button class="req" id="req">Request Book</button>
        <button class="read">Read Now</button> --}}
    </div>
</aside>
<main class="detail">
    <h1 class="bookName">{{ $bukus->judul }}</h1>
    <h3 class="bookAuthor">{{ $bukus->pengarang }}</h3>
    <p class="sinopsis">{{ $bukus->deskripsi }}</p>
    <div class="rateWPage">
        <span class="stars">
            @for ($i = 1; $i <= $bukus->avg_rating; $i++)
                <span style="padding: 5%; font-size: 20px">&#9733;</span>
            @endfor


            <p class="manyRating" style="margin-left: 20% ">({{ $bukus->avg_rating }}/5)</p>

        </span>

    </div>
    <div class="genreView">
        <button>{{ $bukus->kategori_bukus->nama_kategori }}</button>

    </div>
    <div class="commentView">
        <div class="kiri">
            <h3>Write Comment</h3>
            <div class="writeComment">
                <form action="{{ route('add.rating', $bukus->id) }}" method="POST" name="ratingForm"
                    id="ratingFomr">
                    @csrf
                    <input type="hidden" name="bukus_id" value="{{ $bukus->id }}">
                    <span class="ratingComment">
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
                        <p class="rate" style="margin-left: 10px;">Your Review</p>
                    </span>
                    <textarea name="review" id="textArea" cols="50" rows="10" class="area"></textarea>
                    <div class="tombol">
                        {{-- <button class="submitComment" id="clear">Clear</button> --}}
                        <button class="submitComment" type="submit">Kirim</button>
                    </div>
                </form>


            </div>
        </div>
        <div class="kanan">
            <h3>Comment</h3>
            @foreach ($ratings as $rating)
                <div class="comment">
                    <div class="prof">
                        <img src="{{ asset('assets/user_view/bookdetail/profilePic.png') }}" alt="profilePic">
                    </div>
                    <article>
                        <p class="username">{{ $rating->user->name }}</p>
                        <span class="ratingComment">
                            @for ($i = 1; $i <= $rating->rating; $i++)
                                <span style="padding: 3%">&#9733;</span>
                            @endfor
                            <p class="manyRating" style="margin-left: 5% ">({{ $rating->rating }}/5)</p>

                        </span>
                        <p>{{ $rating->review }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</main>
</section>
<div class="klik" id="klik">
    <main>
        <h2>Request Book</h2>
        <div class="bookDet">
            <h3>Book Detail</h3>
            <span class="bookName">
                <p>Book name</p>
                <p>{{$bukus->judul}}</p>
            </span>
            <span class="author">
                <p>Author</p>
                <p>{{$bukus->pengarang}}</p>
            </span>
            <span class="totalPages">
                <p>Request Date</p>
                <p>{{  \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y, HH:mm:ss') }}</p>
            </span>
        </div>
        <div class="termNCon">
            <div class="head">
                <span class="material-symbols-outlined">
                    info
                </span>
                <h>Term & Condition</h>
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dolor rem laborum doloribus
                similique asperiores.
            </p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam, blanditiis.</p>
            <span class="check">
                <input type="checkbox" id="termsCheckbox">
                <label for="termsCheckbox">Accepted</label>
            </span>
        </div>
        <span class="submit">
             <form action="{{ route('tambah.keranjang', $bukus->id) }}" method="POST" class="button">
                    @csrf
                    @method('POST')
                    <button type="submit" id="submitRequest"  disabled style="cursor: pointer;">Pinjam</button>
                </form>
            {{-- <button id="submitRequest" disabled>Requestdddd</button> --}}
        </span>
    </main>
</div>
</div>
</div>
<script>
    // document.getElementById('bookmark-icon').addEventListener('click', function () {
    //     this.classList.toggle('marked');
    // });

    document.addEventListener('DOMContentLoaded', (event) => {
        const modal = document.getElementById("klik");
        const btn = document.getElementById("req");
        const checkbox = document.getElementById("termsCheckbox");
        const submitButton = document.getElementById("submitRequest");


        // Open the modal
        btn.onclick = function () {
            modal.style.display = "flex";
        }

        submitButton.onclick = function () {
            modal.style.display = "none";
        }

        // Close the modal when clicking outside of it
        modal.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // // Enable or disable the submit button based on checkbox state
        checkbox.addEventListener('change', function () {
            submitButton.disabled = !this.checked;
        });
    });
</script>

@endsection
