<?php 

	include "includes/config.php";

	if(isset($_GET['hapusfoto'])){
		$fotokode = $_GET['hapusfoto'];
		$hapusfoto = mysqli_query($connection, "SELECT * FROM fotohotel WHERE fotoHID = '$fotokode'");

		$hapus =mysqli_fetch_array($hapusfoto);
		$nama = $hapus['fotofile'];

		mysqli_query($connection, "DELETE FROM fotohotel WHERE fotoHID = '$fotokode'");

		unlink("images/".$nama);

		echo "<script>alert('DATA TELAH DIHAPUS'); document.location ='fotohotel.php'</script>";
	}




?>