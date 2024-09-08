<?php
include 'koneksi.php';

$query = "SELECT * FROM item;";
$sql  = mysqli_query($koneksi, $query);
$no = 0;

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>DATA BARANG</title>
</head>

<body>
	<nav class="navbar bg-body-tertiary">
		<div class="container-fluid">
		    <a class="navbar-brand" href="#">

		    </a>
		</div>
	</nav>

	<!---------------[ JUDUL ]--------------->
	<div class="container">
		<h1 class="mt-5">CRUD IMAGE PHP 7 & BOOTSTRAP 5</h1>
		<figure>
			<blockquote class="blockquote">
				<p>Created By Gusti Rian</p>
			</blockquote>
			<figcaption class="blockquote-footer">CRUD <cite title="Source Title"> (Create Read Update Delete) </cite></figcaption>
		</figure>

		
		<a href="tambah.php" type="button" class="btn btn-primary mb-3 fw-bold">ADD DATA</a>

		<?php
		if(isset($_SESSION['hasil'])):
			$split = explode(",", $_SESSION['hasil']);
			?>
			<div class="alert alert-<?php echo $split[1];?> alert-dismissible fade show" role="alert">
				<strong><?php echo $split[0];?></strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php
			session_destroy();
		endif;
		?>


		<div class="table-responsive">
			<table id="dt" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th><center>No.</center></th>
						<th><center>Code</center></th>
						<th><center>Name</center></th>
						<th><center>Brand</center></th>
						<th><center>Photo</center></th>
						<th><center>Price</center></th>
						<th><center>Action</center></th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($result = mysqli_fetch_assoc($sql)){
						?>
						<tr>
							<td><center><?php echo ++$no; ?>.</center></td>
							<td><center><?php echo $result['kodebarang']; ?></center></td>
							<td><center><?php echo $result['namabarang']; ?></center></td>
							<td><center><?php echo $result['merek']; ?></center></td>
							<td><center>
							<?php if($result['fotobarang'] !=""){ ?>
								<img src="gambar/<?php echo $result['fotobarang']; ?>" style="width: 100px;">
							<?php }else{ ?>
								<img src="gambar/no-img.jpg" style="width: 100px;">
							<?php } ?>
							</center></td>
							<td><center><?php echo 'Rp '.$result['harga']; ?></center></td>
							
							<td><center>
                        		<button type="button" class="btn btn-success mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $result['id_barang']; ?>">EDIT</button>
								<a type="button" class="btn btn-danger mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus_<?php echo $result['id_barang']; ?>" data-href="proseshps.php?hapus=<?php echo $result['id_barang']; ?>">DELETE</a>
								<button type="button" class="btn btn-primary mt-4 fw-bold btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo $result['id_barang']; ?>">DETAIL</button>
							</center></td>
						</tr>

						<!--========================= START Modal Edit Data =========================-->
		                <div class="modal fade" id="editModal<?php echo $result['id_barang']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		                    <div class="modal-dialog">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
		                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		                            </div>
		                            <div class="modal-body">
		                                <form action="prosesedit.php" id="editForm" method="post" enctype="multipart/form-data">
		                                    <input type="hidden" name="id_barang" value="<?php echo $result['id_barang']; ?>">
		                                    <div class="mb-3">
		                                        <label for="editKodebarang" class="form-label">Kode Barang</label>
		                                        <input type="text" name="kodebarang" class="form-control" id="editKodebarang" value="<?php echo $result['kodebarang']; ?>">
		                                    </div>
		                                    <div class="mb-3">
		                                        <label for="editNamabarang" class="form-label">Nama Barang</label>
		                                        <input type="text" name="namabarang" class="form-control" id="editNamabarang" value="<?php echo $result['namabarang']; ?>">
		                                    </div>
		                                    <div class="mb-3">
		                                        <label for="editMerek" class="form-label">Merek</label>
		                                        <input type="text" name="merek" class="form-control" id="editMerek" value="<?php echo $result['merek']; ?>">
		                                    </div>
		                                    <div class="mb-3">
		                                        <label for="editFoto" class="form-label">Foto</label><br>
		                                        <img src="gambar/<?php echo $result['fotobarang']; ?>" style="width: 140px; margin-left: 40px; margin-bottom: 20px;">
		                                        <input type="file" name="fotobarang" class="form-control" accept="gambar/*">
		                                    </div>
		                                    <div class="mb-3">
		                                        <label for="editHarga" class="form-label">Harga</label>
		                                        <input type="number" name="harga" class="form-control" id="editHarga" value="<?php echo $result['harga']; ?>">
		                                    </div>

		                                    <button type="submit" name="ubah" class="btn btn-primary">Update</button>
		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <!--========================= END   Modal Edit Data =========================-->


						<div class="modal fade" id="detailModal<?php echo $result['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						   <div class="modal-dialog">
							    <div class="modal-content">
								    <div class="modal-header">
								        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Detail Data</b></h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								    </div>


							      	<div class="modal-body">
							        	<form>
								      		<div class="mb-3">
								      			<label for="kodebarang" class="col-form-label"><b>Kode Barang</b></label>
					  							<input type="text" class="form-control" value="<?php echo $result['kodebarang']; ?>" readonly>
											</div>
											<div class="mb-3">
								      			<label for="namabarang" class="col-form-label"><b>Nama Barang</b></label>
					  							<input type="text" class="form-control" value="<?php echo $result['namabarang']; ?>" readonly>
											</div>
											<div class="mb-3">
								      			<label for="merek" class="col-form-label"><b>Merek</b></label>
					  							<input type="text" class="form-control" value="<?php echo $result['merek']; ?>" readonly>
											</div>
											<div class="mb-3">
								      			<label for="fotobarang" class="col-form-label"><b>Foto</b></label><br>
								      			<?php if ($result['fotobarang'] != "") { ?>
				                                <img src="gambar/<?php echo $result['fotobarang']; ?>" class="rounded mx-auto d-block" style="width: 200px;">
				                            <?php } else { ?>
				                                <img src="gambar/no-img.jpg" style="width: 100px;">
				                            <?php } ?>

											</div>
											<div class="mb-3">
								      			<label for="harga" class="col-form-label"><b>Harga</b></label>
					  							<input type="text" class="form-control" value="<?php echo 'Rp  '.$result['harga']; ?>" readonly>
											</div>

										</form>
							      	</div>
							    </div>
						    </div>
						</div>




						<!-- Modal Konfirmasi Hapus Data -->
						<div class="modal fade" id="konfirmasi_hapus_<?php echo $result['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							    <div class="modal-content">
								    <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger"><i class="fa fa-warning"></i> WARNING <i class="fa fa-warning"></i></b></h5>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								    </div>
								    <div class="modal-body text-center">
								        <b>Anda yakin ingin menghapus <p class="text-danger"><?php echo $result['namabarang']; ?>  ?	</p></b>
								    </div>
								    <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><b><i class="fa fa-times"></i> CLOSE</b></button>
								    	<a href="proseshps.php?hapus=<?php echo $result['id_barang']; ?>" class="btn btn-danger"><b> HAPUS</b></a>
								    </div>
							    </div>
							</div>
						</div>

						<?php 
					}
					?>
				</tbody>
			</table>
		</div>

		

	</div>

<script>
    // Memproses klik tombol Detail
    $(document).ready(function() {
        $('.btn-detail').click(function() {
            var modalId = $(this).data('bs-target');
            $(modalId).modal('show');
        });
    });


    //Konfirmasi Hapus Data
	$(document).ready(function(){
		$('#konfirmasi_hapus').on('show.bs.modal', function(e){
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		});
	});

</script>

	
</body>
</html>