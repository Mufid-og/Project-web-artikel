<?php
session_start();
include '../../../koneksi.php';


$id = htmlspecialchars($_POST['aidi']);
$judul = htmlspecialchars($_POST['judul']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$penulis = htmlspecialchars($_POST['penulis']);
$publish = $_POST['publish'];
$isi = htmlspecialchars($_POST['isi']);
$file = $_FILES['namaFile']['tmp_name'];
$directory = 'upload/';


// membuat nama file unik
$fileName = uniqid().$_FILES['namaFile']['name'];

// mengecek tipe file
$file_type = pathinfo($fileName, PATHINFO_EXTENSION);
$tipe = (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) ? 'image' : 'video';


move_uploaded_file($file,"../../".$directory.$fileName);


$sql = "UPDATE content SET judul = '$judul', isi = '$isi', waktu = now(), deskripsi = '$deskripsi', file = '$fileName', tipe = '$tipe', directory = '$directory', penulis = '$penulis', public = $publish WHERE id='$id'";


// menghapus file lama
$sqlFile = "SELECT file,directory from content where id='$id'";
$file = mysqli_query($conn, $sqlFile);
$files = mysqli_fetch_all($file);
foreach ($files as $row) {
    $path_file = $row[0];
    $directory = $row[1];
}

if (file_exists($directory.$path_file)) {
    if (is_writable($directory . $path_file)) {
        unlink($directory . $path_file);
    }
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
    .my-confirm-button-class{
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
                text: 'Data berhasil diedit.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'my-title-class',
                    content: 'my-content-class',
                    confirmButton: 'my-confirm-button-class'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../stories/private.php';
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
