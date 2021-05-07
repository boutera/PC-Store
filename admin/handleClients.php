<?php

use PHPMailer\PHPMailer\PHPMailer;

include '../db.php';
require('PHPMailer-master/src/PHPMailer.php');
require('PHPMailer-master/src/SMTP.php');
require('PHPMailer-master/src/Exception.php');
if (empty($_SESSION)) {
    session_start();
}
$sql = "SELECT idClient,nom,prenom,email FROM client";
$result = mysqli_query($con, $sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Espace Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                </div>
                                <img width="42" class="rounded-circle" src="assets/images/avatars/avatar-admin.png" alt="">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $_SESSION["userName"] . ' ' . $_SESSION["userFirstName"] ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Général</li>
                            <li>
                                <a href="index.php">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Informations Générales
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Catégories</li>
                            <li>
                                <a href="addCategorie.php">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Ajouter une catégorie
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="handleCategories.php">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Gérer les catégories
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Produits</li>
                            <li>
                                <a href="addProduct.php">
                                    <i class="metismenu-icon pe-7s-eyedropper"></i>
                                    Ajouter un produit
                                </a>
                                <a href="handleProducts.php">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Gérer les produits
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Clients</li>
                            <li>
                                <a href="handleClients" class="mm-active">
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>Gérer les clients
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Commandes</li>
                            <li>
                                <a href="handleSells.php">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>Gérer les commandes
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Déconnexion</li>
                            <li>
                                <a href="../destroy.php">
                                    <i class="metismenu-icon pe-7s-power">
                                    </i>Se déconnecter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Gérer les clients
                                    <div class="page-title-subheading">Garder un oeil sur vos clients
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Espace Admin" data-placement="left" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Tous les clients</h5>
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Email</th>
                                                <th>Fidéliser</th>
                                                <th>Bannir</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <form action="handleClients.php" method="POST">
                                            <?php
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                    $idClient = $row['idClient'];
                                                    $sqlfid = "SELECT idClient FROM client_fidele WHERE idClient=$idClient";
                                                    $resultfid = mysqli_query($con, $sqlfid);
                                                    echo '
                                                    <tr>
                                                            <th scope="row">'.$row['idClient'].'</th>
                                                            <td>'.$row['nom'].'</td>
                                                            <td>'.$row['prenom'].'</td>
                                                            <td>'.$row['email'].'</td>';
                                                    if (mysqli_num_rows($resultfid) > 0){
                                                        echo '<th><button type="submit"  class="mb-2 mr-2 btn-transition btn btn-outline-success disabled" disabled><i class="pe-7s-check" aria-hidden="true"></i></button></th>';}
                                                    else {
                                                        echo '<th><button type="submit" name="fidC'.$row['idClient'].'"  class="mb-2 mr-2 btn-transition btn btn-outline-success"><i class="pe-7s-star" aria-hidden="true"></i></button></th>';
                                                    }
                                                        echo '<th><button type="submit" name="banC'.$row['idClient'].'"  class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="pe-7s-trash" aria-hidden="true"></i></button></th>
                                                            </tr>';
                                                    if(array_key_exists('banC'.$row['idClient'], $_POST)) { 
                                                        $delQuery = "DELETE FROM client WHERE idClient = $idClient";
                                                        $resDel = mysqli_query($con, $delQuery);
                                                        // Mail Code
                                                        require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
                                                        require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
                                                        require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';

                                                        // passing true in constructor enables exceptions in PHPMailer
                                                        $mail = new PHPMailer(true);

                                                        try {
                                                            $mail->isSMTP();
                                                            $mail->SMTPOptions = array(
                                                                'ssl' => array(
                                                                'verify_peer' => false,
                                                                'verify_peer_name' => false,
                                                                'allow_self_signed' => true
                                                                )
                                                                );
                                                            $mail->Host = 'smtp.gmail.com';
                                                            $mail->SMTPAuth = true;
                                                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                                            $mail->Port = 587;

                                                            $mail->Username = 'labnotifyer@gmail.com'; //gmail email
                                                            $mail->Password = 'labnotifyer1.0'; //gmail password

                                                            // Sender and recipient settings
                                                            $mail->setFrom('labnotifyer@gmail.com', 'FANABLO');
                                                            $mail->addAddress('zakariaziani99@gmail.com'); // replace with $row['email']
                                                            $mail->addReplyTo('labnotifyer@gmail.com', 'FANABLO'); // to set the reply to

                                                            // Setting the email content
                                                            $mail->IsHTML(true);
                                                            $mail->Subject = "Banned From FANABLO Online Store";
                                                            $mail->Body = 'Hello '.$row['nom'].'. <br><b>FANABLO</b><br>You have been banned from FANABLO.<br> This could happen due to many reasons.<br> If you think it was a mistake please contact support@fanablo.com.';
                                                            //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

                                                            $mail->send();
                                                            echo "Email message sent.";
                                                        } catch (Exception $e) {
                                                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                                                        }
                                                        ?>
                                                        <script>
                                                            location.reload(true);
                                                        </script>
                                                        <?php
                                                    }
                                                    if(array_key_exists('fidC'.$row['idClient'], $_POST)) { 
                                                            $insQuery = "INSERT INTO client_fidele (idClient) VALUES ($idClient);";
                                                            $resIns = mysqli_query($con, $insQuery);
                                                            // Mail Code
                                                            require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
                                                            require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
                                                            require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';
    
                                                            // passing true in constructor enables exceptions in PHPMailer
                                                            $mail = new PHPMailer(true);
    
                                                            try {
                                                                $mail->isSMTP();
                                                                $mail->SMTPOptions = array(
                                                                    'ssl' => array(
                                                                    'verify_peer' => false,
                                                                    'verify_peer_name' => false,
                                                                    'allow_self_signed' => true
                                                                    )
                                                                    );
                                                                $mail->Host = 'smtp.gmail.com';
                                                                $mail->SMTPAuth = true;
                                                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                                                $mail->Port = 587;
    
                                                                $mail->Username = 'labnotifyer@gmail.com'; //gmail email
                                                                $mail->Password = 'labnotifyer1.0'; //gmail password
    
                                                                // Sender and recipient settings
                                                                $mail->setFrom('labnotifyer@gmail.com', 'FANABLO');
                                                                $mail->addAddress('zakariaziani99@gmail.com'); // replace with $row['email']
                                                                $mail->addReplyTo('labnotifyer@gmail.com', 'FANABLO'); // to set the reply to
    
                                                                // Setting the email content
                                                                $mail->IsHTML(true);
                                                                $mail->Subject = "Congrats ! You are now a special client";
                                                                $mail->Body = 'Hello '.$row['nom'].'. <br><b>FANABLO</b> online store is happy to announce that you are now one of our special clients.<br>You will benefit from interesting offers and special coupons.';
                                                                //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    
                                                                $mail->send();
                                                            } catch (Exception $e) {
                                                                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                                                            }
                                                            echo "<meta http-equiv='refresh' content='0'>";
                                                    }
                                                    }
                                                ?>
                                                    
                                                
                                            </tbody>
                                        </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner">
                <div class="app-footer-right">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">
                                FANABLO
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>