<?php
session_start();

include 'koneksi.php';
$sql = 'SELECT id FROM user';
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query);

foreach ($result as $row) {
    $id = $row[0];
}
$_SESSION['id'] = $id + 1;



$username = $_POST['username'];
$pass = $_POST['pass'];

$sqlUsername = "SELECT username FROM user";
$queryUsername = mysqli_query($conn, $sqlUsername);
$resultUsername = mysqli_fetch_all($queryUsername);

function cekUsername($username, $resultUsername)
{
    foreach ($resultUsername as $rowUsername) {
        if ($username == $rowUsername[0]) {
            return true;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginPage/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<style>
    .circle {
        width: 100px;
        height: 100px;
        background-size: 6.2rem 6.2rem;
        background-repeat: no-repeat;
        border-radius: 50%;
        cursor: pointer;
        text-align: center;
        background-image: url('assets/profil.png');
        border: solid 1px black;
    }

    #profil {
        background-color: transparent;
        border: none;
    }

    form {
        display: flex;
        align-items: center;
    }

    .strecth {
        width: 100%;
    }

    .strecth input {
        width: 100%;
    }
</style>

<body>
    <?php
    if ($username == '' || $pass == '') {
        echo "
            <script>
                Swal.fire({
                    title: 'Maaf!',
                    text: 'Username dan password tidak boleh kosong',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fc4d3d',
                    customClass: {
                        title: 'my-title-class',
                        content: 'my-content-class',
                        confirmButton: 'my-confirm-button-class'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'loginPage/login.php';
                    }
                });
            </script>";
    } else if (strlen($pass) < 8) {
        echo "
            <script>
                Swal.fire({
                    title: 'Maaf!',
                    text: 'Password minimal 8 karakter',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fc4d3d',
                    customClass: {
                        title: 'my-title-class',
                        content: 'my-content-class',
                        confirmButton: 'my-confirm-button-class'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'loginPage/login.php';
                    }
                });
            </script>";
    }


    if (cekUsername($username, $resultUsername)) {
        echo "
                <script>
                    Swal.fire({
                        title: 'Maaf!',
                        text: 'Username yang anda masukan sudah digunakan',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#fc4d3d',
                        customClass: {
                            title: 'my-title-class',
                            content: 'my-content-class',
                            confirmButton: 'my-confirm-button-class'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'loginPage/login.php';
                        }
                    });
                </script>";
    }
    ?>


    <nav id="navbar" style="filter: blur(5px);">
        <h1>Finote</h1>
        <div>
            <h1>Daftar</h1>
            <button class="btn">Mulai menulis</button>
        </div>
    </nav>
    <div class="container" id="container" style="padding: 2.5rem; filter: blur(5px);">
        <h1>Tampung </h1>
        <h1>catatan dan idemu!</h1>
        <p>Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>

    </div>
    <button id="btn-login" style="filter: blur(5px);">Mulai membaca</button>
    <div id="popupDaftar" class="popup-daftar" style="display: flex;">
        <form action="daftar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id + 1 ?>">
            <input type="hidden" name="username" value="<?= $username ?>">
            <input type="hidden" name="password" value="<?= $pass ?>">
            <h2 style="text-align: center;">Masukan nama dan profil</h2>
            <label for="file-upload" class="circle" id="labels"></label>
            <input id="file-upload" type="file" name="profil" style="display: none;">
            <div class="strecth">
                <input type="text" name="nama" placeholder="nama">
            </div>
            <div class="flex">
                <button type="submit">Submit</button>
                <a href="loginPage/login.php#popup-daftar">Kembali</a>
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
        const input = document.getElementById('file-upload')
        const label = document.getElementById('labels')

        input.addEventListener('change', () => {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                label.style.backgroundImage = "url('" + e.target.result + "')";
            };

            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>