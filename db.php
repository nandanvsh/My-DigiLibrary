<?php
    $db = new mysqli("localhost", "root", "", "db_pweb");
    if ($db->connect_error) {
        die("Koneksi Gagal");
}
