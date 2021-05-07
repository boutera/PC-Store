<?php
    include '../db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["nomCat"])){
            $nomCat = $_POST["nomCat"];
            $query = "INSERT INTO categorie (desp_cat, idCat_parente) VALUES ('$nomCat',0)";
            $result=mysqli_query($con,$query) ;
        }
        if (isset($_POST["nomSCat"])){
            $nomCat = $_POST["nomSCat"];
            $idSCat = $_POST["selectCat"];
            $query = "INSERT INTO categorie (desp_cat, idCat_parente) VALUES ('$nomCat','$idSCat')";
            $result=mysqli_query($con,$query) ;
        }
        
        

    }
header('Location: index.php',true,301);
?>