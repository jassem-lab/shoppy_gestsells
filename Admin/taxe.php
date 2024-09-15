<?php include('./headers/navbar.php') ?>
<?php
if (isset($_POST["save"])) {
    $taxe = $_POST["taxe"];
    echo  $sql = "UPDATE `gestsells_parametres`SET `taxe`='" . $taxe . "' WHERE id = 1 ";
    $req = mysqli_query($con, $sql);

    // ++ LOGS ++
    $dateheure = date('Y-m-d H:i:s');
    $iduser = $_SESSION["idutilisateur"];

    $sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`) VALUES ('" . $dateheure . "','" . $iduser . "','24','2','1')";
    $req = mysqli_query($con, $sql1);

    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';
}
$taxe                =    "";
$req = "select * from gestsells_parametres where id=1";
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $taxe                =    $enreg["taxe"];
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
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="wg-box">
                        <h3>Taxes : </h3>
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
                                        <div class="body-title">Taxe<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $taxe ?>" name="taxe"
                                            tabindex="0" value="" aria-required="true" required="">
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
            </div>
        </div>
    </div>
</div>
</div>
<?php include('./headers/footer.php') ?>