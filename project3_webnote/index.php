<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: loginPage/login.php");
}

include 'koneksi.php';
$id = $_SESSION['id'];
$sql = "SELECT * FROM content where public = TRUE and delete_at is null";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query);

$sqlProfil = "SELECT id,profil FROM user";
$queryProfil = mysqli_query($conn, $sqlProfil);
$resultProfil = mysqli_fetch_all($queryProfil);

function profil($id, $resultProfil)
{
    foreach ($resultProfil as $rowProfil) {
        if ($id == $rowProfil[0]) {
            $profil = $rowProfil[1];
            return $profil;
        }
    }
    return false;
}

if (profil($id, $resultProfil) == '') {
    $profilPath = 'assets/profil.png';
} else {
    $profilPath = "upload/" . profil($id, $resultProfil);
}
$_SESSION['profilPath'] = $profilPath;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RA POS</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-color: #f7f4ed;
    }

    @media screen and (min-width: 500px) {
        .contentt {
            margin-top: 7rem;
            margin-left: 5rem;
            margin-right: 5rem;
            border-bottom: solid 1px #dbdbdb;
        }
    }

    nav {
        display: flex;
        position: fixed;
        justify-content: space-between;
        align-items: center;
        border-bottom: .1px solid gray;
        padding: 1rem;
        width: 100%;
        background-color: #f7f4ed;
        z-index: 99;
        top: 0;
    }

    .right {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
    }

    .menulis {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        gap: 0;
    }

    .profil {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        border: solid 1px black;
        cursor: pointer;
    }

    .dropdown-content {
        display: flex;
        flex-direction: column;
        position: absolute;
        width: auto;
        height: auto;
        right: 1rem;
        top: 4rem;
        background-color: white;
        padding-top: .5rem;
        padding-left: 1rem;
        padding-right: 10rem;
        padding-bottom: 1rem;
        align-items: start;
        box-shadow: 0px 0px 5px #878787;
    }

    #dropdownMenu {
        display: none;
    }

    .dropdown-content a {
        text-decoration: none;
        color: #fc4d3d;
        font-weight: 500;
    }

    .flex-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .add-note {
        color: black;
        border: none;
        font-weight: 500;
        text-decoration: none;
    }

    .container {
        color: black;
        padding: .5rem;
        margin-top: 4rem;
        margin-left: 1rem;
        margin-right: 1rem;
    }

    .container-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        margin-right: 1rem;
        gap: 1rem;
    }

    .judul {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .edit,
    .delete {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: .5rem;
    }

    .penulis {
        letter-spacing: .05rem;
        font-size: .8rem;
    }

    .waktu {
        letter-spacing: .05rem;
        font-size: .8rem;
        position: relative;
        display: flex;
        flex-direction: column;
        width: 50%;
    }


    .controls {
        background-color: blue;
        width: auto;
        height: auto;
    }
</style>

<body>
    <nav>
        <h1>Finote</h1>
        <div class="right">
            <div class="menulis">
                <span class="material-symbols-outlined" onclick="menulis()">
                    add
                </span>
                <a href="tambah.php" class="add-note">Menulis</a>
            </div>
            <img src="<?= $profilPath ?>" alt="" class="profil" id="dropdownButton">
            <div class="dropdown-content" id="dropdownMenu">
                <a href="index.php" style="color:black;">Home</a>
                <br>
                <a href="stories/private.php" style="color:black;">
                    Stories
                </a>
                <br>
                <a href="logout.php">
                    Logout
                    <?php
                    $sqlName = "SELECT nama_user FROM user WHERE id=$id";
                    $queryName = mysqli_query($conn, $sqlName);
                    $resultName = mysqli_fetch_all($queryName);

                    foreach ($resultName as $resultNameRow) {
                        $nama_user = $resultNameRow[0];
                    }
                    echo "<span style='" . "color:black;" . "'>$nama_user</span>";
                    ?>
                </a>
            </div>
        </div>

    </nav>

    <div class="contentt">
        <?php foreach ($result as $row) { ?>
            <form action="content.php" method="POST" onclick="this.submit();">
                <input type="hidden" name="idNote" value="<?= $row[0] ?>">
                <div class="container" style="cursor: pointer;">
                    <div class="container-header">
                        <div class="container-sub-header">
                            <div class="flex-header">
                                <div class="judul"><?= $row[1] ?></div>
                            </div>
                            <div class="deskripsi"><?= $row[6] ?></div>
                        </div>

                        <?php
                        if ($row[5] === 'image') {
                            echo "<img src='" . $row[7] . $row[4] . "' width='100rem' height='100rem' style='object-fit: cover; margin:.5rem;'>";
                        }
                        ?>
                    </div>

                    <div class="penulis"><?= $row[8] ?></div>
                    <div class="waktu"><?= $row[3] ?></div>
                </div>
            </form>

        <?php }; ?>
    </div>

    <script>
        function menulis() {
            window.location.href = "tambah.php";
        }


        // Seleksi semua elemen dengan class 'delete'
        const deleteButtons = document.querySelectorAll('.delete');

        console.log(deleteButtons)

        // Tambahkan event listener untuk setiap tombol delete
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                Swal.fire({
                    title: 'Yakin menghapus data ini?',
                    text: 'Data akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#fc4d3d',
                    cancelButtonColor: '#3db5ff',
                    confirmButtonText: 'Ya, hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data anda berhasil dihapus',
                            icon: 'success',
                            confirmButtonColor: '#fc4d3d',
                        }).then(() => {
                            // Cari elemen form terdekat dan submit
                            button.closest('form').submit();
                        });
                    } else {
                        window.location.href = 'index.php';
                    }
                });
            });
        });





        const dropdownMenu = document.getElementById('dropdownMenu');

        window.addEventListener('click', (event) => {
            if (event.target.closest('#dropdownButton')) {
                console.log("klik")
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            } else {
                dropdownMenu.style.display = "none";
            }
        });
    </script>
</body>

</html>