<?php
	
	include "includes/config.php";
	if(isset($_GET['hapus'])){

		$temp = $_GET["hapus"];
		mysqli_query($connection, "DELETE FROM admin WHERE adminID = '$temp'");
		echo "<script>alert('DATA BERHASIL DIHAPUS'); document.location='registrasiadmin.php'</script>";
	}

?>