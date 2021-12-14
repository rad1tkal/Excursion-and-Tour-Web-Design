<!DOCTYPE html>
<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION['emailuser'])){
		header("location:login.php");
	}

 ?>
<html>
<head>
	<title>Destinasi Wisata</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php 
	include "header.php";
?>

<div class="container-fluid">
<div class="card shadow mb-4">
<?php 
	include "includes/config.php";
	if(isset($_POST['simpan'])){
		$kodefoto = $_POST['inputkode'];
		$namafoto = $_POST['inputnamafoto'];
		$kodedestinasi = $_POST['kodedestinasi'];

		$namafile = $_FILES['file']['name'];
		$file_tmp = $_FILES["file"]["tmp_name"];

		$fextension = pathinfo($namafile, PATHINFO_EXTENSION);
		//pereksa harus jpg atau png (dalam kasus ini)
		if(($fextension == "jpg") or ($fextension == "JPG") or ($fextension == "png") or ($fextension == "PNG")){
			move_uploaded_file($file_tmp, 'images/'.$namafile); //unggah file dari folder images
			mysqli_query($connection, "insert into fotodestinasi values('$kodefoto','$namafoto', '$kodedestinasi', '$namafile')");

			header("location:fotodestinasi.php");

		}

	}

	$datadestinasi = mysqli_query($connection, "select * from destinasi");



?>





<div class="row">
	<div class="col-sm-1"></div>

	<div class="col-sm-10">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Input Photo Destinasi Wisata</h1>
			</div>

		</div>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group row">
				<label for="kodefoto" class="col-sm-2 col-form-label">Kode Photo</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="kodefoto" name="inputkode" placeholder="Kode Photo" maxlength="5">
				</div>
			</div>

			<div class="form-group row">
				<label for="namafoto" class="col-sm-2 col-form-label">Nama Photo</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="namafoto" name="inputnamafoto" placeholder="Nama Photo" >
				</div>
			</div>


			<div class="form-group row">
				<label for="kodedestinasi" class="col-sm-2 col-form-label">Nama Destinasi</label>
				<div class="col-sm-10">
					<select class="form-control" id="kodedestinasi" name="kodedestinasi">
						<?php
							while($row = mysqli_fetch_array($datadestinasi)){
						?>
							<option value="<?php echo $row["destinasiID"]?>">
								<?php echo $row["destinasiID"]?>
								<?php echo $row["destinasinama"]?>
							</option>
						<?php
							}
						?>

					</select>
					
				</div>
			</div>

			<div class="form-group row">
				<label for="file" class="col-sm-2 col-form-label">Photo Wisata</label>
				<div class="col-sm-10">
					<input type="file"  id="file" name="file">
					<p class="help-block">Field ini digunakan untuk unggah</p>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-2"></div>
				<div class="col-sm">
					<input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
					<input type="submit" name="batal" class="btn btn-secondary" value="Batal">

				</div>
			</div>

		</form>

	</div>

	<div class="col-sm-1"></div>
</div>

<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Daftar Foto Destinasi</h1>
			</div>

		</div>
	
	<!-- FLAG TABEL OUTPUT -->
	<table class="table table-hover table-danger">
		<thead class="thead-dark">
			<tr>
				<th>No.</th>
				<th>Kode Foto</th>
				<th>Nama Foto Wisata</th>
				<th>Kode Destinasi</th>
				<th>Foto destinasi</th>
				<th colspan="2" style="text-align:center">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $query = mysqli_query($connection, "select * from fotodestinasi");
			$nomor = 1;
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $nomor?></td>
					<td><?php echo $row['fotoID']?></td>
					<td><?php echo $row['fotonama']?></td>
					<td><?php echo $row['destinasiID']?></td>
					<td>
						<?php 
						if(is_file("images/".$row['fotofile'])){
						?>
							<img src="images/<?php echo $row['fotofile']?>" width="80">
						<?php 
						} 
						else {
							echo "<img src='images/noimage.jpg' width='80'>";
						}
						?>
							
						
					</td>

					<td>
						<a href="fotodestinasiedit.php?ubahfoto=<?php echo $row['fotoID']?>" class="btn btn-success btn-sm" title="Edit">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
						</a>
					</td>

						<td>
						<a href="fotodestinasidelete.php?hapusfoto=<?php echo $row['fotoID']?>" class="btn btn-danger btn-sm" title="Delete">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
						</svg>
						</a>
					</td>



				</tr>
				<?php $nomor = $nomor +1;?>
			<?php 
			}

			?>	

		</tbody>


	</table>
	</div>
	<div class="col-sm-1"></div>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


</div>
</div>

<?php include "footer.php";?>

<?php 
	mysqli_close($connection);
	ob_end_flush();

 ?>
</html>