<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}

$array = array("firstName" => "", "lastName" => "", "email" => "", "emailError" => "", "tel"=> "", "telError" => "", "isSuccess" => false);
$prenom = $nom = $email = $tel = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = test_input($_POST["firstName"]);
    $array["firstName"] = $prenom;

    $nom = test_input($_POST["lastName"]);
    $array["lastName"] = $nom;

    $email = test_input($_POST["email"]);
    $array["email"] = $email;

    $tel = test_input($_POST["tel"]);
    $array["tel"] = $tel;

    $array["isSuccess"] = true;



    if (!isEmail($array["email"])) {
        $array["emailError"] = "Email invalide";
        $array["isSuccess"] = false;
    }

    if ($array["isSuccess"]) {
        $query = "UPDATE client SET nom='$nom', prenom='$prenom', email='$email', tel='$tel' WHERE (idClient = ".$_SESSION['id_user'].")";
        $result = mysqli_query($con, $query);

            $_SESSION['userName'] = $nom;
            $_SESSION['userFirstName'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['tel'] = $tel;

        
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


