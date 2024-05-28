<?php

require_once "data/Database.php";

$db  = new Database();
$getAllUser = $db->getAllData();

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'delete') {
    $id = trim(base64_decode($_GET['id']));
    $response = $db->delete($id);
    if ($response == 1) {
        echo "berhasil menghapus data <br> ";
        echo '<a href="./index.php">Kembali</a>';
    }else {
        echo "gagal menghapus data!<br> ";
        echo $response." <br>";
        echo '<a href="./index.php">Kembali</a>';
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
    <h4>List User</h4>
    <a href="./add-user.php">Tambah User</a>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Alamat</td>
                <td>Usia</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getAllUser as $key => $value) { ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['alamat'] ?></td>
                    <td><?= $value['usia'] ?></td>
                    <td>
                        <a href="./edit-user.php?id=<?php echo base64_encode("  ".$value['id']) ?>">Edit</a> | <a href="./index.php?action=delete&id=<?php echo base64_encode("  ".$value['id']) ?>">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>