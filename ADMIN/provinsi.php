<!DOCTYPE html>
<?php 
  ob_start();
  session_start();
  if(!isset($_SESSION['emailuser'])){
    header("location:login.php");
  }

 ?>
<html lang="en">
<?php 
  include "header.php";
?>
<div class="container-fluid">
<div class="card shadow mb-4">

<?php
	include "includes/config.php";

	if(isset($_POST['simpan']))
	{
		if (isset($_REQUEST['inputprovinsinama'])){
			$provinsinama =$_REQUEST['inputprovinsinama'];

		}
		if (!empty($provinsinama)){
			$provinsinama =$_REQUEST['inputprovinsinama'];
		}
		else{
		?> <h1>anda harus mengisi data nama provinsi</h1> <?php die("anda harus memasukan datanya");
		}

		
		$provinsiid = $_POST['inputprovinsiid'];
    $provinsitglberdiri   = $_POST['inputprovinsitglberdiri'];
    
		

		mysqli_query($connection, "insert into provinsi values('$provinsiid', '$provinsinama', '$provinsitglberdiri')");
    header("location: provinsi.php");
	}
?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Form input data</title>
  </head>

  <div class="row">
  <div class="col-sm-1">
  </div> 

  <div class="col-sm-10">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Input Provinsi</h1>
        
      </div>

    </div>
  <form method="POST">
  
  <div class="form-group row">
    <label for="provinsiid" class="col-sm-2 col-form-label">Provinsi ID</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="provinsiid" name="inputprovinsiid" placeholder="Provinsi ID" maxlength="2" required="" >
    </div>
  </div>
  <div class="form-group row">
    <label for="provinsinama" class="col-sm-2 col-form-label">Nama Provinsi</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="provinsinama" name="inputprovinsinama" placeholder="Nama Provinsi" maxlength="25" >
    </div>
  </div>
  <div class="form-group row">
    <label for="provinsitglberdiri" class="col-sm-2 col-form-label">Tanggal Berdiri</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="provinsitglberdiri" name="inputprovinsitglberdiri" placeholder="Tanggal Berdiri" >
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

<div class="col-sm-1"></div>
</div>


<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Daftar Provinsi</h1>
          <h2>tampilan isi dari database</h2>
        </div>

      </div> <!-- penutup jumbotron -->
<!-- flag search bar -->

<!-- flag output -->
  
    <table class="table table-hover table-danger">
      <thead class="thead-dark">
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Nama Provinsi</th>
          <th>Tanggal Berdiri</th>
         

          <th colspan="2" style="text-align: center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $query = mysqli_query($connection,"SELECT * FROM provinsi");
        $nomor = 1;
        while($row = mysqli_fetch_array($query)){
          ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $row['provinsiID']; ?>
            </td>
            <td><?php echo $row['provinsinama']; ?>
            </td>
            <td><?php echo $row['provinsitglberdiri']; ?>
            </td>
           
                      
    
          <!--icon edit dan delete -->
          <td style="text-align: center">
            <a href="provinsiedit.php?ubah=<?php echo $row["provinsiID"]?>" class="btn-success btn-sm" title="Edit">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            </a>
          </td>
          <td style="text-align: center">
            <a href="provinsidelete.php?hapus=<?php echo $row["provinsiID"]?>" class="btn-danger btn-sm" title="Delete">
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







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</div>
</div> <!-- penutup container fluid -->
<?php include "footer.php";?>

<?php 
  mysqli_close($connection);
  ob_end_flush();

 ?>
</html>

