<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingPage</title>
    <link rel="stylesheet" href="{{ asset('assets/css/landingPage.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/futura-font@1.0.0/styles.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="circle">
        <div class="satu"></div>
        <div class="dua"></div>
        <div class="tiga"></div>
    </div>

    <header>
        <img src="{{ asset('assets/user_view/landingpage/Rectangle 58.png') }}" alt="">
    </header>

    <section class="main">
        <div class="logo">
            <img src="{{ asset('assets/user_view/landingpage/buku.png') }}" alt="">
            <img src="{{ asset('assets/user_view/landingpage/bukuNumpuk.png') }}" alt="">
        </div>
        <div class="txtWButton">
            <h1>Make it Easier <br> to Borrow <br> Books</h1>
            <div class="signButton">
                <a href="/signUp" style="text-decoration: none">
                    <button type="submit" class="regis">Get Started</button>
                </a>
                <a href="/signIn" style="text-decoration: none">
                    <button type="submit" class="login">Sign In</button>
                </a>

            </div>
        </div>
    </section>

    <section class="scrollBooks">
        <div class="retangle">
            {{-- <button class="nextAndBack">
                <span class="material-symbols-outlined">arrow_back_ios_new</span>
            </button> --}}
            <div class="listBook">
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample3.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample4.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample5.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample6.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample7.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample8.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
                <div class="dummyBook1">
                    <div class="cover">
                        <img src="{{ asset('assets/user_view/landingpage/folderBook/sample1.png') }}" alt="">
                        <div class="ratingInput">
                            <img src="{{ asset('assets/user_view/landingpage/Star 1.png') }}" alt="">
                            <p id="rating">4.0</p>
                        </div>
                    </div>
                    <p>Laskar Pelangi</p>
                    <p>Andrea Hirata</p>
                </div>
            </div>
            {{-- <button class="nextAndBack">
                <span class="material-symbols-outlined">arrow_forward_ios</span>
            </button> --}}
        </div>
    </section>

    <section class="footer">
        <div class="deskripsi">
            <div class="textWBlock">
                <div class="blockBlue"></div>
                <div class="clear"></div>
                <h1>Get <br> your book <br> online or <br> offline
                </h1>
            </div>
        </div>
        <div class="imgPreview">
            <div class="kiri">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample1.png') }}" alt="">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample2.png') }}" alt="">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample3.png') }}" alt="">
            </div>
            <div class="kanan">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample4.png') }}" alt="">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample7.png') }}" alt="">
                <img src="{{ asset('assets/user_view/landingpage/folderBook/sample8.png') }}" alt="">
            </div>
        </div>
    </section>
</body>

</html>
