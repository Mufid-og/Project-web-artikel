<?php
session_start();
if (isset($_SESSION['login'])) {
    // Buat form
    echo "<form id='redirectForm' action='index.php' method='post'>";
    // Tambahkan input hidden untuk menyimpan ID
    echo "<input type='hidden' name='id' value='$id'>";
    // Submit form secara otomatis
    echo "</form>";
    echo "<script>document.getElementById('redirectForm').submit();</script>";

    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <nav id="navbar">
        <h1>Finote</h1>
        <div>
            <h1 id="btn-login-nav1">Daftar</h1>
            <button class="btn" id="btn-login-nav2">Mulai menulis</button>
        </div>
    </nav>
    <div class="container" id="container" style="padding: 2.5rem;">
        <h1>Tampung </h1>
        <h1>catatan dan idemu!</h1>
        <p>Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>

    </div>
    <button id="btn-login">Mulai membaca</button>
    <div id="popupMasuk" class="popup-masuk">
        <form action="../masuk.php" method="POST">
            <h2 style="text-align: center;">Masuk</h2>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <p>Belum punya akun? <a href="#popup-daftar" id="linkDaftar">Daftar disini</a></p>
            <div class="flex">
                <button type="submit">Submit</button>
                <a href="login.php">Kembali</a>
            </div>
        </form>
    </div>
    <div id="popupDaftar" class="popup-daftar">
        <form action="../signUp.php" method="POST">
            <h2 style="text-align: center;">Daftar</h2>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <p>Sudah punya akun? <a href="#popupMasuk" id="linkMasuk">Masuk disini</a></p>
            <div class="flex">
                <button type="submit">Submit</button>
                <a href="login.php">Kembali</a>
            </div>
        </form>
    </div>
    <!-- <footer>
        <p>Tentang</p>
        <p>Bantuan</p>
        <p>Ketentuan</p>
        <p>Privasi</p>
    </footer> -->

    <script>
        const navbar = document.getElementById('navbar');
        const container = document.getElementById('container');
        const btnLogin = document.getElementById('btn-login');
        const btnLoginNav1 = document.getElementById('btn-login-nav1');
        const btnLoginNav2 = document.getElementById('btn-login-nav2');
        const popupDaftar = document.getElementById('popupDaftar');
        const popupMasuk = document.getElementById('popupMasuk');
        const linkDaftar = document.getElementById('linkDaftar');
        const linkMasuk = document.getElementById('linkMasuk');

        function button(btn) {
            btn.addEventListener('click', () => {
                popupMasuk.style.display = 'flex'
                container.style.filter = 'blur(5px)'
                navbar.style.filter = 'blur(5px)'
                btnLogin.style.filter = 'blur(5px)'

                linkDaftar.addEventListener('click', () => {
                    popupDaftar.style.display = 'flex'
                    popupMasuk.style.display = 'none'
                });

                linkMasuk.addEventListener('click', () => {
                    popupMasuk.style.display = 'flex'
                    popupDaftar.style.display = 'none'
                });
            });
        }

        button(btnLogin);
        button(btnLoginNav1);
        button(btnLoginNav2);
    </script>
</body>

</html>