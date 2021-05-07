<?php

include 'db.php';
include 'functions.php';
if (empty($_SESSION)) {
    session_start();
}

$array = array("isSuccess" => true);


    $query = "DELETE FROM envie WHERE (idClient = " . $_SESSION['id_user'] . ")";
    $result = mysqli_query($con, $query);
    $_SESSION['wishItems'] = 0;



echo json_encode($array);
