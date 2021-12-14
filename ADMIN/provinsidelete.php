<?php
	
	include "includes/config.php";
	if(isset($_GET['hapus'])){

		$temp = $_GET["hapus"];
		mysqli_query($connection, "DELETE FROM provinsi WHERE provinsiID = '$temp'");
		echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='provinsi.php'</script>";
	}

?>