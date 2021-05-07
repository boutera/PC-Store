<?php
    include 'db.php';
    if(empty($_SESSION)) 
    {
        session_start();
    }
unset($_SESSION["couponApplyed"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["isPaying"] = false;
        $phone=test_input($_POST["chPhone"]);
        $city=test_input($_POST["city"]);
        $country=test_input($_POST["country"]);
        $zcode=test_input($_POST["zcode"]);
        $addr=test_input($_POST["chAddr"]);
        $isCart = test_input($_POST["isCart"]);
        $isCart = ($isCart == 1) ? true : false;

        $cId = $_SESSION['id_user'];
        $csql = "SELECT idCommande FROM commande WHERE idClient='$cId' ORDER BY idCommande DESC LIMIT 1";
        $result = mysqli_query($con, $csql);
        $Crow = mysqli_fetch_array($result);
        $idComm = $Crow["idCommande"];
        $query = "INSERT INTO adresse (ville, pays, zipCode, details, idClient) VALUES ('$city', '$country', '$zcode', '$addr', '$cId')";
        $result=mysqli_query($con,$query) ;
        $_SESSION['tel']=$phone;
        $sqlq = "SELECT idAdresse FROM adresse WHERE idClient='$cId' ORDER BY idAdresse DESC LIMIT 1";
        $result = mysqli_query($con, $sqlq);
        $row = mysqli_fetch_array($result);
        $idAdr = $row["idAdresse"];
        $query = "INSERT INTO livraison (idCommande, statut_liv, date_liv, idAdresse) VALUES ('$idComm', 0, now(), '$idAdr')";
        $result=mysqli_query($con,$query) ;
    }

    $ID = $_SESSION['id_user'];
    $query = "SELECT idCommande FROM livraison ORDER BY idLivraison DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    $row1 = mysqli_fetch_array($result);
    $idCom = $row1["idCommande"];
    $query = "SELECT idProduit,quantite FROM commande_produits WHERE idCommande = $idCom";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $qtt = $row["quantite"];
        $idP = $row["idProduit"];
        $stockQ = "SELECT stock_vendu($idP, $qtt)";
        $resname = mysqli_query($con, $stockQ);
    }
    if(!$isCart){
        $viderQ = "SELECT vider_panier($cId)";
        $viderR = mysqli_query($con, $viderQ);
        $_SESSION['cartItems'] = 0;
    }

    $query = "DELETE FROM coupon WHERE (codeCoupon = ".$_SESSION['current_coupon'].")";
    $result = mysqli_query($con, $query);
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
header('Location: receipt/index.php',true,301);
error_log("WE MADE IT HERE SOMEHOW");
