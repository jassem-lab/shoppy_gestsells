<?php include('./headers/navbar.php') ?>
<?php
if (isset($_POST["save"])) {
    $rs = $_POST["rs"];
    $ms = $_POST["ms"];
    $mail = $_POST["mail"];
    $tel = $_POST["tel"];
    $adresse = $_POST["adresse"];
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"];
    $type1 = pathinfo(basename($_FILES["uploadfile"]["name"]), PATHINFO_EXTENSION);
    $file1 = md5($_FILES["uploadfile"]["name"] . time()) . "." . $type1;
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../assets/images/" . $file1;
    if ($type1 == "jpg" or $type1 == "JPG" or $type1 == "jpeg" or $type1 == "JPEG" or $type1 == "png" or $type1 == "PNG" or $type1 == "bmp" or $type1 == "BMP" or $type1 == "gif" or $type1 == "GIF") {
        echo $sql = "UPDATE `gestsells_soc`SET `rs`='" . $rs . "',`ms`='" . $ms . "',`mail`='" . $mail . "',`tel`='" . $tel . "',`adresse`='" . $adresse . "',`facebook`='" . $facebook . "',`instagram`='" . $instagram . "',`logo`='" . $file1 . "' WHERE id = 1 ";
    } else {
        echo $sql = "UPDATE `gestsells_soc`SET `rs`='" . $rs . "',`ms`='" . $ms . "',`mail`='" . $mail . "',`tel`='" . $tel . "',`adresse`='" . $adresse . "',`facebook`='" . $facebook . "',`instagram`='" . $instagram . "' WHERE id = 1 ";
    }
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }
    if (mysqli_query($con, $sql)) {
        echo ' <br/><div class="alert alert-custom alert-indicator-top indicator-success" role="alert">
        <div class="alert-content">
            <span class="alert-title">Success!</span>
            <span class="alert-text">Paramétrage de base est mis à jour...</span>
        </div>
    </div>';
    } else {
        echo ' <div class="alert alert-custom alert-indicator-bottom indicator-danger" role="alert">
        <div class="alert-content">
            <span class="alert-title">Failed!</span>
           
        </div>
    </div>' . mysqli_error($con);
    }


    // ++ LOGS ++
    $dateheure = date('Y-m-d H:i:s');
    $iduser = $_SESSION["idutilisateur"];

    $sql1 = "INSERT INTO `gestsells_logs`(`dateheure`, `idutilisateur`, `document`, `action`, `iddocument`) VALUES ('" . $dateheure . "','" . $iduser . "','22','2','1')";
    $req = mysqli_query($con, $sql1);

    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';
}
$rs = "";
$ms = "";
$mail = "";
$logo = "";
$adresse = "";
$tel = "";
$facebook = "";
$instagram = "";

$req = "select * from gestsells_soc where id=1";
$query = mysqli_query($con, $req);
while ($enreg = mysqli_fetch_array($query)) {
    $rs = $enreg["rs"];
    $ms = $enreg["ms"];
    $mail = $enreg["mail"];
    $logo = $enreg["logo"];
    $adresse = $enreg["adresse"];
    $tel = $enreg["tel"];
    $facebook = $enreg["facebook"];
    $instagram = $enreg["instagram"];
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
                        <h3>Gestion Société : </h3>
                        <br> Utilisateur : <?php echo $_SESSION['user']; ?>
                        <?php if (isset($_GET['suc'])) { ?>
                            <?php if ($_GET['suc'] == '1') { ?>
                                <font color="green" style="background-color:#FFFFFF;">
                                    <center>Enregistrement effectué avec succès</center>
                                </font><br /><br />
                        <?php }
                        } ?>
                        <div class="row">
                            <div class="col-6 mb-20">
                                <form class="form-style-1" action="" method="POST" enctype="multipart/form-data">
                                    <fieldset class="name mb-24">
                                        <div class="body-title">Raison Sociale<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $rs ?>" name="rs" tabindex="0"
                                            value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">Matricule Fiscale<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $ms ?>" name="ms" tabindex="0"
                                            value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">mail<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $mail ?>" name="mail"
                                            tabindex="0" value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">tel<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $tel ?>" name="tel" tabindex="0"
                                            value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">adresse<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $adresse ?>" name="adresse"
                                            tabindex="0" value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">facebook<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $facebook ?>" name="facebook"
                                            tabindex="0" value="" aria-required="true">
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title">instagram<span class="tf-color-1">*</span></div>
                                        <input class="flex-grow border-primary" type="text" value="<?php echo $instagram ?>" name="instagram"
                                            tabindex="0" value="" aria-required="true">
                                    </fieldset>
                                    <div class="upload-image">
                                        <div class="body-title">Logo<span class="tf-color-1">*</span></div>
                                        <div class="item">
                                            <img src="../assets/images/<?php echo $logo ?>" alt="">
                                        </div>
                                        <div class="item up-load">
                                            <label class="uploadfile" for="uploadfile">
                                                <span class="icon">
                                                    <i class="icon-upload-cloud"></i>
                                                </span>
                                                <span class="text-tiny">Drop your images here or select <span
                                                        class="tf-color">click to browse</span></span>
                                                <input type="file" id="uploadfile" name="uploadfile">
                                            </label>
                                        </div>
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
            </div>
        </div>
    </div>
</div>
</div>
<?php include('./headers/footer.php') ?>