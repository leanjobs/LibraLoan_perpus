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
    <form action="">
        <h1>Sign In</h1>
        <p class="descripsiSign">Enter your detail to proceed futher</p>
        <div class="Email">
            <label for="Email">Email</label>
            <div class="inputs">
                <input type="text" name="Email">
                <span class="material-symbols-outlined icon">
                    mail
                </span>
            </div>
        </div>
        <div class="Password">
            <label for="Password">Password</label>
            <div class="inputs">
                <input type="password" name="Password" id="password">
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
        <button>Sign In</button>
        <p class="regis">Didn't have any account? <a href="signUp.html">Sign Up</a></p>
    </form>
    <div class="detail">
        <div class="img1">
            <img src="assets/signinSignup/bukuAndG.png" alt="">
            <img src="assets/signinSignup/bukuNumpuk.png" alt="">
        </div>
        <img src="assets/signinSignup/buku.png" alt="">
    </div>
</body>
<script>
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
