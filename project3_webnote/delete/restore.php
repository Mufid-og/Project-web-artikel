<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: loginPage/login.php");
}

include '../koneksi.php';

$id = $_POST['id'];
$idTable = $_SESSION['id'];
var_dump($id);

$sql = "UPDATE content set delete_at = null where id = $id";
$sqlFile = "select file,directory from content where id='$id'";

$file = mysqli_query($conn, $sqlFile);
$files = mysqli_fetch_all($file);
foreach ($files as $row) {
    $path_file = $row[0];
    $directory = $row[1];
}

if (file_exists($directory . $path_file)) {
    if (is_writable($directory . $path_file)) {
        unlink($directory . $path_file);
    }
}

if(mysqli_query($conn, $sql)){
    header("location: ../stories/trash.php");
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