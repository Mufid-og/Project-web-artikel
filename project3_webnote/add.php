<?php

use function PHPSTORM_META\type;

session_start();

include 'koneksi.php';

$id = $_SESSION['id'];

$judul = htmlspecialchars($_POST['judul']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$penulis = htmlspecialchars($_POST['penulis']);
$publish = $_POST['publish'];
$isi = htmlspecialchars($_POST['isi']);

$fileName = uniqid() . $_FILES['file']['name'];
$file = $_FILES['file']['tmp_name'];

$file_type = pathinfo($fileName, PATHINFO_EXTENSION);
$tipe = (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) ? 'image' : 'video';

$directory = 'upload/';
move_uploaded_file($file, $directory . $fileName);

if (isset($fileName) && isset($file)) {
    $sql = "INSERT INTO content(`judul`,`deskripsi`,`isi`,`waktu`,`file`,`tipe`,`directory`,`penulis`, `user_id`, `public`) values('$judul', '$deskripsi','$isi', NOW(), '$fileName', '$tipe','$directory','$penulis', '$id', $publish)";
} else {
    $sql = "INSERT INTO content(`judul`,`deskripsi`,`isi`,`waktu`,`penulis`, `user_id`, `public`) values('$judul', '$deskripsi','$isi', NOW(),'$penulis', '$id', $publish)";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<style>
    .my-confirm-button-class {
        background-color: #fc4d3d;
    }
</style>

<body>
    <?php
    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil ditambah.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'my-title-class',
                    content: 'my-content-class',
                    confirmButton: 'my-confirm-button-class'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'stories/private.php';
                }
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Data tidak dapat dihapus.',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>";
    }
    ?>
</body>

</html>