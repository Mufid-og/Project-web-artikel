<?php
session_start();
include '../../koneksi.php';


$username = $_POST['username'];
$pass = $_POST['pass'];


$sqlLogin = "SELECT id, username, password FROM user";
$sqlSignUp = "INSERT INTO user(username, password) values('$username', '$pass')";
$queryLogin = mysqli_query($conn, $sqlLogin);
$resultLogin = mysqli_fetch_all($queryLogin);


// mengecek username dan password yang dimasukan user
function login($username, $pass, $resultLogin)
{
    foreach ($resultLogin as $rowLogin) {
        if ($username == $rowLogin[1] && password_verify($pass, $rowLogin[2])) {
            $id = $rowLogin[0];
            return $id;
        }
    }
    return false;
}


// mengambil id user
$id = login($username, $pass, $resultLogin);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../loginPage/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>

<body>

    <?php
    if (!login($username, $pass, $resultLogin)) {
        echo "
            <script>
                Swal.fire({
                    title: 'Maaf!',
                    text: 'Akun tidak ditemukan, cek username dan password mu lagi',
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
                        window.location.href = '../loginPage/login.php';
                    }
                });
            </script>";
    } else {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $id;
        header("location: ../../index.php");
    }
    ?>

    <nav id="navbar" style="filter:blur(5px)">
        <h1>Finote</h1>
        <div>
            <h1>Daftar</h1>
            <button class="btn">Mulai menulis</button>
        </div>
    </nav>
    <div class="container" id="container" style="padding: 2.5rem; filter:blur(5px)">
        <h1>Tampung </h1>
        <h1>catatan dan idemu!</h1>
        <p>Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>

    </div>
    <button id="btn-login" style="filter:blur(5px)">Mulai membaca</button>
</body>

</html>