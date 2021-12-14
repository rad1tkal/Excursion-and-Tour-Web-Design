<!DOCTYPE html>
<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION['emailuser'])){
		header("location:login.php");
	}

 ?>
<?php 
	include "header.php";
?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php include "includes/config.php"; ?>
<?php
	

	if(isset($_POST['Edit']))
	{
		if (isset($_REQUEST['inputkode']) AND isset($_REQUEST['inputnama']) AND isset($_REQUEST['inputwilayah']) ){
			$areakode = $_POST['inputkode'];
		 	$areanama = $_POST['inputnama'];
		 	$areawilayah = $_POST['inputwilayah'];

		}
		if (!empty($areakode) and !empty($areanama) and !empty($areawilayah)){
			$areakode = $_POST['inputkode'];
		 	$areanama = $_POST['inputnama'];
		 	$areawilayah = $_POST['inputwilayah'];
		}
		
		else{
		 die("anda harus memasukan datanya");
		}

		
		//$areanama = $_POST['inputnama'];
		//$areawilayah = $_POST['inputwilayah'];
		$areaketerangan = $_POST["inputketerangan"];
		$kodeprovinsi = $_POST["kodeprovinsi"];

		mysqli_query($connection, "UPDATE area SET areanama='$areanama',areawilayah='$areawilayah',areaketerangan='$areaketerangan',provinsiID='$kodeprovinsi' WHERE areaID = '$areakode'");
		header("location: area.php");
	}

	$dataprovinsi = mysqli_query($connection, "select * from provinsi;");

	$temp = $_GET["ubah"];
	$editarea = mysqli_query($connection, "SELECT * FROM area WHERE areaID = '$temp'");
	$rowedit = mysqli_fetch_array($editarea); 
	$editprovinsi = mysqli_query($connection, "SELECT * FROM area, provinsi WHERE areaID = '$temp' AND area.provinsiID = provinsi.provinsiID;");
	$rowedit2 = mysqli_fetch_array($editprovinsi);
	
	

?>
<html>
<head>
	<title>Input Output Data</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
	<div class="col-sm-1">
  </div> 
<!-- flag input -->
  <div class="col-sm-10">
  		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Input Area Wisata</h1>
				
			</div>

		</div>
  <form method="POST">
  <div class="form-group row">
    <label for="kodearea" class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="kodearea" name="inputkode" value="<?php echo $rowedit["areaID"] ?>" readonly >
    </div>
  </div>
  <div class="form-group row">
    <label for="namaarea" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="namaarea" name="inputnama" value="<?php echo $rowedit["areanama"] ?>" >
    </div>
  </div>
  <div class="form-group row">
    <label for="areawilayah" class="col-sm-2 col-form-label">Wilayah</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="areawilayah" name="inputwilayah" value="<?php echo $rowedit["areawilayah"] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="areaketerangan" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="areaketerangan" name="inputketerangan" value="<?php echo $rowedit["areaketerangan"] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="provinsiid" class="col-sm-2 col-form-label">ID Provinsi</label>
    <div class="col-sm-10">
    <select  class="form-control" id="kodeprovinsi" name="kodeprovinsi" >
    	<option value="<?php echo $rowedit["provinsiID"]?>"><?php echo $rowedit['provinsiID']?>  <?php echo $rowedit2['provinsinama']?> </option>
    	<?php 
    		while ($row = mysqli_fetch_array($dataprovinsi)){

    		

    	?>
    	<option  value="<?php echo $row["provinsiID"];?>">
    		<?php echo $row["provinsiID"];?>
    		<?php echo $row["provinsinama"];?>
    		

    	</option>
    	<?php 

    		}

    	?>
    	
    </select>
	</div>

  </div>

 





  <div class="form-group row">
    <div class="col-sm-2">
    	
    </div>
    <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Edit" name="Edit"></input>
	<input type="reset" class="btn btn-secondary" value="Batal" name="batal"></input>
    </div>
  </div>
</form>
</div>



<div class="col-sm-1">
</div>
</div>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Daftar Area Wisata</h1>
					<h2>tampilan isi dari database</h2>
				</div>

			</div> <!-- penutup jumbotron -->
<!-- flag search bar -->
			<form method="POST">
			<div class="form-group row mb-2">
				<label for="search" class="col-sm-3">Nama Destinasi</label>
				<div class="col-sm-6">
					<input type="text" name="search" class="form-control" id="search" placeholder="Cari Nama Destinasi" value="<?php if(isset($_POST['search'])){ echo $_POST['search'];}?>">
							
				</div>
				<input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
			</div>
<!-- flag output -->
		</form>
		<table class="table table-hover table-danger">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Area</th>
					<th>Nama Area</th>
					<th>Wilayah</th>
					<th>Keterangan</th>
					<th>Kode Provinsi</th>
					


					<th colspan="2" style="text-align: center">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			
				
				$query = mysqli_query($connection, "SELECT * FROM area");
			

				
			
				$nomor = 1;
				while($row = mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $row['areaID']; ?>
						</td>
						<td><?php echo $row['areanama']; ?>
						</td>
						<td><?php echo $row['areawilayah']; ?>
						</td>
						<td><?php echo $row['areaketerangan']; ?>
						</td>
						<td><?php echo $row['provinsiID']; ?>
						</td>
						
											
					</td>
					<!--icon edit dan delete -->
					<td>
						<a href="areaedit.php?ubah=<?php echo $row["destinasiID"]?>" class="btn-success btn-sm" title="Edit">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
						</a>
					</td>
					<td>
						<a href="areadelete.php?hapus=<?php echo $row["destinasiID"]?>" class="btn-danger btn-sm" title="Delete">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
						</svg>
						</a>
					</td>
					<!-- icon edit dan delete -->

					
					</tr>
					<?php $nomor = $nomor+1;?>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#kodeprovinsi').select2({
			allowClear:true,
			placeholder: "Pilih Provinsi:"
		})
	})
</script>

</div>
</div>

<?php include "footer.php";?>

<?php 
	mysqli_close($connection);
	ob_end_flush();

 ?>
</html>