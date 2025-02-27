<?php include('./headers/navbar.php') ?>
<?php
if (isset($_POST["save"])) {
    $productname = $_POST["productname"];
    $category = $_POST["category"];
    $gender = $_POST["gender"];
    $brand = $_POST["brand"];
    $description = $_POST["adresse"];
    $size = $_POST["size"];
    $productdate = $_POST["productdate"];
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
$idcategory = "";
$idgender = "";
$idsize1 = "";
$idsize2 = "";
$idsize3 = "";
$idbrand = "";

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

<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product">
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0" value="" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 20 characters when entering the product name.</div>
                    </fieldset>
                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                            <div class="select">
                                <select class="border-primary" name="category">
                                    <option value=""> Sélectionner une categorie </option>
                                    <?php
                                    $req = "select * from gestsells_category order by id";
                                    $query = mysqli_query($con, $req);
                                    while ($enreg = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $enreg['id']; ?>"
                                            <?php if ($idcategory == $enreg['id']) { ?> selected <?php } ?>>
                                            <?php echo $enreg['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="male">
                            <div class="body-title mb-10">Gender <span class="tf-color-1">*</span></div>
                            <div class="select">
                                <select class="border-primary" name="gender">
                                    <option value=""> Sélectionner un gender </option>
                                    <?php
                                    $req = "select * from gestsells_gender order by id";
                                    $query = mysqli_query($con, $req);
                                    while ($enreg = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $enreg['id']; ?>"
                                            <?php if ($idgender == $enreg['id']) { ?> selected <?php } ?>>
                                            <?php echo $enreg['gender']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="brand">
                        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                        <div class="select">
                            <select class="border-primary" name="brand">
                                <option value=""> Sélectionner une Brand </option>
                                <?php
                                $req = "select * from gestsells_brand order by id";
                                $query = mysqli_query($con, $req);
                                while ($enreg = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $enreg['id']; ?>"
                                        <?php if ($idbrand == $enreg['id']) { ?> selected <?php } ?>>
                                        <?php echo $enreg['brand']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true" required=""></textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title mb-10">Upload images</div>
                        <div class="upload-image mb-16">
                            <div class="item">
                                <img src="images/upload/upload-1.png" alt="">
                            </div>
                            <div class="item">
                                <img src="images/upload/upload-2.png" alt="">
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="filename">
                                </label>
                            </div>
                        </div>
                        <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details</div>
                    </fieldset>
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Ajouter les tailles</div>
                            <div class="d-flex justify-content-between">
                                <div class="select mb-10 ">
                                <select class="border-primary" name="size1">
                                    <option value=""> Sélectionner une taille </option>
                                    <?php
                                    $req = "select * from gestsells_size order by id";
                                    $query = mysqli_query($con, $req);
                                    while ($enreg = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $enreg['id']; ?>"
                                            <?php if ($idsize1 == $enreg['id']) { ?> selected <?php } ?>>
                                            <?php echo $enreg['size']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="mb-10">
                                <input type="text" name="q1" placeholder="quantité">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="select mb-10 ">
                                <select class="border-primary" name="size2">
                                    <option value=""> Sélectionner une taille </option>
                                    <?php
                                    $req = "select * from gestsells_size order by id";
                                    $query = mysqli_query($con, $req);
                                    while ($enreg = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $enreg['id']; ?>"
                                            <?php if ($idsize2 == $enreg['id']) { ?> selected <?php } ?>>
                                            <?php echo $enreg['size']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="mb-10">
                                <input type="text" name="q2" placeholder="quantité">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="select mb-10 ">
                                <select class="border-primary" name="size3">
                                    <option value=""> Sélectionner une taille </option>
                                    <?php
                                    $req = "select * from gestsells_size order by id";
                                    $query = mysqli_query($con, $req);
                                    while ($enreg = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $enreg['id']; ?>"
                                            <?php if ($idsize3 == $enreg['id']) { ?> selected <?php } ?>>
                                            <?php echo $enreg['size']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="mb-10">
                                <input type="text" name="q3" placeholder="quantité">
                                </div>
                            </div>
                            

                        </fieldset>

                    </div>
                    <fieldset class="name">
                        <div class="body-title mb-10">Product date</div>
                        <div class="select">
                            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </fieldset>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Add product</button>
                        <button class="tf-button style-1 w-full" type="submit">Save product</button>
                        <a href="#" class="tf-button style-2 w-full">Schedule</a>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <?php include('./headers/footer.php') ?>