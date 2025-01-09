<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tes_note';

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    echo 'database tidak terhubung';
}
