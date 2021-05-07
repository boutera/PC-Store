<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("cartItems" => "", "isSuccess" => true, "isLogged" => false);
$idProduit = $quantite = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idProduit = test_input($_POST["id_product"]);
    if (isset($_SESSION['id_user'])) {
        $array["isLogged"] = true;
        
        $query = "SELECT quantite FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        $quantite = $row['quantite'];

        $query = "DELETE FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
        $result = mysqli_query($con, $query);

        $_SESSION['cartItems'] -= $quantite;
        $array["cartItems"] = $_SESSION['cartItems'];
    }
    else{

        $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);
        $quantite = $_SESSION['panier']['qteProduit'][$positionProduit];
        supprimerArticle($idProduit);
        $_SESSION['cartItems'] -= $quantite;
        $array["cartItems"] = $_SESSION['cartItems'];
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


