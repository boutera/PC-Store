<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("isSuccess" => true);
$idProduit = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idProduit = test_input($_POST["id_product"]);

    $query = "INSERT INTO envie (idClient, idProduit) VALUES(" . $_SESSION['id_user'] . ", '$idProduit')";
    $result = mysqli_query($con, $query);


    $_SESSION['wishItems']++;
}

echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
