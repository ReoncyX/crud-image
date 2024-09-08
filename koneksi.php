<?php
	$server   = 'localhost';
	$username = 'root';
	$password = '';
	$database =  'daftarbarang';

	$koneksi = mysqli_connect($server, $username, $password, $database);

	if($koneksi){

	}
	mysqli_select_db($koneksi, $database);
?>