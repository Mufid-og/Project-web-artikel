<?php
session_start();
include '../../../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: loginPage/login.php");
}


$id = $_POST['aidi'];


// mengambil content dari database
$sql = "SELECT * FROM content where id = $id";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query);

foreach ($result as $row) {
    $judul = $row[1];
    $deskripsi = $row[6];
    $penulis = $row[8];
    $isi = $row[2];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit catatan</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
</head>

<style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 100%;
    }

    form .judul {
        width: 70%;
    }

    .container-isi {
        width: 70%;
        height: 50vh;
    }

    .container-isi input {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }

    .align-left {
        text-align: left;
        min-width: 70%;
    }

    .flex {
        display: flex;
        gap: 1em;
        margin: 1em;
    }

    .button {
        position: absolute;
        right: 7rem;
        bottom: 0;
        text-decoration: none;
        color: white;
        background-color: #fc4d3d;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: .5rem;
    }

    .align-left-tambah{
        display: flex;
        justify-content: space-between;
        margin: 0;
        min-width: 70%;
        align-items: center;
    }
    .flex {
        display: flex;
        gap: 1em;
        margin: 1em;
    }

    .tambah {
        position: relative;
        background-color: #3db5ff;
        border: none;
        padding: .5rem;
        color: white;
    }

    .switch {
        --circle-dim: 1.4em;
        font-size: 10px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
        margin-top: 1.5rem;
        margin-left: 1.5rem;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fc4d3d;
        transition: .4s;
        border-radius: 30px;
    }

    .slider-card {
        position: absolute;
        content: "";
        height: var(--circle-dim);
        width: var(--circle-dim);
        border-radius: 20px;
        left: 0.3em;
        bottom: 0.3em;
        transition: .4s;
        pointer-events: none;
    }

    .slider-card-face {
        position: absolute;
        inset: 0;
        backface-visibility: hidden;
        perspective: 1000px;
        border-radius: 50%;
        transition: .4s transform;
    }

    .slider-card-front {
        background-color: white;
    }

    .slider-card-back {
        background-color: white;
        transform: rotateY(180deg);
    }

    input:checked~.slider-card .slider-card-back {
        transform: rotateY(0);
    }

    input:checked~.slider-card .slider-card-front {
        transform: rotateY(-180deg);
    }

    input:checked~.slider-card {
        transform: translateX(1.5em);
    }

    input:checked~.slider {
        background-color: #3db5ff;
    }

    .choseFile {
        margin-top: 2rem;
        color: #fc4d3d;
    }
</style>

<body>
    <h1 style="text-align: center;">Finote</h1>

    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="aidi" value="<?= $id ?>">
        <div class="align-left">
            <h3>Judul:</h3>
        </div>
        <textarea name="judul" class="judul"><?= $judul ?></textarea>
        <div class="align-left">
            <h3>Deskripsi</h3>
        </div>
        <textarea name="deskripsi" class="judul"><?= $deskripsi ?></textarea>
        <div class="align-left">
            <h3>Penulis:</h3>
        </div>
        <textarea name="penulis" class="judul"><?= $penulis ?></textarea>
        <div class="align-left" style="display:flex;flex-direction: row; align-items:center;">
            <h3>Publish:</h3>
            <label class="switch">
                <input type="hidden" name="publish" value="FALSE">
                <input type="checkbox" name="publish" value="TRUE">
                <div class="slider"></div>
                <div class="slider-card">
                    <div class="slider-card-face slider-card-front"></div>
                    <div class="slider-card-face slider-card-back"></div>
                </div>
            </label>
        </div>
        <div class="align-left">
            <p class="choseFile">Silahkan pilih gambar kembali</p>
            <input type="file" name="namaFile" accept="image/*">
        </div>
        <div class="align-left-tambah">
            <h3>Isi:</h3>
            <div class="flex">
                <button type="submit" class="tambah">Edit</button>
            </div>
        </div>
        <div class="container-isi">
            <textarea name="isi" id="summernote"><?= $isi ?></textarea>
        </div>
    </form>


    <script>
        // start summernote
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
</body>

</html>