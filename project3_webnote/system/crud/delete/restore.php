<?php
session_start();
include '../../../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: loginPage/login.php");
}


$id = $_POST['id'];
$sql = "UPDATE content set delete_at = null where id = $id";

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