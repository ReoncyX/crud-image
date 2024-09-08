<?php
	include 'tambah.php';
	session_start();

	if(isset($_POST['tambah'])){
		if($_POST['tambah'] == "add"){
			
			$berhasil = $_POST && $_FILES;

			if($berhasil){
				$_SESSION['hasil'] = "<center>Data berhasil ditambahkan</center>,success";
				header("location: tampil.php");
			} else {
				echo $berhasil;
			}

		} 
	}
?>