<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("idProduit" => "", "quantite" => "", "cartItems" => "", "isSuccess" => true);
$idProduit = $quantite = $newQuantity ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduit = test_input($_POST["id_product"]);
    $array["idProduit"] = $idProduit;
    $quantite = test_input($_POST["qtybutton"]);
    $array["quantite"] = $quantite;

    $query = "SELECT * FROM produit WHERE (idProduit = '$idProduit')";
    $result = mysqli_query($con, $query);
    $rowProduct = mysqli_fetch_assoc($result);

    if ($quantite > $rowProduct['stock']) {
        $array["isSuccess"] = false;
    } else {
        if (isset($_SESSION['id_user'])) {
            $query = "SELECT * FROM panier_produits  WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result)==0) {

                $query = "INSERT INTO panier_produits (idClient,idProduit,quantite) VALUES(" . $_SESSION['id_user'] . ", '$idProduit', '$quantite')";
                $result = mysqli_query($con, $query);
                $_SESSION['cartItems']+= $quantite;
                $array["cartItems"] = $_SESSION['cartItems'];
            } else {
                $row = mysqli_fetch_assoc($result);
                $newQuantity = $row['quantite'] + $quantite;
                if($newQuantity > $rowProduct['stock']){
                    $array["isSuccess"] = false;
                }
                else{
                    $query = "UPDATE panier_produits SET quantite = '$newQuantity' WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
                    $result = mysqli_query($con, $query);
                    $_SESSION['cartItems']+= $quantite;
                    $array["cartItems"] = $_SESSION['cartItems'];
                }
                
            }
        } else {

            creationPanier();
            $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);
            if($positionProduit === false){

                ajouterArticle($idProduit, $rowProduct['nom_prod'], $quantite, $rowProduct['prix']);
                $array["cartItems"] = $_SESSION['cartItems'];

            }
            else{
                $newQuantity = $_SESSION['panier']['qteProduit'][$positionProduit] + $quantite;

                if ($newQuantity > $rowProduct['stock']) {
                    $array["isSuccess"] = false;
                }

                else{
                    ajouterArticle($idProduit, $rowProduct['nom_prod'], $quantite, $rowProduct['prix']);
                    $array["cartItems"] = $_SESSION['cartItems'];
                }
            }    
        }
    }
}

echo json_encode($array);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
