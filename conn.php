<?php
$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = ''; // Password (Isi jika menggunakan password)
$database = 'send_email'; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$koneksi = mysqli_connect($host,$username,$password,$database);

if(!$koneksi){
    echo "Koneksi Database Gagal...!!!";
}