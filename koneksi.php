<?php 
global $koneksi;
$koneksi = mysqli_connect("localhost","root","","daftar_hadir_eskul_basket");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>