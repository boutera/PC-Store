<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("total" => "");
$idType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idType = test_input($_POST["type_livraison"]);

    $_SESSION["type_livr"] = $idType;

    $query = "SELECT * FROM types_livraisons WHERE (id_type = '$idType')";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $array["total"] = $_SESSION["montantGlobale"]+ $row['prix_livraison'];

}

echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
