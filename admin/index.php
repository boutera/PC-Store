<?php
include '../db.php';
if (empty($_SESSION)) {
    session_start();
}
//! nombre des commandes
$sql = "SELECT count(idCommande) FROM commande";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nbrCommandes = $row[0];
//! nombre des clients
$sql = "SELECT count(idClient) FROM client";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nbrClients = $row[0];
//! somme des totales de commandes
$sql = "SELECT sum(total_cmd) FROM commande";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$totalCommandes = $row[0];
//! nombre de catégories
$sql = "SELECT count(idCategorie) FROM categorie";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nbrCategories = $row[0];
//! nombre des articles dans le stock
$sql = "SELECT sum(stock) FROM produit";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nbrArticles = $row[0];
//! nombre totale des ventes
$sql = "SELECT sum(vendu) FROM produit";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$vendu = $row[0];
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
                                <a href="index.html" class="mm-active">
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
                                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Tableau de bord
                                    <div class="page-title-subheading">Gérer les client, les commandes et le contenu de votre site.
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Espace Admin" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Commandes</div>
                                        <div class="widget-subheading">2021</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $nbrCommandes; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Profits</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $totalCommandes; ?> MAD</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Client</div>
                                        <div class="widget-subheading">nombre total des clients</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $nbrClients; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header-tab-animation card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                        Clients fidèles
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tabs-eg-77">
                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">Achats des clients fidèles</h6>
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                                        <?php
                                                        $query = "SELECT idClient FROM client_fidele";
                                                        $result = mysqli_query($con, $query);
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                            $idc = $row['idClient'];
                                                            $sql1 = "SELECT nom, prenom, email FROM client WHERE idClient = $idc";
                                                            $res1 = mysqli_query($con, $sql1);
                                                            $tab1 = mysqli_fetch_array($res1);
                                                            $prenom = $tab1['prenom'];
                                                            $nom = $tab1['nom'];
                                                            $email = $tab1['email'];

                                                            $sql2 = "SELECT SUM(total_cmd) FROM commande WHERE idClient = $idc";
                                                            $res2 = mysqli_query($con, $sql2);
                                                            $tab2 = mysqli_fetch_array($res2);
                                                            $achat = $tab2[0];
                                                            echo '
                                                                    <li class="list-group-item">
                                                                    <div class="widget-content p-0">
                                                                        <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/avatar-client.png" alt="">
                                                                        </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading">' . $nom . ' ' . $prenom . '</div>
                                                                            <div class="widget-subheading">' . $email . '</div>
                                                                    </div>
                                                                    <div class="widget-content-right">
                                                                        <div class="font-size-xlg text-muted">
                                                                            <span>' . $achat . '</span>
                                                                            <small class="opacity-5 pr-1">MAD</small>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </li>
                                                                    ';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                        Transactions mensuelles
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-eg-55">
                                        <div class="widget-chart p-3">
                                            <div style="height: 350px">
                                                <canvas id="line-chart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Catégories</div>
                                            <div class="widget-subheading">Nombre des catégories et sous-catégories</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"><?php echo $nbrCategories; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Produits</div>
                                            <div class="widget-subheading">nombre total des produits</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning"><?php echo $nbrArticles; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Ventes</div>
                                            <div class="widget-subheading">Pourcentage des ventes</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger"><?php echo number_format(($vendu * 100) / ($vendu + $nbrArticles), 2, '.', ''); ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Commandes Actives
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th class="text-center">City</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //! id nom prenom email et ville des clients qui ont des commandes actives
                                            $cmdQuery = "SELECT idClient,idCommande FROM commande";
                                            $result = mysqli_query($con, $cmdQuery);
                                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                //! id client
                                                $idc = $row['idClient'];
                                                $idcmd = $row['idCommande'];
                                                $infoQuery = "SELECT nom, prenom, email from client WHERE idClient = $idc";
                                                $res1 = mysqli_query($con, $infoQuery);
                                                $tab1 = mysqli_fetch_array($res1);
                                                //! nom prenom email
                                                $nom = $tab1['nom'];
                                                $prenom = $tab1['prenom'];
                                                $email = $tab1['email'];
                                                $adrQuery = "SELECT idAdresse,statut_liv FROM livraison WHERE idCommande = $idcmd";
                                                $res2 = mysqli_query($con, $adrQuery);
                                                $tab2 = mysqli_fetch_array($res2);
                                                $idAdr = $tab2['idAdresse'];
                                                // ! statut livraison
                                                $statutLiv = $tab2['statut_liv'];
                                                $adrQuery1 = "SELECT ville FROM adresse WHERE idAdresse = $idAdr";
                                                $res3 = mysqli_query($con, $adrQuery1);
                                                $tab3 = mysqli_fetch_array($res3);
                                                //! ville
                                                $city = $tab3['ville'];
                                                echo '
                                                    <tr>
                                                        <td class="text-center text-muted">#' . $idc . '</td>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" class="rounded-circle" src="assets/images/avatars/avatar-client.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">' . $nom . ' ' . $prenom . '</div>
                                                                        <div class="widget-subheading opacity-7">' . $email . '</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">' . $city . '</td>
                                                        <td class="text-center">';
                                                if ($statutLiv == 0) {
                                                    echo '<div class="badge badge-warning">Pending</div>';
                                                }
                                                // livraison complet
                                                elseif ($statutLiv == 1) {
                                                    echo '<div class="badge badge-success">Completed</div>';
                                                } elseif ($statutLiv == 2) {
                                                    echo '<div class="badge badge-danger">In Progress</div>';
                                                }

                                                echo '
                                                        </td>
                                                    </tr>';
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>
        <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

</html>