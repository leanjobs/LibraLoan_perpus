<header>
    <div class="search">
        <span class="material-symbols-outlined">
            search
        </span>
        <input type="text" class="search" placeholder="Search">
    </div>
    <div class="profile">
        <img src="{{ asset('assets/user_view/homepage/profilePic.png') }}" alt="">
        <span class="userDescripsi">
            <p class="username">{{ auth()->user()->name }}</p>
            <p class="gmail">{{ auth()->user()->email }}</p>
        </span>
    </div>
</header>
