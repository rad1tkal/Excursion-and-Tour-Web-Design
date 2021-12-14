<?php 

	include "includes/config.php";

	if(isset($_GET['hapusfoto'])){
		$fotokode = $_GET['hapusfoto'];
		$hapusfoto = mysqli_query($connection, "SELECT * FROM fotorestoran WHERE fotoRID = '$fotokode'");

		$hapus =mysqli_fetch_array($hapusfoto);
		$nama = $hapus['fotofile'];

		mysqli_query($connection, "DELETE FROM fotorestoran WHERE fotoRID = '$fotokode'");

		unlink("images/".$nama);

		echo "<script>alert('DATA TELAH DIHAPUS'); document.location ='fotorestoran.php'</script>";
	}




?>