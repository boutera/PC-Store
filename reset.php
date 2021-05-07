<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}

    $array = array("isSuccess" => true);
    $idCmd = $_SESSION["id_current_cmd"];

    $query = "DELETE FROM commande WHERE (idCommande = '$idCmd')";
    $result = mysqli_query($con, $query);

    $query = "DELETE FROM commande_produits WHERE (idCommande = '$idCmd')";
    $result = mysqli_query($con, $query);

    unset($_SESSION["id_current_cmd"]);


echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
