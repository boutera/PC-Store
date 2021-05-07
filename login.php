<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}

$array = array("email" => "", "password" => "", "emailError" => "", "passwordError" => "", "isSuccessClient" => false,"isSuccessAdmin" => false, "isCart" => false);
$email = $password = $isCart= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email2"]);
    $array["email"] = $email;
    $password = test_input($_POST["password2"]);
    $array["password"] = $password;
    $isCart = test_input($_POST["isCart"]);
    $array["isCart"] = ($isCart == 1) ? true : false;
    $array["isSuccessClient"] = true;
    $array["isSuccessAdmin"] = true;
    


    if (!isEmail($array["email"])) {
        $array["emailError"] = "Email invalide";
        $array["isSuccessClient"] = false;
        $array["isSuccessAdmin"] = false;
    }


    if (empty($array["password"])) {
        $array["passwordError"] = "Ce champs ne peut pas être vide";
        $array["isSuccessClient"] = false;
        $array["isSuccessAdmin"] = false;
    }

    if ($array["isSuccessAdmin"]) {
        $query = "SELECT * FROM admins WHERE (email = '$email' AND mdp = '$password')";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['id_user'] = $row['idAdmin'];
            $_SESSION['userName'] = $row['nom'];
            $_SESSION['userFirstName'] = $row['prenom'];
            $_SESSION['email'] = $row['email'];

            $array["isSuccessAdmin"] = true;

        } else {

            $array["isSuccessAdmin"] = false;
            $array["passwordError"] = "Login ou mot de passe invalide !";
        }
    }


    if ($array["isSuccessClient"] && !$array["isSuccessAdmin"]) {

        $query = "SELECT * FROM client WHERE (email = '$email' AND pass = '$password')";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['id_user'] = $row['idClient'];
            $_SESSION['userName'] = $row['nom'];
            $_SESSION['userFirstName'] = $row['prenom'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['tel'] = $row['tel'];
            $_SESSION['img_path'] = $row['img_user'];
            $_SESSION["id_current_cmd"] = null;

            $query = "SELECT SUM(quantite) AS total FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . ")";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row['total'] == null) {

                $_SESSION['cartItems'] = 0;
            } else {
                $_SESSION['cartItems'] = $row['total'];
            }

            $query = "SELECT * FROM envie WHERE (idClient = " . $_SESSION['id_user'] . ")";
            $result = mysqli_query($con, $query);
            $_SESSION["wishItems"] = mysqli_num_rows($result);
            


            if($array["isCart"]){

                $query = "SELECT * FROM types_livraisons WHERE (id_type = " . $_SESSION["type_livr"] . ")";
                $result2 = mysqli_query($con, $query);
                $row2 = mysqli_fetch_assoc($result2);

                $total = $_SESSION["montantGlobale"] + $row2['prix_livraison'];

                $query = "INSERT INTO commande (idClient,date_cmd,total_cmd,id_typeLivraison) VALUES(" . $_SESSION['id_user'] . ", now(), '$total', ". $_SESSION['type_livr'].")";
                $result = mysqli_query($con, $query);

                $idCmd = $con->insert_id;

                $_SESSION["id_current_cmd"] = $idCmd;

                for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {

                    $query = "INSERT INTO commande_produits (idCommande,idProduit,quantite) VALUES('$idCmd', " . $_SESSION['panier']['idProduit'][$i] . ", " . $_SESSION['panier']['qteProduit'][$i] . ")";
                    $result2 = mysqli_query($con, $query);
                }
                $_SESSION["isPaying"] = true;
                unset($_SESSION['panier']);
                

            }
        } else {

            $array["isSuccessClient"] = false;
            $array["passwordError"] = "Login ou mot de passe invalide !";
        }

    }

    echo json_encode($array);
}

function isEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
