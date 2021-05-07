<?php

    include 'db.php';
    if(empty($_SESSION)) 
    {
        session_start();
    }
    
    $array = array("firstname" => "", "name" => "", "email" => "", "password" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "passwordError" => "", "isSuccess" => false, "isCart" => false);
    $name = $firstname = $email = $password = $isCart = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        $firstname = test_input($_POST["firstname"]);
        $array["firstname"] = $firstname;
        $name = test_input($_POST["name"]);
        $array["name"] = $name;
        $email = test_input($_POST["email"]);
        $array["email"] = $email;
        $password = test_input($_POST["password"]);
        $array["password"] = $password;
        $isCart = test_input($_POST["isCart2"]);
        $array["isCart"] = ($isCart == 1) ? true : false;
        $array["isSuccess"] = true; 
        
        if (empty($array["firstname"]))
        {
            $array["firstnameError"] = "Ce champs ne peut pas être vide";
            $array["isSuccess"] = false; 
        } 

        if (empty($array["name"]))
        {
            $array["nameError"] = "Ce champs ne peut pas être vide";
            $array["isSuccess"] = false; 
        } 

        if(!isEmail($array["email"])) 
        {
            $array["emailError"] = "Email invalide";
            $array["isSuccess"] = false; 
        } 


        if (empty($array["password"]))
        {
            $array["passwordError"] = "Ce champs ne peut pas être vide";
            $array["isSuccess"] = false; 
        }
        
        if($array["isSuccess"]) 
        {
            $query="SELECT * FROM client WHERE (nom = '$name' AND prenom = '$firstname') OR email = '$email'";
            $result=mysqli_query($con,$query) ;

            if(mysqli_num_rows($result)==0) {

                $query = "INSERT INTO client (nom,prenom,email,pass,dateCreation) VALUES('$name', '$firstname', '$email', '$password', now())";
                $result=mysqli_query($con,$query) ;


                $_SESSION['id_user']=$con->insert_id;
                $_SESSION['userName']=$name;
                $_SESSION['userFirstName']=$firstname;
                $_SESSION['email']=$email;
                $_SESSION['tel']=null;
                $_SESSION['img_path']=null;
                $_SESSION['cartItems'] = 0;
                $_SESSION["id_current_cmd"] = null;
                $_SESSION["wishItems"] = 0;

                if ($array["isCart"]) {

                    $query = "SELECT * FROM types_livraisons WHERE (id_type = " . $_SESSION["type_livr"] . ")";
                    $result2 = mysqli_query($con, $query);
                    $row2 = mysqli_fetch_assoc($result2);

                    $total = $_SESSION["montantGlobale"] + $row2['prix_livraison'];

                    $query = "INSERT INTO commande (idClient,date_cmd,total_cmd,id_typeLivraison) VALUES(" . $_SESSION['id_user'] . ", now(), '$total', " . $_SESSION['type_livr'] . ")";
                    $result = mysqli_query($con, $query);

                    $idCmd = $con->insert_id;
                  $_SESSION["id_current_cmd"] = $idCmd;

                    for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {

                        $query = "INSERT INTO commande_produits (idCommande,idProduit,quantite) VALUES('$idCmd', " . $_SESSION['panier']['idProduit'][$i] . ", " . $_SESSION['panier']['qteProduit'][$i] . ")";
                        $result2 = mysqli_query($con, $query);
                    }
                    unset($_SESSION['panier']);
                    $_SESSION["isPaying"] = true;

                }
                   
            }

            else  {

            $array["isSuccess"] = false;
            $array["emailError"] = "Ce compte existe déjà !";

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
 
?>


