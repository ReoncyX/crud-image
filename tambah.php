<?php  
include "koneksi.php";

$id_barang    = "";
$kodebarang   = "";
$namabarang   = "";
$merek 		  = "";
$harga    	  = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
	$kodebarang    = $_POST['kodebarang'];
	$namabarang    = $_POST['namabarang'];
	$merek         = $_POST['merek'];
	$harga 		   = $_POST['harga'];
	$fotobarang    = $_FILES['fotobarang']['name'];

	    if($fotobarang != ""){
			$split = explode('.', $_FILES['fotobarang']['name']);
			$ekstensi = $split[count($split)-1];
			$fotobarang = $kodebarang.'.'.$ekstensi;
			$dir = "gambar/";
			$tmpFile = $_FILES['fotobarang']['tmp_name'];

			move_uploaded_file($tmpFile, $dir.$fotobarang);

			$SQLsimpan = "INSERT INTO item(kodebarang, namabarang, merek, fotobarang, harga) VALUES('$kodebarang', '$namabarang', '$merek', '$fotobarang', '$harga')";
			
				if ($koneksi->query($SQLsimpan)===TRUE) {
					header('location:tampil.php');
				}else{
					echo "<script>alert('Data Barang dengan kodebarang: $kodebarang, Gagal diSimpan !');</script>";
			}
		}else{
			$SQLsimpan = "INSERT INTO item(kodebarang, namabarang, merek, fotobarang, harga) VALUES('$kodebarang', '$namabarang', '$merek', NULL, '$harga')";
				
				if ($koneksi->query($SQLsimpan)===TRUE) {
					header('location:tampil.php');
				}else{
					echo "<script>alert('Data Barang dengan kodebarang: $kodebarang, Gagal diSimpan !');</script>";
				}
		}
}

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<title>TAMBAH DATA</title>
</head>
<body>

	<nav class="navbar navbar-light bg-light mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">CRUD BS5 By Gusti Rian</a>
		</div>
	</nav>

	<div class="container">
		<form method="post" action="prosesadd.php" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $id_barang; ?>" name="id_barang">
			<div class="mb-3 row">
				<label for="kodebarang" class="col-sm-2 col-form-label">KODEBARANG</label>
				<div class="col-sm-10">
					<input type="text" name="kodebarang" class="form-control" id="kodebarang" placeholder="EX : XYZ-112233" value="<?php echo $kodebarang; ?>">
				</div>
			</div>

			<div class="mb-3 row">
				<label for="namabarang" class="col-sm-2 col-form-label">NAMABARANG</label>
				<div class="col-sm-10">
					<input type="text" name="namabarang" class="form-control" id="namabarang" placeholder="EX : SAMSUNG J2 PRIME" value="<?php echo $namabarang; ?>">
				</div>
			</div>

            <div class="mb-3 row">
            	<label for="merek" class="col-sm-2 col-form-label">MEREK</label>
            	<div class="col-sm-10">
            		<input type="text" name="merek" class="form-control" id="merek" placeholder=" EX : SAMSUNG" value="<?php echo $merek; ?>">
            	</div>
            </div>

            <div class="mb-3 row">
            	<label for="fotobarang" class="col-sm-2 col-form-label">FOTO</label>
            	<div class="col-sm-10">
            		<input type="file" name="fotobarang" class="form-control" id="fotobarang" accept="gambar/*">
            	</div>
            </div>

            <div class="preview">
            	<img src="gambar/default-image.jpg" id="img" alt=" Previews" style="width: 20%; height: 20%;">
            </div>

            <div class="mb-3 row">
            	<label for="harga" class="col-sm-2 col-form-label mt-4">HARGA</label>
            	<div class="col-sm-10">
            		<input type="number" min="0" max="999999999999999" name="harga" class="form-control mt-4" id="harga" placeholder=" EX : RP.100 000,000" value="<?php echo $harga; ?>">
            	</div>
            </div>

            <button type="submit" name="tambah" value="add" class="btn btn-primary mt-5"><i class="fa fa-floppy-o" aria-hidden="true"></i> TAMBAHKAN</button>

		</form>

		<script type="text/javascript">
			fotobarang.onchange = evt => {
				const [file] = fotobarang.files;
				if(file) {
					img.src = URL.createObjectURL(file);
				}
			}
		</script>

	</div>

</body>
</html>