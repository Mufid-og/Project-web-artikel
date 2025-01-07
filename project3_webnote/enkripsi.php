<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="password" name="pw">
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>


<?php

if(isset($_POST['submit'])){
    $pw = $_POST['pw'];
    $p = '$2y$10$Y6OwOj7m3m3oCiWp72jgO.q7CiJWq4I1XGrKLi9nf5VYrAufQpRzW';
    
    // if(password_verify($pw, $p)){
    //     echo "benar ". $pw;   
    // }else{
    //     echo "salah ". $pw;
    // }

    $bcrbyt = password_hash($pw, PASSWORD_BCRYPT);
    $argon = password_hash($pw, PASSWORD_ARGON2ID);

    $verifyBcrbyt = password_verify($pw, $bcrbyt);
    $verifyArgon = password_verify($pw, $argon);

    echo "
        ini password awal '$pw' <br>
        ini enkripsi bcrbyt '$bcrbyt' <br>
        ini enkripsi argon '$argon' <br>
        ini verify bcrbyt '$verifyBcrbyt' <br>
        ini verify argon '$verifyArgon' <br>
    ";

}