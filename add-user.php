<?php

require_once "data/Database.php";

$db  = new Database();

if (isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['usia'])) {
    $response = $db->store($_POST['nama'], $_POST['alamat'], $_POST['usia']);
    if ($response == 1) {
        echo "berhasil menambahkan data <br> ";
        echo '<a href="./index.php">Kembali</a>';
    }else {
        echo "gagal menambahkan data!<br> ";
        echo $response." <br>";
        echo '<a href="./add-user.php">Kembali</a>';
    }
    die;    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master User - Untuk Traning PKL</title>
</head>
<body>
    <h1>Master User PKL Quick</h1>
    <h4>Tambah User</h4>
    <a href="./index.php">Kembali</a>
    <form action="./add-user.php" method="post">
        <input type="text" name="nama" placeholder="nama"><br>
        <input type="text" name="alamat" placeholder="alamat"><br>
        <input type="number" name="usia" placeholder="usia"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>