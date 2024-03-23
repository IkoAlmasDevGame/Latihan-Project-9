<?php 
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$host = "localhost";
$dbname = "db_bebas4";
$user = "root";
$pass = "";

try {
    $configs = new PDO("mysql:host=$host;dbname=$dbname;", $user,$pass);
} catch (PDOException $e){
    die("Koneksi gagal : ".$e->getMessage());
}
?>