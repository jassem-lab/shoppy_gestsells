<?php
session_start();
$con = mysqli_connect('localhost', 'root');
$db = mysqli_select_db($con, 'gestsells');
	
	$id  = $_GET["ID"] ;	
	
	$sql = "UPDATE `gestsells_brand` SET archive=1  WHERE id=".$id;
	$requete = mysqli_query($con,$sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../brand.php" </SCRIPT>';
?>