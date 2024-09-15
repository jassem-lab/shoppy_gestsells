<?php include('./headers/navbar.php') ?>
<script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimersize.php?ID=" + id;
        }
    }

    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archiversize.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchiversize.php?ID=" + id;
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

    $size = $_POST["size"];

    if ($id == "0") {
        $sql = "INSERT INTO `gestsells_size`(`size`,`archive`) VALUES ('" . $size . "','0')";
        $req = mysqli_query($con, $sql);

        // ++ LOGS ++
        $dateheure = date('Y-m-d H:i:s');
        $iduser = $_SESSION["idutilisateur"];

        $sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`) VALUES ('" . $dateheure . "','" . $iduser . "','19','1','8')";
        $req = mysqli_query($con, $sql1);
    }
    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';
} else {
    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href" </SCRIPT>';
}

$size = "";

$req = "select * from gestsells_size where id=" . $id;

while ($enreg = mysqli_fetch_array($query)) {
    $size = $enreg["size"];
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
                <h3>Liste des Tailles</h3>
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
                        <a href="size.php">
                            <div class="text-tiny">Tailles</div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="wg-box">
                        <h3>Gestion des Tailles</h3>
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
                                            <div class="body-title">Taille<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow border-primary" type="text" value="<?php echo $size ?>"
                                                name="size" tabindex="0" aria-required="true" required="">
                                        </fieldset>

                                    </div>
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

                <!-- all-roles -->
                <div class="wg-box">
                <h3>List des Tailles</h3>
                    <div class="wg-table table-all-roles" style="overflow-x: visible !important;">
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">Taille</div>
                            </li>

                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column">
                            <?php
                            $req = "select * from gestsells_size";
                            $query = mysqli_query($con, $req);
                            while ($enreg = mysqli_fetch_array($query)) {
                                $id = $enreg["id"];
                                $size = $enreg["size"];

                                $archive = $enreg["archive"];

                            ?>
                                <li class="roles-item">

                                    <div class="body-text"><?php echo $size ?></div>


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
                                                <a href="Javascript:Archiver('<?php echo $id; ?>')"> <i style="font-size : 15px ; padding : 5px" class="icon-eye"
                                                        style="color : green !important"></i></a>

                                            </div>
                                        <?php } else { ?>
                                            <div class="item eye">
                                                <a href="Javascript:Unarchiver('<?php echo $id; ?>')"> <i style="font-size : 15px ; padding : 5px" class="icon-eye"
                                                        style="color : red !important"></i></a>

                                            </div>
                                        <?php } ?>
                                        <div class="item">
                                            <a href="./page_js/supprimersize.php?ID=<?php echo $id; ?>"><i
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