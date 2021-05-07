<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "ecommerce2");
    
    
    include ('functions.php');

    $isSuccess = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        $name = test_input($_POST["name"]);
        $email= $_POST["email"];
        $comment=$_POST["textarea"];
  
        $isSuccess = true; 
        
        
        if($isSuccess) 
        {
            $result = mysqli_query($db, "INSERT INTO avis (idClient,idProduit,commentaire,evaluation) values('2','6', '$comment','2')" );

        }
        
        
    }


    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>