<?php
session_start();
$con = mysqli_connect('localhost', 'root');
$db = mysqli_select_db($con, 'gestsells');

$id = $_GET["ID"];

$profil = "";
$req = "select * from gestsells_profils  WHERE id=" . $id;
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $profil = $enreg['profil'];
}


$sql = "delete from `gestsells_profils` WHERE id=" . $id;
$requete = mysqli_query($con, $sql);

$dateheure = date('Y-m-d H:i:s');
$iduser = $_SESSION['idutilisateur'];
$sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`, `code`) VALUES ('" . $dateheure . "','" . $iduser . "','19','3','" . $id . "','" . $profil . "')";
$req = mysqli_query($con, $sql1);

echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../profils.php" </SCRIPT>';

?>