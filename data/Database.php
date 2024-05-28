<?php

function debug($z) {
    echo "<pre>";
    print_r($z);
    die;
}

class Database {
    private $host = "localhost";
    private $username = "root";
    private $pass = "";
    private $db = "user_master";
    private $connect;

    function __construct() {
        $this->connect = mysqli_connect($this->host, $this->username, $this->pass);
        mysqli_select_db($this->connect, $this->db);
    }

    function getAllData() : array {
        $data = mysqli_query($this->connect, "select * from user");
        $temp = [];
        while ($value = mysqli_fetch_array($data)) {
            $temp[] = $value;
        }
        return $temp;
    }

    function getOneData($id) : array {
        $id = (int)$id;
        $data = mysqli_query($this->connect, "select * from user where id = $id");
        $temp = [];
        while ($value = mysqli_fetch_array($data)) {
            $temp[] = $value;
        }
        if (empty($temp)) {
            return [];
        }
        return $temp[0];
    }

    function store($nama, $alamat, $usia) : string {
        try {
            // versi umum
            // mysqli_query($this->connect, "insert into user (nama, alamat, usia) values ('$nama', '$alamat', '$usia')");
            
            // versi aman
            $statement = $this->connect->prepare("insert into user (nama, alamat, usia) values (?,?,?)");
            $statement->bind_param('ssi', $nama, $alamat, $usia);
            
            if ($statement->execute()) {
                return 1;
            }else {
                return "Gagal menyimpan data, harap coba lagi";
            }
            $statement->close();
        } catch (\Throwable $th) {
            return "Terjadi Kesalahan, Berikut detail kesalahan : <br>".$th->getMessage();
        }
    }

    function update($id, $data) : string {
        try {
            // versi umum 
            // mysqli_query($this->connect, "update user set nama = '{$data['nama']}', alamat = '{$data['alamat']}', usia = '{$data['usia']}' where id = $id");
            
            // versi aman
            $statement = $this->connect->prepare("update user set nama = ?, alamat = ?, usia = ? where id = ?");
            $statement->bind_param('ssii', $data['nama'], $data['alamat'], $data['usia'], $id);
            
            if ($statement->execute()) {
                return 1;
            }else {
                return "Gagal menyimpan data, harap coba lagi";
            }
            $statement->close();
        } catch (\Throwable $th) {
            return "Terjadi Kesalahan, Berikut detail kesalahan : <br>".$th->getMessage();
        }
    }

    function delete($id) : string {
        try {
            $id = (int)$id;
            mysqli_query($this->connect, "delete from user where id = $id");
            return 1;
        } catch (\Throwable $th) {
            return "Terjadi Kesalahan, Berikut detail kesalahan : <br>".$th->getMessage();
        }   
    }
}


