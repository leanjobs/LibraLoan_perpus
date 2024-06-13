@extends('layouts.main_newuserview')
@section('title', 'LibraLoan')
@section('content')

    {{-- content --}}

    <h1 style="margin: 15px 15px 15px 0; font-size: 30px;">Profile</h1>
    <div class="profileDetail">
        <div class="imgProf">
            <img src="{{ asset('assets/user_view/homepage/profile.png') }}" alt="profilePic" class="profilePic">
            {{-- <button>
                <img src="{{ asset('assets/user_view/profile/nav-icon/Home_fill.svg') }}" alt="">
            </button> --}}
        </div>
        <form action="{{ route('update.profile', ['id' => auth()->user()->id]) }}" method="post" class="kotak">
            @csrf
            @method('PUT')
            <span class="userInput">
                <label for="name">username</label>
                <input id="name" name="name" type="text" placeholder="dds" value='{{ auth()->user()->name }}'
                    autocomplete="off">

            </span>
            <span class="emailInput">
                <label for="email">email</label>
                <input id="email" name="email" type="email" value='{{ auth()->user()->email }}'
                    placeholder="isi email" autocomplete="off">

            </span>
            <span class="passInput">
                <label for="password">password</label>
                <input id="password" name="password" type="password" placeholder="*******" autocomplete="off"
                    value='{{ auth()->user()->password }}'>

            </span>
            <button type="submit" class="button">save</button>
        </form>
    </div>

    <h1 style="margin: 80px 15px 15px 0;">Saved Books</h1>

    <div class="saveBooks">

        <div class="bookList">
            @foreach ($saved as $item)
                <div>
                    <img src="{{ asset('storage/' . $item->bukus->image) }}" alt="">
                    <p style="font-size: 15px;">{{ $item->bukus->judul }}</p>
                    <p style="font-size: 14px;">{{ $item->bukus->pengarang }}</p>
                    <p style="font-size: 14px;">rating : {{ $item->bukus->avg_rating }}</p>

                </div>
            @endforeach

        </div>

    @endsection
