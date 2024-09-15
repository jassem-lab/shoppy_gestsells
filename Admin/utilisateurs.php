<?php include('./headers/navbar.php') ?>
<script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerutilisateur.php?ID=" + id;
        }
    }

    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archiverutilisateur.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchiverutilisateur.php?ID=" + id;
        }
    }
</script>
<?php

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
} else {
    $id = "0";
}
if (isset($_GET['Succ'])) {
    $Succ = $_GET['Succ'];
}

if (isset($_POST["save"])) {

    $username = $_POST["username"];
    $tel = $_POST["tel"];
    $mdp = $_POST["mdp"];
    $idprofil = $_POST["idprofil"];
    $mail = $_POST["mail"];
    $adresse = $_POST["adresse"];
    if ($id == "0") {
        $sql = "INSERT INTO `gestsells_users`(`username`,`tel`,`password`,`idprofil`,`mail`,`adresse`,`archive`) VALUES ('" . $username . "','" . $tel . "','" . $mdp . "','" . $idprofil . "','" . $mail . "','" . $adresse . "','0')";
        $req = mysqli_query($con, $sql);

        // ++ LOGS ++
        $dateheure = date('Y-m-d H:i:s');
        $iduser = $_SESSION["idutilisateur"];

        $sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`) VALUES ('" . $dateheure . "','" . $iduser . "','19','1','1')";
        $req = mysqli_query($con, $sql1);
    } else {
        $sql = "UPDATE `gestsells_users` SET `username`='" . $username . "' ,`tel`='" . $tel . "' ,`mdp`='" . $mdp . "' ,`idprofil`='" . $idprofil . "' ,`mail`='" . $mail . "' ,`adresse`='" . $adresse . "'";
    }
    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';
}
$profil = "";
$req = "select * from gestsells_profils where id=1";
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $profil = $enreg["profil"];
}
$username = "";
$gender = "";
$mail = "";
$mdp = "";
$adresse = "";
$tel = "";
$idprofil = "";
$req = "select * from gestsells_users where id=" . $id;
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $adresse = $enreg["adresse"];
    $username = $enreg["username"];
    $mail = $enreg["mail"];
    $tel = $enreg["tel"];
    $mdp = $enreg["password"];
    $idprofil = $enreg["idprofil"];
}
?>
<!-- /header-dashboard -->
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap"></div>
        <div class="themesflat-container full">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3></h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="dashboard.php">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Utilisateurs</div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="wg-box">
                        <h3>Gestion des Utilisateurs</h3>
                        <br> Utilisateur : <?php echo $_SESSION['user']; ?>
                        <?php if (isset($_GET['suc'])) { ?>
                            <?php if ($_GET['suc'] == '1') { ?>
                                <font color="green" style="background-color:#FFFFFF;">
                                    <center>Enregistrement effectué avec succès</center>
                                </font><br /><br />
                        <?php }
                        } ?>
                        <div class="row">
                            <div class="col-7 mb-20">
                                <form class="form-style-1" action="" method="POST">
                                    <div class="gap22 cols">
                                        <fieldset class="name mb-24">
                                            <div class="body-title">Nom<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow border-primary" type="text" value="<?php echo $username ?>"
                                                name="username" tabindex="0" aria-required="true" required="">
                                        </fieldset>
                                        <fieldset class="name mb-24">
                                            <div class="body-title">Tel<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow border-primary" type="text" value="<?php echo $tel ?>"
                                                name="tel" tabindex="0" aria-required="true" required="">
                                        </fieldset>
                                        <fieldset class="name mb-24">
                                            <div class="body-title">mot de passe<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow border-primary" type="text" value="<?php echo $mdp ?>"
                                                name="mdp" tabindex="0" aria-required="true" required="">
                                        </fieldset>
                                    </div>
                                    <div class="gap22 cols">
                                        <fieldset class="" category"">
                                            <div class="body-title mb-10">Profils <span class="tf-color-1">*</span></div>
                                            <div class="select ">
                                                <select class="border-primary" name="idprofil">
                                                    <option value=""> Sélectionner un profil </option>
                                                    <?php
                                                    $req = "select * from gestsells_profils order by profil";
                                                    $query = mysqli_query($con, $req);
                                                    while ($enreg = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?php echo $enreg['id']; ?>"
                                                            <?php if ($idprofil == $enreg['id']) { ?> selected <?php } ?>>
                                                            <?php echo $enreg['profil']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </fieldset>
                                        <fieldset class=" male">
                                            <div class="body-title mb-10">Gender <span class="tf-color-1">*</span>
                                            </div>
                                            <div class="select">
                                                <select class="border-primary">
                                                    <option value=""> Sélectionner un profil </option>
                                                    <?php
                                                    $req = "select * from gestsells_gender order by id";
                                                    $query = mysqli_query($con, $req);
                                                    while ($enreg = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?php echo $enreg['id']; ?>"
                                                            <?php if ($gender == $enreg['gender']) { ?> selected <?php } ?>>
                                                            <?php echo $enreg['gender']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">Mail<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $mail ?>"
                                            name="mail" tabindex="0" value="" aria-required="true" required="">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">Adresse<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $adresse ?>"
                                            name="adresse" tabindex="0" value="" aria-required="true" required="">
                                    </fieldset>
                                    <div class="bot">
                                        <div></div>
                                        <button class="tf-button w208">Save</button>
                                        <input class="form-control" type="hidden" name="save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">


                </div>
                <!-- all-roles -->
                <div class="wg-box">
                    <h3>List des utilisateurs</h3>
                    <div class="wg-table table-all-roles" style="overflow-x: visible !important;">
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">Nom</div>
                            </li>
                            <li>
                                <div class="body-title">Mail</div>
                            </li>
                            <li>
                                <div class="body-title">Adresse</div>
                            </li>
                            <li>
                                <div class="body-title">Tel</div>
                            </li>
                            <li>
                                <div class="body-title">Etat</div>
                            </li>
                            <li>
                                <div class="body-title">Permissions & Autorisations</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column">
                            <?php
                            $req = "select * from gestsells_users";
                            $query = mysqli_query($con, $req);
                            while ($enreg = mysqli_fetch_array($query)) {
                                $id = $enreg["id"];
                                $username = $enreg["username"];
                                $mail = $enreg["mail"];
                                $adresse = $enreg["adresse"];
                                $tel = $enreg["tel"];
                                $archive = $enreg["archive"];

                            ?>
                                <li class="roles-item">

                                    <div class="body-text"><?php echo $username ?></div>
                                    <div class="body-text"><?php echo $mail ?></div>
                                    <div class="body-text"><?php echo $adresse ?></div>
                                    <div class="body-text"><?php echo $tel ?></div>


                                    <?php
                                    if ($archive == 0) {
                                        echo '<div class="body-text" style="color : green">Actif</div>';
                                    } else {
                                        echo '<div class="body-text" style="color : red">Inactif</div>';
                                    }
                                    ?>
                                    <div class="body-text">
                                        <a href="autorisation_users.php?ID=<?php echo $id; ?>"><i class="icon-edit-3" style="; color : purple ; font-size : 15px"></i></a>
                                    </div>
                                    <div class="list-icon-function">
                                        <?php
                                        if ($archive == 0) { ?>
                                            <div class="item eye">
                                                <a href="Javascript:Archiver('<?php echo $id; ?>')"> <i style="font-size : 15px ; padding : 5px" class="icon-eye"
                                                        style="color : green !important"></i></a>

                                            </div>
                                        <?php } else { ?>
                                            <div class="item eye">
                                                <a href="Javascript:Unarchiver('<?php echo $id; ?>')"> <i style="font-size : 15px ; padding : 5px" class="icon-eye"
                                                        style="color : red !important"></i></a>

                                            </div>
                                        <?php } ?>
                                        <div class="item edit">
                                            <a href="utilisateurs.php?ID=<?php echo $id; ?>" style="font-size : 15px ; padding : 5px ; color : green" class="icon-edit-2"></a>
                                        </div>

                                        <div class="item">
                                            <a href="./page_js/supprimerutilisateurs.php?ID=<?php echo $id; ?>"><i
                                                    style="font-size : 15px ; padding : 5px ; color : red" class="icon-trash-2"></i></a>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include('./headers/footer.php') ?>