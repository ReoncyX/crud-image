<?php 
include "koneksi.php";

	  if(isset($_GET['hapus'])){
		$id_barang = $_GET['hapus'];
		$queryShow = "SELECT * FROM item WHERE id_barang = '$id_barang'";
		$sqlShow = $koneksi->query($queryShow);
		$data = mysqli_fetch_assoc($sqlShow);

		//var_dump($result);

		if($data['fotobarang'] !==''){
			unlink("gambar/".$data['fotobarang']);
			mysqli_query($koneksi, "DELETE FROM item WHERE id_barang = '$id_barang'");
		} else {
			mysqli_query($koneksi, "DELETE FROM item WHERE id_barang = '$id_barang'");
		}
			header("location:tampil.php");
	}
$koneksi->close();
?>
