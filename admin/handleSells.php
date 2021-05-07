<?php
include '../db.php';
if (empty($_SESSION)) {
    session_start();
}
$sql = "SELECT idCategorie,desp_cat,idCat_parente FROM categorie";
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
                                <a href="handleClients.php">
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>Gérer les clients
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Commandes</li>
                            <li>
                                <a href="handleSells.php" class="mm-active">
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
                                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Gérer les commandes
                                    <div class="page-title-subheading">Gardez un œil
                                        sur les commandes actives
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
                                
                                    <div class="card-body"><h5 class="card-title">Tous les commandes</h5>
                                    <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th class="text-center">City</th>
                                                <th class="text-center">Total (MAD)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Changer le status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                //! id nom prenom email et ville des clients qui ont des commandes actives
                                                $cmdQuery = "SELECT idClient,idCommande,total_cmd FROM commande";
                                                $result = mysqli_query($con, $cmdQuery);
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                    //! id client
                                                    $idc = $row['idClient'];
                                                    $idcmd = $row['idCommande'];
                                                    $totalcmd = $row['total_cmd'];
                                                    $infoQuery = "SELECT nom, prenom, email from client WHERE idClient = $idc";
                                                    $res1 = mysqli_query($con, $infoQuery);
                                                    $tab1 = mysqli_fetch_array($res1);
                                                    //! nom prenom email
                                                    $nom = $tab1['nom'];
                                                    $prenom = $tab1['prenom'];
                                                    $email = $tab1['email'];
                                                    $adrQuery = "SELECT idAdresse,statut_liv FROM livraison WHERE idCommande = $idcmd";
                                                    $res2 = mysqli_query($con,$adrQuery);
                                                    $tab2 = mysqli_fetch_array($res2);
                                                    $idAdr = $tab2['idAdresse'];
                                                    // ! statut livraison
                                                    $statutLiv = $tab2['statut_liv'];
                                                    $adrQuery1 = "SELECT ville FROM adresse WHERE idAdresse = $idAdr";
                                                    $res3 = mysqli_query($con,$adrQuery1);
                                                    $tab3 = mysqli_fetch_array($res3);
                                                    //! ville
                                                    $city = $tab3['ville'];
                                                    echo '
                                                    <tr>
                                                        <td class="text-center text-muted">#'.$idc.'</td>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" class="rounded-circle" src="assets/images/avatars/avatar-client.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">'.$nom.' '.$prenom.'</div>
                                                                        <div class="widget-subheading opacity-7">'.$email.'</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">'.$city.'</td>
                                                        <td class="text-center">'.$totalcmd.'</td>
                                                        <td class="text-center">';
                                                    if ($statutLiv == 0) {
                                                        echo '<div class="badge badge-warning">Pending</div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div role="group" class="btn-group-sm btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-outline-warning active">
                                                                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                                                Pending
                                                            </label>
                                                            <label class="btn btn-outline-danger">
                                                                <input type="radio" name="options" id="option2" autocomplete="off">
                                                                In Progress
                                                            </label>
                                                            <label class="btn btn-outline-success">
                                                                <input type="radio" name="options" id="option3" autocomplete="off">
                                                                Completed
                                                            </label>
                                                            </div>
                                                        </td>
                                                        ';
                                                    }
                                                    // livraison complet
                                                    elseif ($statutLiv == 1) {
                                                        echo '<div class="badge badge-success">Completed</div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div role="group" class="btn-group-sm btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-outline-warning">
                                                                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                                                Pending
                                                            </label>
                                                            <label class="btn btn-outline-danger">
                                                                <input type="radio" name="options" id="option2" autocomplete="off">
                                                                In Progress
                                                            </label>
                                                            <label class="btn btn-outline-success active">
                                                                <input type="radio" name="options" id="option3" autocomplete="off" >
                                                                Completed
                                                            </label>
                                                            </div>
                                                        </td>
                                                        ';
                                                    }
                                                    elseif ($statutLiv == 2) {
                                                        echo '<div class="badge badge-danger">In Progress</div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div role="group" class="btn-group-sm btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-outline-warning">
                                                                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                                                Pending
                                                            </label>
                                                            <label class="btn btn-outline-danger active">
                                                                <input type="radio" name="options" id="option2" autocomplete="off">
                                                                In Progress
                                                            </label>
                                                            <label class="btn btn-outline-success">
                                                                <input type="radio" name="options" id="option3" autocomplete="off">
                                                                Completed
                                                            </label>
                                                            </div>
                                                        </td>
                                                        ';
                                                    }
                                                            
                                                    echo '</tr>';
                                                }
                                                
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
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