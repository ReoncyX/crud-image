<?php

include 'koneksi.php';
session_start();

if(isset($_POST['ubah'])){

    $id_barang = $_POST['id_barang'];
    $kodebarang = $_POST['kodebarang'];
    $namabarang = $_POST['namabarang'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $fotobarang = $_FILES['fotobarang']['name'];

    // Query untuk mendapatkan data lama
    $query = "SELECT fotobarang FROM item WHERE id_barang='$id_barang'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    $fotobarangx = $data['fotobarang'];

    // Proses upload file jika ada file baru
    if($fotobarang != ""){
        $split = explode('.', $_FILES['fotobarang']['name']);
        $ekstensi = $split[count($split)-1];
        $fotobarang = $namabarang.'.'.$ekstensi;
        $dir = "gambar/";
        $tmpFile = $_FILES['fotobarang']['tmp_name'];

        unlink('gambar/'.$fotobarangx);
        move_uploaded_file($tmpFile, $dir.$fotobarang);

        $SQLupdate = "UPDATE item SET kodebarang='$kodebarang', namabarang='$namabarang', merek='$merek', fotobarang='$fotobarang', harga='$harga' WHERE id_barang='$id_barang'";
        
            // Eksekusi query
            if($koneksi->query($SQLupdate) === TRUE) {
                $_SESSION['hasil'] = "<center>Data berhasil di update</center>,success";
            } else {
                $_SESSION['hasil'] = "<center>Data gagal di update</center>,danger";
            }
            header("location:tampil.php");
    }else{

        $SQLupdate = "UPDATE item SET kodebarang='$kodebarang', namabarang='$namabarang', merek='$merek', harga='$harga' WHERE id_barang='$id_barang'";

            // Eksekusi query
            if($koneksi->query($SQLupdate) === TRUE) {
                $_SESSION['hasil'] = "<center>Data berhasil di update</center>,success";
            } else {
                $_SESSION['hasil'] = "<center>Data gagal di update</center>,danger";
            }
            header("location:tampil.php");
    }

}

?>
