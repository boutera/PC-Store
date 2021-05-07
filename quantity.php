<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("idProduit" => "", "quantite" => "", "total" => "", "cartItems" => "", "stock" => "", "isSuccess" => true, "global" => "", "global2" => "");
$idProduit = $quantite = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduit = test_input($_POST["id_product"]);
    $array["idProduit"] = $idProduit;
    $quantite = test_input($_POST["quantity"]);
    $array["quantite"] = $quantite;

    $query = "SELECT * FROM produit WHERE (idProduit = '$idProduit')";
    $result = mysqli_query($con, $query);
    $rowProduct = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM types_livraisons WHERE (id_type = " . $_SESSION["type_livr"] . ")";
    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result2);

    $array["stock"] = $rowProduct['stock'];

    if($quantite > $rowProduct['stock'] OR $quantite<=0){
        $array["isSuccess"] = false;
    }

    else{
        if (isset($_SESSION['id_user'])) {
            $query = "SELECT quantite FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            $_SESSION['cartItems'] += $quantite - $row['quantite'];
            $array["cartItems"] = $_SESSION['cartItems'];
            $_SESSION["montantGlobale"] += ($quantite - $row['quantite'])*($rowProduct['prix'] * (1 - $rowProduct['promo'] / 100));
            $array["global"] = $_SESSION["montantGlobale"];


            $query = "UPDATE panier_produits SET quantite = '$quantite' WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
            $result = mysqli_query($con, $query);
            $array["total"] = $quantite * $rowProduct['prix'] * (1 - $rowProduct['promo'] / 100);


            $array["global2"] = $array["global"] + $row2['prix_livraison'];


            
        }
        
        else{

            $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);
            $oldQuantity = $_SESSION['panier']['qteProduit'][$positionProduit];
            $_SESSION["montantGlobale"] += ($quantite - $oldQuantity) * ($rowProduct['prix'] * (1 - $rowProduct['promo'] / 100));
            $array["global"] = $_SESSION["montantGlobale"];
            $array["global2"] = $array["global"] + $row2['prix_livraison'];

            modifierQTeArticle($idProduit, $quantite);
            $array["cartItems"] = $_SESSION['cartItems'];
            $array["total"] = $quantite * $rowProduct['prix'] * (1 - $rowProduct['promo'] / 100);
            
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
