<?php 
include 'db.php';
if (empty($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST["rate"];
    $review = $_POST["review"];
    $idClient = $_SESSION["id_user"];
    $idProduit = $_POST["idProd"];
    $sql = "INSERT INTO avis (idClient, idProduit, commentaire, evaluation) VALUES ('$idClient', '$idProduit', '$review', '$rating');";
    $result = mysqli_query($con, $sql);
}
header('Location: account.php',true,301);

?>