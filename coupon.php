<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}
$array = array("isSuccess" => false, "totalFinal" => "", "couponApplyed" => false);
$code = "";

if ($_SESSION["couponApplyed"] == true) {
    $array["couponApplyed"] = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["couponApplyed"] == false ) {

    $sql = "SELECT total_cmd,idCommande FROM commande WHERE idClient=".$_SESSION["id_user"]." ORDER BY idCommande DESC LIMIT 1";
    $result2 = mysqli_query($con, $sql);
    $row2 = mysqli_fetch_array($result2);
    $array["totalFinal"] = $row2['total_cmd'];
    

    $code = test_input($_POST["code"]);

    $query = "SELECT * FROM coupon WHERE (codeCoupon = '$code')";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $today = date("Y-m-d");
        $expire = $row['date_expiration'];

        $today_time = strtotime($today);
        $expire_time = strtotime($expire);

        if ($today_time < $expire_time){
            $array["totalFinal"] = $array["totalFinal"]* (1 - $row['valeur']/100);
            $_SESSION["couponApplyed"] = true;
            $array["isSuccess"] = true;

            $total = $array["totalFinal"];
            $idCmd = $_SESSION["id_current_cmd"];

            $query = "UPDATE commande SET total_cmd = '$total' WHERE (idClient = " . $_SESSION['id_user'] . " AND idCommande = '$idCmd')";
            $result = mysqli_query($con, $query);

            $_SESSION["current_coupon"] = $code;
            
        }
    }
}

echo json_encode($array);



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
