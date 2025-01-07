<?php
session_start();
include 'koneksi.php';

$id = $_POST['idNote'];
$idTable = $_SESSION['id'];

$sql = "SELECT * FROM content where id=$id";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query);

$profilPath = $_SESSION['profilPath'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
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
            padding-left: 10rem;
            padding-right: 10rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            padding: 3rem;
            width: 100%;
        }
    }


    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: .1px solid gray;
        padding-left: 1.5rem;
        padding-right: 1rem;
        padding-bottom: 1rem;
    }

    nav h1 {
        font-size: 2.4rem;
        font-weight: 700;
    }

    .right {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    .menulis {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        gap: 0;
    }

    .profil {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        border: solid 1px black;
        margin-right: 1rem;
        cursor: pointer;
    }

    .dropdown-content {
        display: flex;
        flex-direction: column;
        position: absolute;
        width: auto;
        height: auto;
        right: 2rem;
        top: 6rem;
        background-color: white;
        padding-top: .5rem;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-bottom: 1rem;
        box-shadow: 0px 0px 5px #878787;
    }

    #dropdownMenu {
        display: none;
    }

    a {
        text-decoration: none;
        color: #fc4d3d;
        font-weight: 500;
    }

    .add-note {
        color: black;
        border: none;
    }


    .container {
        padding-bottom: 2rem;
    }

    .judul {
        font-size: 3rem;
        font-weight: 700;
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
                <a href="index.php" style="color: black; margin-bottom:1rem;">Beranda</a><br>
                <a href="logout.php">
                    Logout
                    <?php
                    $sqlName = "SELECT nama_user FROM user WHERE id=$idTable";
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
        <div class="container">
            <?php
            foreach ($result as $row) {
            ?>

                <div class="container">
                    <div class="judul"><?= $row[1] ?></div>
                    <div class="penulis"><?= $row[8] ?></div>
                    <div class="waktu"><?= $row[3] ?></div>
                    <div class="isi"><?= htmlspecialchars_decode($row[2]) ?></div>
                </div>

            <?php } ?>
        </div>
    </div>


    <script>
        function menulis() {
            window.location.href = "tambah.php";
        }


        const dropdownMenu = document.getElementById('dropdownMenu');

        window.addEventListener('click', (event) => {
            if (event.target.closest('#dropdownButton')) {
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            } else {
                dropdownMenu.style.display = "none";
            }
        });
    </script>
</body>

</html>