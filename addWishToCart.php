<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("cartItems" => "", "isSuccess" => true, "wishItems" => "");
$idProduit = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idProduit = test_input($_POST["id_product"]);

    $query = "SELECT idProduit FROM panier_produits  WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if($row == null){
        $query = "INSERT INTO panier_produits (idClient,idProduit,quantite) VALUES(" . $_SESSION['id_user'] . ", '$idProduit', 1)";
        $result = mysqli_query($con, $query);
        $_SESSION['cartItems'] += 1;
        $array["cartItems"] = $_SESSION['cartItems'];

    }
    else{
        $array["cartItems"] = $_SESSION['cartItems'];
    }
    
    $_SESSION['wishItems'] -= 1;
    $array["wishItems"] = $_SESSION['wishItems'];

    $query = "DELETE FROM envie WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = '$idProduit')";
    $result = mysqli_query($con, $query);
}

echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
