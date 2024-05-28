<?php

require_once "data/Database.php";

$db  = new Database();

if (isset($_GET['id'])) {
    $id = trim(base64_decode($_GET['id']));
}

// update
if (isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['usia']) && isset($_POST['id'])) {
    $id = trim(base64_decode($_POST['id'])); 
    $response = $db->update($id, $_POST);
    if ($response == 1) {
        echo "berhasil memperbarui data <br> ";
        echo '<a href="./index.php">Kembali</a>';
    }else {
        echo "gagal memperbarui data!<br> ";
        echo $response." <br>";
        echo '<a href="./add-user.php">Kembali</a>';
    }
    die;    
}

// get data
$getUser = $db->getOneData($id);
if (empty($getUser)) {
    echo "Tidak ada data!<br> ";
    echo '<a href="./index.php">Kembali</a>';
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
    <h4>Edit User</h4>
    <a href="./index.php">Kembali</a>
    <form action="./edit-user.php" method="post">
        <input type="hidden" name="id" value="<?= base64_encode("   ".$id) ?>">
        <input type="text" name="nama" placeholder="nama" value="<?= $getUser['nama'] ?>"><br>
        <input type="text" name="alamat" placeholder="alamat" value="<?= $getUser['alamat'] ?>"><br>
        <input type="number" name="usia" placeholder="usia" value="<?= $getUser['usia'] ?>"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>