<?php
session_start();
include 'koneksi.php';

$username = htmlspecialchars($_POST['username']);
$pass = password_hash(htmlspecialchars($_POST['password']), PASSWORD_ARGON2ID);
$nama = htmlspecialchars($_POST['nama']);
$namaTable = $_SESSION['id'];
var_dump($username);
var_dump($namaTable);


if(!$_FILES['profil']['name']){
    $profilName = '';
}else{
    $profilName = uniqid().$_FILES['profil']['name'];
}
$profilFile = $_FILES['profil']['tmp_name'];

move_uploaded_file($profilFile,"upload/".$profilName);

$sql = "INSERT INTO user(`username`, `nama_user`, `password`, `profil`) values('$username', '$nama', '$pass', '$profilName')";

if(mysqli_query($conn,$sql)){
    header("location: index.php");
    $_SESSION['login'] = true;
}


