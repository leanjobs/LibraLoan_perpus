<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraLoan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/HomePage.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/BookDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/MyActivity.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Popular.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Categories.css') }}">


    {{-- <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" /> --}}


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/futura-font@1.0.0/styles.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <nav class="navAll">
        <div class="logo">
            <img src="{{ asset('assets/user_view/homepage/Rectangle 58.svg') }}" alt="">
        </div>
        <div class="tab-bar">
            <a href="{{ url('/dashboard') }}">
                <div class="homePage">
                    <button class="nowPlace">
                        <img src="{{ asset('assets/user_view/homepage/nav-icon/Home_fill.svg') }}">
                    </button>
                    <span>Homepage</span>
                </div>
            </a>
            <a href="{{ url('/show/keranjang') }}">
                <div class="activityTab">
                    <button>
                        <img src="{{ asset('assets/user_view/homepage/nav-icon/Desk_fill.svg') }}">
                    </button>
                    <span>My Activity</span>
                </div>
            </a>
            <a href="{{ url('/kategoriBuku/1') }}">
                <div class="categories">
                    <button>
                        <img src="{{ asset('assets/user_view/homepage/nav-icon/darhboard.svg') }}">
                    </button>
                    <span>Categories</span>
                </div>
            </a>
            {{-- <a href="{{ url('/popular') }}">
                <div class="activityTab">
                    <button>
                        <img src="{{ asset('assets/user_view/homepage/nav-icon/Favorites_fill.svg') }}">
                    </button>
                    <span>Popular</span>
                </div>
            </a> --}}
            <a href="{{ url('/search') }}">
                <div class="activityTab">
                    <button>
                        <img src="{{ asset('assets/user_view/homepage/nav-icon/Search.svg') }}">
                    </button>
                    <span>Search</span>
                </div>
            </a>

        </div>
        <a href="{{ url('/logout') }}">
            <div class="logout-tab">
                <button>
                    <img src="{{ asset('assets/user_view/homepage/nav-icon/Sign_out_squre_fill.svg') }}">
                </button>
            </div>
        </a>


    </nav>
    <section class="container">
        <header>
            {{-- <form action="/search" method="GET">
                <div class="search">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input type="text" class="search" placeholder="Search" name="search">
                </div>
            </form> --}}

            <div class="search">
                <h1 style="font-size: 40px">@yield('title')</h1>
                {{-- <span class="material-symbols-outlined">
                    search
                </span>
                <input type="text" class="search" placeholder="Search"> --}}
            </div>
            <a href="{{ url('/profile') }}" class="profile" style="text-decoration: none; color: black">
                @if (auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}"alt="profilePic">
                @else
                    <img src="{{ asset('assets/user_view/homepage/profile.png') }}" alt="profilePic">
                @endif
                <span class="userDescripsi">
                    <p class="username">{{ auth()->user()->name }}</p>
                    <p class="gmail">{{ auth()->user()->email }}</p>
                </span>
            </a>
        </header>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="background-color: #d4edda; color: #155724; padding: 10px;">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="background-color: #f8d7da; color: #721c24; padding: 10px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </section>
</body>

<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 1000);
    });

    imageUpload.onchange = evt => {
        const [file] = imageUpload.files
        if (file) {
            profileView.src = URL.createObjectURL(file)
        }
    }
</script>

</html>
