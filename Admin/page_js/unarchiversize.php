<?php
session_start();
$con = mysqli_connect('localhost', 'root');
$db = mysqli_select_db($con, 'gestsells');
	
	$id  = $_GET["ID"] ;	
	
	$sql = "UPDATE `gestsells_size` SET archive=0  WHERE id=".$id;
	$requete = mysqli_query($con,$sql) ;
	
    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../sizes.php" </SCRIPT>';
?>