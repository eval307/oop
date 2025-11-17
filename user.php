<?php

require_once "database.php";

class User extends Database {

    // CREATE
    function create($nama, $email) {
        $query = "INSERT INTO user (nama, email) VALUES ('$nama', '$email')";
        $result = $this->getKoneksi()->query($query);

        return $result ? true : false;
    }

    // READ (semua data)
    function read() {
        $query = "SELECT * FROM user ORDER BY id ASC";
        $result = $this->getKoneksi()->query($query);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // READ (berdasarkan ID)
    function readById($id) {
        $id = (int)$id; // keamanan dasar
        $query = "SELECT * FROM user WHERE id = $id";
        $result = $this->getKoneksi()->query($query);

        return $result->fetch_assoc();
    }

    // UPDATE
    function update($id, $nama, $email) {
        $id = (int)$id;
        $query = "UPDATE user SET nama = '$nama', email = '$email' WHERE id = $id";
        $result = $this->getKoneksi()->query($query);

        return $result ? true : false;
    }

    // DELETE
    function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM user WHERE id = $id";
        $result = $this->getKoneksi()->query($query);

        return $result ? true : false;
    }
}
