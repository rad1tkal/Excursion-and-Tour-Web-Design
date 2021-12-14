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
	<title>Sewa Kendaraan</title>
</head>

<?php 
	include "header.php";
?>

<div class="container-fluid">
<div class="card shadow mb-4">



<?php include "includes/config.php"; ?>
<?php
	

	if(isset($_POST['simpan']))
	{
		if (isset($_REQUEST['inputkode'])){
			$sewakode =$_REQUEST['inputkode'];

		}
		if (!empty($sewakode)){
			$sewakode =$_REQUEST['inputkode'];
		}
		else{
		 die(" anda harus memasukan datanya");
		}

		
		$sewanama = $_POST['inputnama'];
		$sewaalamat = $_POST['inputalamat'];
		$sewajenis = $_POST['inputjenis'];
		$harga = $_POST["inputharga"];
		$areakode = $_POST["kodearea"];
		$sewatelp = $_POST['inputnotelp'];
		mysqli_query($connection, "UPDATE sewakendaraan SET sewanama='$sewanama', sewaalamat='$sewaalamat',sewajenis='$sewajenis',sewaharga='$harga',sewatelp='$sewatelp', areaID = '$areakode' WHERE sewaID = '$sewakode'");
		header("location: sewakendaraan.php");
	}

	$dataarea = mysqli_query($connection, "select * from area;");

	$temp = $_GET["ubah"];
	$editsewakendaraan= mysqli_query($connection, "SELECT * FROM sewakendaraan WHERE sewaID = '$temp'");
	$rowedit = mysqli_fetch_array($editsewakendaraan);
	$editarea = mysqli_query($connection, "SELECT * FROM sewakendaraan,area WHERE sewaID = '$temp' AND sewakendaraan.areaID = area.areaID");
	$rowedit2 = mysqli_fetch_array($editarea);

?>
<html>
<head>
	<title>Sewa Mobil</title>
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
				<h1 class="display-4">Input Tempat Sewa Kendaraan</h1>
				
			</div>

		</div>
  <form method="POST">
  <div class="form-group row">
    <label for="kodesewa" class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="kodesewa" name="inputkode" value="<?php echo $rowedit["sewaID"] ?>" readonly >
    </div>
  </div>
  <div class="form-group row">
    <label for="namasewa" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="namasewa" name="inputnama" value="<?php echo $rowedit["sewanama"] ?>"  maxlength="60" required="">
    </div>
  </div>
  <div class="form-group row">
    <label for="alamatsewa" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="alamatsewa" name="inputalamat" value="<?php echo $rowedit["sewaalamat"] ?>"  maxlength="60" required="">
    </div>
  </div>
  <div class="form-group row">
    <label for="jeniskendaraan" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
    <div class="col-sm-10">
      <select class="form-control" id="jeniskendaraan" name="inputjenis">
      		<option value="<?php echo $rowedit["sewajenis"]?>"><?php echo $rowedit["sewajenis"]?></option>
      		<option value="Motor">Motor</option>
      		<option value="Mobil(MPV)">Mobil(MPV)</option>
      		<option value="Mobil(Van)">Mobil(Van)</option>
      		<option value="Mobil(Pickup)">Mobil(Pickup)</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="harga" name="inputharga" value="<?php echo $rowedit["sewaharga"] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="sewatelp" class="col-sm-2 col-form-label">No Telp</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="sewatelp" name="inputnotelp" value="<?php echo $rowedit["sewatelp"] ?>" maxlength="12">
    </div>
  </div>

  <div class="form-group row">
    <label for="refkategori" class="col-sm-2 col-form-label">Area</label>
    <div class="col-sm-10">
    <select  class="form-control" id="kodearea" name="kodearea">
    	
    	<option value="<?php echo $rowedit["areaID"]?>"><?php echo $rowedit['areaID']?>  <?php echo $rowedit2['areanama']?> </option>
    	<?php 
    		while ($row = mysqli_fetch_array($dataarea)){

    		

    	?>
    	<option  value="<?php echo $row["areaID"];?>">
    		<?php echo $row["areaID"];?>
    		<?php echo $row["areanama"];?>
    		

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
    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan"></input>
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
					<h1 class="display-4">Daftar Tempat Sewa Kendaraan</h1>
					<h2>tampilan isi dari database</h2>
				</div>

			</div> <!-- penutup jumbotron -->
<!-- flag search bar -->
			<form method="POST">
			<div class="form-group row mb-2">
				<label for="search" class="col-sm-3">Search</label>
				<div class="col-sm-6">
					<input type="text" name="search" class="form-control" id="search" placeholder="Cari Nama Tempat Sewa" value="<?php if(isset($_POST['search'])){ echo $_POST['search'];}?>">
							
				</div>
				<input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
			</div>
<!-- flag output -->
		</form>
		<table class="table table-hover table-danger">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama Tempat Sewa</th>
					<th>Alamat Tempat Sewa</th>
					<th>Jenis Kendaraan</th>
					<th>Harga Sewa/hari</th>
					<th>No Telp</th>
					<th>Kode Area</th>
					<th>Nama Area</th>
			


					<th colspan="2" style="text-align: center">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if(isset($_POST["kirim"])){
				$search = $_POST['search'];
				$query = mysqli_query($connection, "SELECT sewakendaraan.*, area.areaID, area.areanama FROM sewakendaraan,area WHERE (sewanama like '%".$search."%'  OR sewaalamat like '%".$search."%' OR sewajenis like '%".$search."%') AND area.areaID =  sewakendaraan.areaID");
			} else {

				$query = mysqli_query($connection, "SELECT sewakendaraan.*, area.areaID, area.areanama FROM sewakendaraan,area WHERE area.areaID =  sewakendaraan.areaID");
			}
				$nomor = 1;
				while($row = mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $row['sewaID']; ?>
						</td>
						<td><?php echo $row['sewanama']; ?>
						</td>
						<td><?php echo $row['sewaalamat']; ?>
						</td>
						<td><?php echo $row['sewajenis']; ?>
						</td>
						<td><?php echo $row['sewaharga']; ?>
						</td>
						<td><?php echo $row['sewatelp']; ?>
						</td>
						<td><?php echo $row['areaID']; ?>
						</td>
						<td><?php echo $row['areanama']; ?>
											
					</td>
					<!--icon edit dan delete -->
					<td>
						<a href="sewakendaraanedit.php?ubah=<?php echo $row["sewaID"]?>" class="btn-success btn-sm" title="Edit">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
						  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
						</a>
					</td>
					<td>
						<a href="sewakendaraandelete.php?hapus=<?php echo $row["sewaID"]?>" class="btn-danger btn-sm" title="Delete">
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
		$('#kodearea').select2({
			allowClear:true,
			placeholder: "pilih Area Wisata:"
		})
	})
</script>
</div>
</div> <!-- penutup container fluid -->
<?php include "footer.php";?>

<?php 
	mysqli_close($connection);
	ob_end_flush();

 ?>
</html>