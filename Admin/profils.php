<?php include('./headers/navbar.php') ?>
<script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerprofil.php?ID=" + id;
        }
    }

    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archiverprofil.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchiverprofil.php?ID=" + id;
        }
    }
</script>
<?php
if (isset($_POST["save"])) {
    $profil = $_POST["profil"];
    echo $sql = "INSERT INTO `gestsells_profils`(`profil`) VALUES ('$profil')";
    $req = mysqli_query($con, $sql);

    // ++ LOGS ++
    $dateheure = date('Y-m-d H:i:s');
    $iduser = $_SESSION["idutilisateur"];

    $sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`) VALUES ('" . $dateheure . "','" . $iduser . "','21','1','1')";
    $req = mysqli_query($con, $sql1);

    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';
}
$profil = "";
$req = "select * from gestsells_profils where id=1";
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $profil = $enreg["profil"];
}

?>
<!-- /header-dashboard -->
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3></h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.php">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Ecommerce</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add Profil</div>
                    </li>
                </ul>
            </div>
            <!-- main-content-wrap -->
            <div class="main-content-wrap"></div>
            <div class="themesflat-container full">
                <div class="row">
                    <div class="col-12 mb-20">
                        <div class="wg-box">
                            <h3>Gestion des profils</h3>
                            <br> Utilisateur : <?php echo $_SESSION['user']; ?>
                            <?php if (isset($_GET['suc'])) { ?>
                                <?php if ($_GET['suc'] == '1') { ?>
                                    <font color="green" style="background-color:#FFFFFF;">
                                        <center>Enregistrement effectué avec succès</center>
                                    </font><br /><br />
                            <?php }
                            } ?>
                            <div class="row">
                                <div class="col-3 mb-20">
                                    <form class="form-style-1" action="" method="POST">
                                        <fieldset class="name mb-24">
                                            <div class="body-title">Profil<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow border-primary" type="text" value="<?php echo $profil ?>"
                                                name="profil" tabindex="0" value="" aria-required="true" required="">
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
                    <h3>Liste des profils</h3>
                        <div class="wg-table table-all-roles" style="overflow-x: visible !important;">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title">Name</div>
                                </li>
                                <li>
                                    <div class="body-title"></div>
                                </li>
                                <li>
                                    <div class="body-title">Etat</div>
                                </li>

                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column">
                                <?php
                                $req = "select * from gestsells_profils";
                                $query = mysqli_query($con, $req);
                                while ($enreg = mysqli_fetch_array($query)) {
                                    $id = $enreg["id"];
                                    $profil = $enreg["profil"];
                                    $archive = $enreg["archive"];

                                ?>
                                    <li class="roles-item">

                                        <div class="body-text"><?php echo $profil ?></div>
                                        <div class="body-text"></div>
                                        <?php
                                        if ($archive == 0) {
                                            echo '<div class="body-text" style="color : green">Actif</div>';
                                        } else {
                                            echo '<div class="body-text" style="color : red">Inactif</div>';
                                        }
                                        ?>
                                        <div class="list-icon-function">
                                            <?php
                                            if ($archive == 0) { ?>
                                                <div class="item eye">
                                                    <a href="Javascript:Archiver('<?php echo $id; ?>')"> <i class="icon-eye"
                                                            style="color : green !important"></i></a>

                                                </div>
                                            <?php } else { ?>
                                                <div class="item eye">
                                                    <a href="Javascript:Unarchiver('<?php echo $id; ?>')"> <i class="icon-eye"
                                                            style="color : red !important"></i></a>

                                                </div>
                                            <?php } ?>
                                            <div class="item edit">
                                                <i href="autorisation_users.php?ID=<?php echo $id; ?>" class="icon-edit-3"></i>
                                            </div>
                                            <div class="item">
                                                <a href="./page_js/supprimerprofil.php?ID=<?php echo $id; ?>"><i
                                                        class="icon-trash-2"></i></a>
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
    </div>

    <?php include('./headers/footer.php') ?>