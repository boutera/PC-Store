<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}

$array = array("isLogged" => true);

if (isset($_SESSION['id_user'])) {

    $query = "DELETE FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . ")";
    $result = mysqli_query($con, $query);
    $_SESSION['cartItems'] = 0;

}else{

    viderPanier();
    $_SESSION['cartItems'] = 0;
    $array["isLogged"] = false;
}

echo json_encode($array);


?>
