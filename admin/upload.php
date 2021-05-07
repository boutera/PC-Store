<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomProduit = $_POST['nomProd'];
    $prixProduit = $_POST['prixProd'];
    $stockProduit = $_POST['stockProd'];
    $promoProduit = $_POST['promo'];
    $descrProduit = $_POST['descrProd'];
    $catProduit = $_POST['selectCat'];
    $pathImageProduit = basename($_FILES["file"]["name"]);
    $addQuery = "INSERT INTO produit (nom_prod, desp_prod, prix, img_prod, promo, stock, idCategorie, vendu) VALUES ('$nomProduit', '$descrProduit', '$prixProduit',  '$pathImageProduit', '$promoProduit', '$stockProduit', '$catProduit', '0')";
    $result = mysqli_query($con, $addQuery);
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Real image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    //! $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
}


// file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
//! $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // upload file
  } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
  header('Location: index.php',true,301);
?>