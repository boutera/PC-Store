<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("isSuccess" => true, "isEmpty" => true);
$idType = $total = "";

$query = "SELECT * FROM types_livraisons WHERE (id_type = " . $_SESSION["type_livr"] . ")";
$result2 = mysqli_query($con, $query);
$row2 = mysqli_fetch_assoc($result2);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $idType = test_input($_POST["type_livr"]);
    $total = $_SESSION["montantGlobale"] + $row2['prix_livraison'];

    $query = "INSERT INTO commande (idClient,date_cmd,total_cmd,id_typeLivraison) VALUES(" . $_SESSION['id_user'] . ", now(), '$total', '$idType')";
    $result = mysqli_query($con, $query);

    $idCmd = $con->insert_id;

    $query = "SELECT * FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . ")";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){

        if($row['quantite'] > 0){
            $query = "INSERT INTO commande_produits (idCommande,idProduit,quantite) VALUES('$idCmd', " . $row['idProduit'] . ", " . $row['quantite'] . ")";
            $result2 = mysqli_query($con, $query);
            $array['isEmpty'] = false;
        }
    }

    $_SESSION["id_current_cmd"] = $idCmd;
    $_SESSION["isPaying"] = true;
}

echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
