<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('title')</li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><a href="/dashboard">@yield('title')</a></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div> --}}
                <a class="btn bg-gradient-primary mt-0 w-100" href="{{ route('logout') }}">Log Out</a>
            </div>
            <ul class="navbar-nav  justify-content-end">
                {{-- @if (auth()->user()->count > 0)

                @endif --}}
                <li class="nav-item d-flex align-items-center">
                    <a href="/show/keranjang" class="nav-link">My activity
                        {{-- <span class="badge text-bg-warning">{{ dd(auth()->user()->detail_peminjaman()) }}</span> --}}
                    </a>
                    <a href="/show/saved" class="nav-link">Saved
                        {{-- <span class="badge text-bg-warning">{{ dd(auth()->user()->detail_peminjaman()) }}</span> --}}
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <i class="fa fa-user fa-2x me-sm-1"></i>
                    <div class="nav-link text-body  d-flex flex-column">
                        <span class="ms-1 font-weight-bold">{{ auth()->user()->name }}</span>
                        <span class="ms-1 pt-0">{{ auth()->user()->email }}</span>
                    </div>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
