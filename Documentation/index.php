<?php
if (empty($_SESSION)) {
    session_start();
}
include 'db.php';
include('functions.php');
if (!isset($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = 0;
}
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ehtpStore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->



    <link rel="stylesheet" href="css/shortcode/shortcodes.css">

    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
     <script src="js/recipe2.js"></script>
    <link rel="stylesheet" href="css/recipe2.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>

     <?php 
    if(isset($_SESSION["id_user"])){
      $query_n = mysqli_query($con, "SELECT * from panier_produits join produit on produit.idProduit=panier_produits.idProduit where idClient= " . $_SESSION["id_user"] . " ");
          $num_Line = mysqli_num_rows($query_n);
           if($num_Line>2){?>
        <script src="js/recipe2.js" type="text/javascript"></script>
  <?php  }
    }
    ?>
    <script>
        /*
const options = {
  bottom: '-300px', // default: '32px'
  right: '600px', // default: '32px'
  left: 'unset', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#fff', // default: '#fff'
  saveInCookies: false, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}
 function addDarkmodeWidget() {
 	const darkmode = new Darkmode(options);
    new Darkmode().showWidget();
  }


window.addEventListener('load', addDarkmodeWidget);*/
      
    </script>

    <style>
       
      
    </style>

</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="images/logo/logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="index.php">Accueil</a></li>

                                    <li class="drop"><a href="shop.php">Nos produits</a>
                                    </li>
                                    <li><a href="help.php">Aide</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                    <?php if (isset($_SESSION["id_user"])) echo '<li><a href="destroy.php">Déconnexion</a></li>'; ?>
                                    <!-- End Single Mega MEnu -->
                                    <!-- Start Single Mega MEnu -->
                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="index.php">Accueil</a></li>
                                        <li><a href="shop.php">Nos produits</a></li>
                                        <li><a href="help.php">Aide</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                        <?php if (isset($_SESSION["id_user"])) echo '<li><a href="destroy.php">Déconnexion</a></li>'; ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-2 col-sm-4 col-xs-3">
                            <ul class="menu-extra">
                                <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                                <li><a href="login-register.php"><span class="ti-user"><?php if (isset($_SESSION["id_user"])) echo 'Connecté';
                                                                                        else echo 'Connexion'; ?></span></a></li>

                                <?php if (isset($_SESSION["id_user"]))
                                    echo '<li class="cart__menu"><span class="ti-shopping-cart"></span><span class="cart-counter">' . $_SESSION["cartItems"] . '</span></li>';
                                else
                                    echo '<li class="cart__menu"><a href="cart_logged_out.php"><span class="ti-shopping-cart"></span><span class="cart-counter">' . $_SESSION["cartItems"] . '</span></a></li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form autocomplete="off" id="easysearch" role="search" method="POST" action="search.php">
                                    <input  name="keyword" id="myInput"   type="text"  aria-label="Search" style="font-size: 20px;" >
                                    <button type="submit" id="search" name="search"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close" style="color:black;"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php   
              $arr=array();

              $arr2 = array();
                    $query = "SELECT * FROM produit ";
                    $result = mysqli_query ($con,$query)or die(mysqli_error($con));
                    if(mysqli_num_rows($result) > 0) 
                    {   
                        while($row = mysqli_fetch_assoc($result)) 
                        { $arr[]=$row['nom_prod'];
                          $arr2[] = $row["idProduit"];
                           $path="images/".$row['img_prod']."";
                           $arrimage[]=$path;
                       }}
                   
                             
              ?>
            
            <!-- End Search Popap -->

            <!-- Start Cart Panel -->
            <?php if (isset($_SESSION["id_user"])) {
                echo
                    '<div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">';
                        
                $total_prix = 0;
                $query = mysqli_query($con, "SELECT * from panier_produits join produit on produit.idProduit=panier_produits.idProduit where idClient= " . $_SESSION["id_user"] . " ");
                $num_Line = mysqli_num_rows($query);
                if($num_Line==0) echo ' <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title"></h2>
                                <nav class="bradcaump-inner">
                                    <span class="breadcrumb-item active">Votre panier est vide !</span>
                                    <a class="continuer" href="index.php">Continuer vos achats</a>                                    
                                </nav>
                            </div>';
                echo '<ul id="ticker">';
                while ($rowp = mysqli_fetch_array($query)) {
                    $image = $rowp["img_prod"];
                    $prix = $rowp['prix'] * (1 - $rowp['promo'] / 100);
                    $total_prix += $prix * $rowp['quantite'];
                    echo '
                    	    <li> <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="product-details.php?idprod='.$rowp['idProduit'].'">
                                    <img src="images/' . $image . '" alt="product images" style="width:265px;Height:67px;">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.php?idprod='.$rowp['idProduit'].'" style="text-transform: uppercase;">' . $rowp['nom_prod'] . '</a></h2>
                                <span class="quantity">Quantité: ' . $rowp['quantite'] . '</span>
                                <span class="shp__price">Prix unitaire : ' . $prix . ' DH</span>
                            </div>
                           
                        </div></li>';
                }

                echo '</ul>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Sous-total:</li>
                        <li class="total__price">' . $total_prix . ' DH</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart_logged_in.php">Voir mon panier</a></li>
                    </ul>
                </div>
            </div>';
            } ?>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Feature Product -->
        <section class="categories-slider-area bg__white">
            <div class="container">
                <div class="row">
                    <!-- Start Left Feature -->
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                        <!-- Start Slider Area -->
                        <div class="slider__container slider--one">
                            <div class="slider__activation__wrap owl-carousel owl-theme">
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(images/slider/shopPc.jpg) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>Nouveau produit <span class="text--theme">Collection</span></h1>
                                                    <div class="slider__btn">
                                                        <a class="htc__btn" href="shop.php">Achetez maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
                                <!-- Start Single Slide -->
                                <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(images/slider/phones.jpg) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>Nouveau produit <span class="text--theme">Collection</span></h1>
                                                    <div class="slider__btn">
                                                        <a class="htc__btn" href="shop.php">Achetez maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide slider__full--screen slider-height-inherit  slider-text-left" style="background: rgba(0, 0, 0, 0) url(images/slider/camera.png) no-repeat scroll center center / cover ;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                                                <div class="slider__inner">
                                                    <h1>Nouveau produit <span class="text--theme">Collection</span></h1>
                                                    <div class="slider__btn">
                                                        <a class="htc__btn" href="shop.php">Achetez maintenant</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Slide -->
                            </div>
                        </div>
                        <!-- Start Slider Area -->
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                        <div class="categories-menu mrg-xs">
                            <div class="category-heading">
                                <h3> Nos Catégories</h3>
                            </div>
                            <div class="category-menu-list">
                                <ul> <?php
                                        $query = "select * from categorie where idCat_parente=0";
                                        $run = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($run)) {
                                            $query1 = "select * from categorie where idCat_parente=" . $row['idCategorie'] . "";
                                            $run1 = mysqli_query($con, $query1);
                                            $total1 = mysqli_num_rows($run1);
                                            echo '
                                                        <li><a href="shop.php?idCat=' . $row['idCategorie'] . '">' . $row['desp_cat'] . ' ';
                                            if ($total1 > 1) {
                                                echo ' <i class="zmdi zmdi-chevron-right"></i></a>
                                                     <div class="category-menu-dropdown" style="width:300px;" >
                                                     <div class="category-part-3 category-common mb--30" style="width:100%;color:black;green;margin-top:-40px;margin-bottom:-40px;"> 
                                                     <ul>';

                                                while ($row1 = mysqli_fetch_array($run1)) {
                                                    echo '<li><a href="shop.php?idCat=' . $row1['idCategorie'] . '" >' . $row1['desp_cat'] . ' </a></li>';
                                                }
                                                echo '
                                                        </ul>
                                            </div>
                                            
                                           
                                        </div> ';
                                            } else echo '</a>';

                                            echo '</li>';
                                        }

                                        ?>





                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Left Feature -->
                </div>
            </div>
        </section>
        <!-- End Feature Product -->
        <div class="only-banner ptb--100 bg__white">
            <div class="container" >
                <div class="only-banner-img">
                    <a href="shop-sidebar.html"><img src="images/new-product/gaming.png" alt="new product"></a>
                </div>
            </div>
        </div>


        <?php
        $i = 0;
        $i1 = 1;
        $i2 = 2;
        $i3 = 3;

        $statement = mysqli_query($con, "select * from categorie where idCat_parente=0");

        while ($line = mysqli_fetch_array($statement)) {
            $query = "select * from categorie where idCat_parente=" . $line['idCategorie'] . "";
            $run = mysqli_query($con, $query);
            if (mysqli_num_rows($run) != 0) {
                echo ' 
         <!-- Start Our Product Area -->
         <section class="htc__product__area bg__white" id="cat_redirect' . $i . '">
            <div class="container">
                <div class="row" >
                    <div class="col-md-3">
                        <div class="product-categories-all">
                            <div class="product-categories-title">
                                <h3><a href="index.php?category=' . $line['idCategorie'] . '#cat_redirect' . $i . '">' . $line['desp_cat'] . '</a></h3>
                            </div>
                            <div class="product-categories-menu">
                                <ul>';
                while ($row = mysqli_fetch_array($run)) {
                    echo '<li ><a class="category-hover-' . $row['idCategorie'] . '" href="index.php?category=' . $row['idCategorie'] . '#cat_redirect' . $i . '"
                                               ';
                    if (isset($_GET['category']) && $_GET['category'] == $row['idCategorie'])  echo 'style="color:red;"';
                    echo ' >' . $row['desp_cat'] . ' </a></li>';
                }

                echo '       </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="product-style-tab">
                            <div class="product-tab-list">
                                <!-- Nav tabs -->
                                <ul class="tab-style" role="tablist">
                                    <li class="active">
                                        <a href="#home' . $i1 . '" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Nouveaux </h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#home' . $i2 . '" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Meilleures ventes </h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#home' . $i3 . '" data-toggle="tab">
                                            <div class="tab-menu-text">
                                                <h4>Meilleures évaluations</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.php?idCat=' . $line['idCategorie'] . '" >
                                            <div class="tab-menu-text">
                                                <h4>Tous les produits</h4>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content another-product-style jump">
                                <div class="tab-pane active" id="home' . $i1 . '">
                                    <div class="row">
                                    <div class="product-slider-active owl-carousel"> ';


                if (isset($_GET['category']) && getParent($_GET['category']) == $line['idCategorie']) {
                    if (getParent($_GET['category']) == $line['idCategorie'])
                        $run = mysqli_query($con, "SELECT * from produit where idCategorie=" . $_GET['category'] . " and stock>0 ");
                } else {
                    $run = mysqli_query($con, "select * from produit join categorie on categorie.idCategorie=produit.idCategorie where idCat_parente=" . $line['idCategorie'] . " and stock>0 ");
                }


                while ($row = mysqli_fetch_array($run)) {
                    $image = "images/" . $row['img_prod'] . "";
                    $new_price = $row['prix'] * (1 - $row['promo'] * 0.01);
                    echo '
                                  
                                            <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a href="product-details.php?idprod=' . $row['idProduit'] . '">
                                                                <img src="' . $image . '" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                                <li><a title="Favoris ♥" href="wishlist.php"><span class="ti-heart"></span></a></li>
                                                            </ul>
                                                        </div>
                                                     </div>
                                                    <div class="product__details">
                                                        <h2><a href="product-details.php?idprod=' . $row['idProduit'] . '">' . $row['nom_prod'] . '</a></h2>
                                                        <ul class="product__price">

                                                            <li class="old__price">' . $row['prix'] . ' Dhs</li>
                                                            <li class="new__price">' . $new_price . ' Dhs</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                }



                echo '
   
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="home' . $i3 . '">
                                   
                                    <div class="row">
                                    <div class="product-slider-active owl-carousel"> ';


                if (isset($_GET['category']) && getParent($_GET['category']) == $line['idCategorie']) {
                    if (getParent($_GET['category']) == $line['idCategorie'])
                        $run = mysqli_query($con, "SELECT *,AVG(evaluation) from produit join avis on produit.idProduit=avis.idProduit where idCategorie=" . $_GET['category'] . " and stock>0 group by avis.idProduit order by AVG(evaluation) DESC;   ");
                } else {
                    $run = mysqli_query($con, "SELECT *,AVG(evaluation) from produit join categorie on categorie.idCategorie=produit.idCategorie join avis on produit.idProduit=avis.idProduit where idCat_parente=" . $line['idCategorie'] . " and stock>0  group by avis.idProduit order by AVG(evaluation) DESC;    ");
                }


                while ($row = mysqli_fetch_assoc($run)) {
                    $image = "images/" . $row['img_prod'] . "";
                    $new_price = $row['prix'] * (1 - $row['promo'] * 0.01);
                    echo '
                                  
                                            <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a href="product-details.php?idprod=' . $row['idProduit'] . '">
                                                                <img src="' . $image . '" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                            
                                                                <li><a title="Favoris ♥" href="wishlist.php"><span class="ti-heart"></span></a></li>
                                                            </ul>
                                                        </div>
                                                     </div>
                                                    <div class="product__details">
                                                        <h2><a href="product-details.php?idprod=' . $row['idProduit'] . '">' . $row['nom_prod'] . '</a></h2>
                                                        <ul class="product__price">

                                                            <li class="old__price">' . $row['prix'] . ' Dhs</li>
                                                            <li class="new__price">' . $new_price . ' Dhs</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                }



                echo '
   
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="home' . $i2 . '">
                                    <div class="row">
                                        <div class="product-slider-active owl-carousel">';

                if (isset($_GET['category']) && getParent($_GET['category']) == $line['idCategorie']) {
                    if (getParent($_GET['category']) == $line['idCategorie'])
                        $run = mysqli_query($con, "SELECT * from produit  where idCategorie=" . $_GET['category'] . " order by vendu DESC;   ");
                } else {
                    $run = mysqli_query($con, "SELECT * from produit join categorie on categorie.idCategorie=produit.idCategorie  where idCat_parente=" . $line['idCategorie'] . " order by vendu DESC;    ");
                }


                while ($row = mysqli_fetch_assoc($run)) {
                    $image = "images/" . $row['img_prod'] . "";
                    $new_price = $row['prix'] * (1 - $row['promo'] * 0.01);
                    echo '
                                  
                                            <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a href="product-details.php?idprod=' . $row['idProduit'] . '">
                                                                <img src="' . $image . '" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                                <li><a title="Favoris ♥" href="wishlist.php"><span class="ti-heart"></span></a></li>
                                                            </ul>
                                                        </div>
                                                     </div>
                                                    <div class="product__details">
                                                        <h2><a href="product-details.php?idprod=' . $row['idProduit'] . '">' . $row['nom_prod'] . '</a></h2>
                                                        <ul class="product__price">

                                                            <li class="old__price">' . $row['prix'] . ' Dhs</li>
                                                            <li class="new__price">' . $new_price . ' Dhs</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                }



                echo '
   
                                        </div>
                                    </div>
                                </div>
                                          
                                           
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
        <!-- End Our Product Area --> ';
                $i++;
                $i1 += 4;
                $i2 += 4;
                $i3 += 4;
            }
        }
        ?>


        <div class="only-banner ptb--100 bg__white">
            <div class="container" id="cat2_redirect">
                <div class="only-banner-img">
                    <a href="shop-sidebar.html"><img src="images/new-product/pub.jpg" alt="new product"></a>
                </div>
            </div>
        </div>

        
        <!-- Start Footer Area -->
        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget">
                                <div class="ft__logo">
                                    <a href="index.html">
                                        <img src="images/logo/logo.png" alt="footer logo">
                                    </a>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>194 Main Rd T, FS Rayed <br> VIC 3057, USA</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="address-text">
                                                <a href="#"> info@exemple.com</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>+012 345 678 102 </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="social__icon">
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Catégories</h2>
                                <ul class="footer-categories">
                                    <li><a href="shop-sidebar.html">Composants</a></li>
                                    <li><a href="shop-sidebar.html">Périphériques</a></li>
                                    <li><a href="shop-sidebar.html">PC portables</a></li>
                                    <li><a href="shop-sidebar.html">PC gamer</a></li>
                                    <li><a href="shop-sidebar.html">Processeurs</a></li>
                                    <li><a href="shop-sidebar.html">Stockage</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Infomation</h2>
                                <ul class="footer-categories">
                                    <li><a href="about.html">À Propos De Nous</a></li>
                                    <li><a href="contact.html">Nous Contacter</a></li>
                                    <li><a href="#">Termes & Conditions</a></li>
                                    <li><a href="#">Retours & Échanges</a></li>
                                    <li><a href="#">Facturation & Livraison</a></li>
                                    <li><a href="#"> Politique De Confidentialité</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-lg-offset-1 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Newsletter</h2>
                                <div class="newsletter__form">
                                    <p>Inscrivez-vous à notre newsletter et obtenez 10% de réduction sur votre premier achat.</p>
                                    <div class="input__box">
                                        <div id="mc_embed_signup">
                                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                                    <div class="news__input">
                                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Adresse mail" required>
                                                    </div>
                                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                                    <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->
                    </div>
                </div>
                <!-- Start Copyright Area -->
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright">
                                    <p>© 2020 <a href="#">Équipe de développement 2GI</a>
                                        Tous droits réservés.</p>
                                </div>
                                <ul class="footer__menu">
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="shop.php">Produits</a></li>
                                    <li><a href="contact.php">Nous contacter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Copyright Area -->
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>
    <!-- Body main wrapper end -->
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->

    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>
    <script src="jQuery.3.5.1.js"></script>
    <script type="text/javascript">
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (this.hash.length > 0) {
                    $('body, html').animate({
                        scrollTop: $(this.hash).offset().top
                    }, 500);
                }
                return false;
            });
        });


       
    </script>
   
    <script>
        const button=document.querySelector('button[type="submit"]');
button.disabled=true;
  function autocomplete(inp, arr, arr2) {

  var currentFocus;
  
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
     
      closeAllLists();
     if(!val) {
        const button=document.querySelector('button[type="submit"]');
button.disabled=true;

     }
      currentFocus = -1;
      
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
       
      this.parentNode.appendChild(a);
      /*
      if(val.toUpperCase()=="" || val.toUpperCase()==" "  || val.toUpperCase()==" " ) {         
           const button=document.querySelector('button[type="submit"]');
button.disabled=true;
      }
*/

if( val=="" || val==" " || val=="  " || val=="   " || val=="    " || val.indexOf("    " )>-1){

    const button=document.querySelector('button[type="submit"]');
button.disabled=true;
const sheet = new CSSStyleSheet();
    sheet.replaceSync('.autocomplete-items {height: auto ; overflow-y: unset; scroll-behavior: unset}');

// Apply the stylesheet to a document:
document.adoptedStyleSheets = [sheet];

}    
else{
      var y=0;
      for (i = 0; i < arr.length; i++) { 
   for(var l=0;l<arr[i].length;l++){
        if (arr[i].substr(l, val.length).toUpperCase() == val.toUpperCase() ) {
        	console.log(arr[i]);
          y++;

          l=document.createElement("a");
          l.href="product-details.php?idprod=" + arr2[i];
          ul=document.createElement("ul");
          b = document.createElement("DIV");
          b.className='good';
          li=document.createElement("li");
          li.setAttribute("class", "li_search");   
          p=document.createElement("p");
          p.setAttribute("class","p-search");

 
          p.innerHTML += "<a style='color:black;' href='product-details.php?idprod=" + arr2[i] + "'>" + arr[i] + "</a>";
          
          var iconurl =  <?php echo json_encode($arrimage); ?>;
          var img = document.createElement("img"); 
            img.src=iconurl[i];
            img.width=50;
             img.height=50;
             li.appendChild(img);
             li.appendChild(p);
             b.appendChild(li);
             l.appendChild(b);
          b.addEventListener("click", function(e) {
         
              inp.value = this.getElementsByTagName("input")[0].value;
        
              closeAllLists();
          });
          a.appendChild(l);
          
        }
}
      }
      if(y>7) {
        console.log(y);
          b.setAttribute("id", "invisible_");
          
 	      const sheet = new CSSStyleSheet();
 	       sheet.replaceSync('.autocomplete-items {height: 371px}');

// Apply the stylesheet to a document:
          document.adoptedStyleSheets = [sheet];
          const button=document.querySelector('button[type="submit"]');
          button.disabled=false;
 }
 else if(y==0) {
          b = document.createElement("DIV");
          b.className='good';
          p=document.createElement("p");
          p.setAttribute("class","p-search");

 
          p.innerHTML += "<p style='color:black;' > aucun resultat..</a>";              
             b.appendChild(p);
           
           
          b.addEventListener("click", function(e) {
         
              inp.value = this.getElementsByTagName("input")[0].value;
        
              closeAllLists();
          });
          a.appendChild(b);
    
 	const sheet = new CSSStyleSheet();
    sheet.replaceSync('.autocomplete-items {height: auto ; overflow-y: unset; scroll-behavior: unset}');

// Apply the stylesheet to a document:
document.adoptedStyleSheets = [sheet];

const button=document.querySelector('button[type="submit"]');
button.disabled=true;
 }
 else {
    const sheet = new CSSStyleSheet();
    sheet.replaceSync('.autocomplete-items {height: auto ; overflow-y: unset; scroll-behavior: unset}');

// Apply the stylesheet to a document:
document.adoptedStyleSheets = [sheet];
const button=document.querySelector('button[type="submit"]');
button.disabled=false;
 }

}
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
      
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { 
        
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
   
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

var myvar = <?php echo json_encode($arr); ?>;
var myvar2 = <?php echo json_encode($arr2); ?>;
autocomplete(document.getElementById("myInput"), myvar, myvar2);
</script>
</body>

</html>