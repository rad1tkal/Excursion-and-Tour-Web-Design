<!DOCTYPE html>

<?php 
 	include "includes/config.php";
	ob_start();
	session_start();
	if(!isset($_SESSION['emailuser'])){
		header("location:login.php");
	}

 ?>


<html>
<head>
	<title>Wisata</title>
</head>
<body>
<?php 
	include "header.php";
?>
	
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">DASHBOARD ADMIN</h1>
		</div>


	</div>

<?php
	include "footer.php";
?> 


</body>

<?php 
	mysqli_close($connection); 
	ob_end_flush();

 ?>
</html>