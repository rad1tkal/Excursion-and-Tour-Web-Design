<?php
	
	/** inikoneksi database **/
	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "a_wisata";

	$connection = mysqli_connect($servername, $username,$password, $dbname);

	if (!$connection){
		die("not connected" .mysqli_connect_error());
	}
	else if ($connection){
		echo "connected";
	}

	

?>