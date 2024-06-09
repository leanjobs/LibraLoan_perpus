<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="{{ asset('assets/css/signinSignup.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/futura-font@1.0.0/styles.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
</head>

<body>
    <form action="{{ route('login_user') }}" method="POST">
        @csrf

        <h1>Sign In</h1>
        <p class="descripsiSign">Enter your detail to proceed futher</p>
        @if (session('success'))
            <div class="alert " role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert" role="alert" style="color: red">
                {{ session('error') }}
            </div>
        @endif
        <div class="Email">
            <label for="Email">Email</label>
            <div class="inputs">
                <input type="text" name="email" autocomplete="off">
                <span class="material-symbols-outlined icon">
                    mail
                </span>
            </div>
        </div>
        <div class="Password">
            <label for="Password">Password</label>
            <div class="inputs">
                <input type="password" name="password" id="password" autocomplete="off">
                <span class="material-symbols-outlined icon">
                    lock
                </span>
                <div class="passwordIcon">
                    <span class="material-symbols-outlined" id="on" onclick="toggleVisibility()">
                        visibility
                    </span>
                    <span class="material-symbols-outlined" id="off" onclick="toggleVisibility()">
                        visibility_off
                    </span>
                </div>
            </div>
        </div>
        </div>
        <button type="submit">Sign In</button>
        <p class="regis">Didn't have any account? <a href="/signUp">Sign Up</a></p>
    </form>
    <div class="detail">
        <div class="img1">
            <img src="{{ asset('assets/user_view/signinSignup/bukuAndG.png') }}" alt="">
            <img src="{{ asset('assets/user_view/signinSignup/bukuNumpuk.png') }}" alt="">
        </div>
        <img src="{{ asset('assets/user_view/signinSignup/buku.png') }}" alt="">
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 1000);
    });

    const icons = document.querySelectorAll('.icon');

    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.nextElementSibling.classList.add(
                'hide-icon'); // Sembunyikan ikon setelah input yang sedang difokuskan
            input.nextElementSibling.firstElementChild.classList.remove(
                'hide-icon'); // Tampilkan ikon jika input kosong
        });
        input.addEventListener('blur', () => {
            if (input.value.trim() === '') {
                input.nextElementSibling.classList.remove(
                    'hide-icon'); // Tampilkan ikon jika input kosong
                input.nextElementSibling.firstElementChild.classList.remove(
                    'hide-icon'); // Tampilkan ikon jika input kosong
            } else {
                input.nextElementSibling.classList.add(
                    'hide-icon'); // Sembunyikan ikon jika input tidak kosong
                input.nextElementSibling.firstElementChild.classList.remove(
                    'hide-icon'); // Tampilkan ikon jika input kosong
            }
        });
    });

    function toggleVisibility() {
        const onElement = document.getElementById('on');
        const offElement = document.getElementById('off');
        const inputElement = document.getElementById('password');

        if (onElement.style.display === 'none') {
            onElement.style.display = 'inline';
            offElement.style.display = 'none';
            inputElement.type = 'password';
        } else {
            onElement.style.display = 'none';
            offElement.style.display = 'inline';
            inputElement.type = 'text';
        }
    }
</script>

</html>
