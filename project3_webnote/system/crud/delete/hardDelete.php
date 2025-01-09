<?php
session_start();
include '../../../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: loginPage/login.php");
}


$id = $_POST['id'];
$idTable = $_SESSION['id'];


// mengambil nama file dan nama directory dari database
$sqlFile = "SELECT file,directory from content where id='$id'";
$file = mysqli_query($conn, $sqlFile);
$files = mysqli_fetch_all($file);
foreach ($files as $row) {
    $path_file = $row[0];
    $directory = $row[1];
}

// menghapus file dari directory
if (file_exists($directory . $path_file)) {
    if (is_writable($directory . $path_file)) {
        unlink($directory . $path_file);
    }
}


// menghapus data pada database
$sql = "DELETE FROM content where id = $id";
if(mysqli_query($conn, $sql)){
    header("location: ../../stories/trash.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus catatan</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<style>
    .my-confirm-button-class {
        background-color: #fc4d3d;
    }
</style>

<body>
</body>

</html>