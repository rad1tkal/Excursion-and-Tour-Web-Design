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
  

  if(isset($_POST['simpan']))
  {
    if (isset($_REQUEST['inputkode'])){
      $kategorikode =$_REQUEST['inputkode'];

    }
    if (!empty($kategorikode)){
      $kategorikode =$_REQUEST['inputkode'];
    }
    else{
    ?> <h1>anda harus mengisi data kode</h1> <?php die("anda harus memasukan datanya");
    }

    
    $kategorinama = $_POST['inputnama'];
    $kategoriket = $_POST['inputket'];
    $kategoriref = $_POST['inputref'];

    mysqli_query($connection, "insert into kategori values('$kategorikode', '$kategorinama','$kategoriket','$kategoriref')");
    header("location: kategori.php");
  }
?>
<html>
<head>
  <title>OUTPUT DATA</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

  <div class="row">
  <div class="col-sm-1">
  </div> 

  <div class="col-sm-10">
      <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Input Kategori Wisata</h1>
     
      </div>

    </div>
  <form method="POST">
  
  <div class="form-group row">
    <label for="kodekategori" class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="kodekategori" name="inputkode" placeholder="Kode Kategori" maxlength="4" >
    </div>
  </div>
  <div class="form-group row">
    <label for="namakategori" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="namakategori" name="inputnama" placeholder="Nama Kategori" maxlength="30" required="">
    </div>
  </div>
  <div class="form-group row">
    <label for="ketkategori" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="ketkategori" name="inputket" placeholder="Keterangan Kategori" maxlength="255">
    </div>
  </div>
  <div class="form-group row">
    <label for="refkategori" class="col-sm-2 col-form-label">Referensi</label>
    <div class="col-sm-10">
      <input type="Text" class="form-control" id="refkategori" name="inputref" placeholder="Referensi Kategori" maxlength="30">
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
          <h1 class="display-4">Daftar Kategori Wisata</h1>
          <h2>tampilan isi dari database</h2>
        </div>

      </div> <!-- penutup jumbotron -->

      <form method="POST">
      <div class="form-group row mb-2">
        <label for="search" class="col-sm-3">Nama Kategori</label>
        <div class="col-sm-6">
          <input type="text" name="search" class="form-control" id="search" placeholder="Cari Nama Kategori" value="<?php if(isset($_POST['search'])){ echo $_POST['search'];}?>">
              
        </div>
        <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
      </div>

    </form>

    <table class="table table-hover table-danger">
      <thead class="thead-dark">
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Nama Kategori</th>
          <th>Keterangan</th>
          <th>Referensi</th>
          <th colspan="2" style="text-align: center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      if(isset($_POST["kirim"])){
        $search = $_POST['search'];
        $query = mysqli_query($connection, "SELECT * FROM kategori WHERE kategorinama like '%".$search."%' OR kategoriketerangan like '%".$search."%'
          OR kategorireferensi like '%".$search."%';");
      } else {

        $query = mysqli_query($connection, "SELECT * FROM kategori;");
      }
        $nomor = 1;
        while($row = mysqli_fetch_array($query)){
          ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $row['kategoriID']; ?>
            </td>
            <td><?php echo $row['kategorinama']; ?>
            </td>
            <td><?php echo $row['kategoriketerangan']; ?>
            </td>
            <td><?php echo $row['kategorireferensi']; ?>
            </td>

            <td style="text-align: center">
            <a href="kategoriedit.php?ubah=<?php echo $row["kategoriID"]?>" class="btn-success btn-sm" title="Edit">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            </a>
          </td>
          <td style="text-align: center">
            <a href="kategoridelete.php?hapus=<?php echo $row["kategoriID"]?>" class="btn-danger btn-sm" title="Delete">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
            </svg>
            </a>
          </td>
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
<?php include "footer.php";?>

<?php 
  mysqli_close($connection);
  ob_end_flush();

 ?>
</html>