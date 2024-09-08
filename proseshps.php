<?php
	include 'hapus.php';
	session_start();

	if(isset($_GET['hapus'])){
		if($_GET['hapus']){

			$berhasil = $_GET;

			if($berhasil){
				$_SESSION['hasil'] = "<center>Data Berhasil Di Hapus</center>,success";
				header("location: tampil.php");
			}else{
				$_SESSION['hasil'] = "<center>Data Gagal Di Hapus</center>,danger";
				header("location: tampil.php");
			}

		}
	}
?>
