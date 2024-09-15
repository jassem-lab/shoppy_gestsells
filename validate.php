<?php
session_start();

$con = mysqli_connect('localhost', 'root');
if ($con) {
    echo "connection successful";
} else {
    echo "no connection";
}

$db = mysqli_select_db($con, 'gestsells');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = " select * from  gestsells_users where mail='$email' and password='$password' ";
    $query = mysqli_query($con, $sql);
   
    $row = mysqli_num_rows($query);
    if ($row == 1) {
        while ($enreg = mysqli_fetch_array($query)) {
            $USER = $enreg["username"];
            $IDUTILISATEUR = $enreg['id'];
            $MAIL = $enreg['mail'];
            $TEL = $enreg['tel'];
            $idprofil = $enreg['idprofil'];
            $_SESSION['user'] =  $USER ;
            $_SESSION['idutilisateur'] =  $IDUTILISATEUR ;
            $_SESSION['mail'] = $MAIL ;
            $_SESSION['idprofil'] =  $idprofil ;
            header('location:./admin/index.php');
        }
    } else {
        
      
        header('location:./index.php?error=1');
    }

}

?>