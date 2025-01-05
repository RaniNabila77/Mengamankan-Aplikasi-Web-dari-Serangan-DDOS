<?php

$host="localhost";
$user="u619568345_Game";
$password="TheGlitz6";
$db="u619568345_GameDev";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
        die("Koneksi Gagal:".mysqli_connect_error());
        
}
?>