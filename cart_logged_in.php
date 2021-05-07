<?php

include 'db.php';
if (empty($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["id_user"]))
    header('Location: index.php');
    
if (isset($_SESSION['couponApplyed']))
    unset($_SESSION["couponApplyed"]);

if (isset($_SESSION["id_current_cmd"])) {
    $idCmd = $_SESSION["id_current_cmd"];
    $query = "DELETE FROM commande WHERE (idCommande = '$idCmd')";
    $result = mysqli_query($con, $query);

    $query = "DELETE FROM commande_produits WHERE (idCommande = '$idCmd')";
    $result = mysqli_query($con, $query);
}

$cart = false;
$query = "SELECT * FROM panier_produits WHERE (idClient = " . $_SESSION['id_user'] . ")";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    $cart = true;
}

$query = "SELECT * FROM panier_produits NATURAL JOIN produit  WHERE (idClient = " . $_SESSION['id_user'] . ")";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['stock'] == 0) {

        $query = "UPDATE panier_produits SET quantite = '0' WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = " . $row['idProduit'] . ")";
        $result1 = mysqli_query($con, $query);
        $_SESSION['cartItems'] -= $row['quantite'];
    } else if ($row['quantite'] > $row['stock']) {

        $query = "UPDATE panier_produits SET quantite = " . $row['stock'] . " WHERE (idClient = " . $_SESSION['id_user'] . " AND idProduit = " . $row['idProduit'] . ")";
        $result1 = mysqli_query($con, $query);
        $_SESSION['cartItems'] -= $row['quantite'] - $row['stock'];
    }
}

$query = "SELECT * FROM panier_produits NATURAL JOIN produit  WHERE (idClient = " . $_SESSION['id_user'] . ")";
$result = mysqli_query($con, $query);

$query = "SELECT * FROM types_livraisons";
$result2 = mysqli_query($con, $query);



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Projet e-commerce</title>
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
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/panier.js"></script>
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
                                <?php
                                if (isset($_SESSION["id_user"])) {
                                    echo '<li><a href="account.php"><span class="ti-user">' . $_SESSION["userFirstName"] . '</span></a></li>';
                                } else {
                                    echo '<li><a href="login-register.php"><span class="ti-user">Connexion</span></a></li>';
                                }
                                ?>
                                <li class=""><a href="#/"><span class="ti-shopping-cart"></span><span class="cart-counter"><?php echo $_SESSION["cartItems"]; ?></span></a></li>
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
                    $quer = "SELECT * FROM produit ";
                    $resul = mysqli_query ($con,$quer)or die(mysqli_error($con));
                    if(mysqli_num_rows($resul) > 0) 
                    {   
                        while($rowse = mysqli_fetch_assoc($resul)) 
                        { $arr[]=$rowse['nom_prod'];
                          $arr2[] = $rowse["idProduit"];
                           $path="images/".$rowse['img_prod']."";
                           $arrimage[]=$path;
                       }}
                   
                             
              ?>
            
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        <?php
        if (!$cart) {
            echo '<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Panier</h2>
                                <nav class="bradcaump-inner">
                                    <span class="breadcrumb-item active">Votre panier est vide !</span>
                                    <a class="continuer" href="index.php">Continuer vos achats</a>                                    
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        } else {

            echo '<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Panier</h2>
                                <nav class="bradcaump-inner">
                                    <a class="breadcrumb-item" href="index.php">Accueil</a>
                                    <span class="brd-separetor">/</span>
                                    <span class="breadcrumb-item active">Panier</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->

        <div class="cart-main-area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Prouit</th>
                                            <th class="product-price">Prix unitaire</th>
                                            <th class="product-quantity">Quantité</th>
                                            <th class="product-subtotal">Sous-total</th>
                                            <th class="product-remove">Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
            $totalFinal = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $prix = $row['prix'] * (1 - $row['promo'] / 100);
                echo '<tr>';
                echo '<td class="product-thumbnail"><a href="product-details.php?idprod=' . $row["idProduit"] . '"><img src="images/' . $row['img_prod'] . '" alt="image produit" /></a></td>';
                echo '<td class="product-name"><a href="product-details.php?idprod=' . $row["idProduit"] . '">' . $row['nom_prod'] . '</a></td>';
                echo '<td class="product-price"><span class="amount">' . $prix . ' DH</span></td>';
                echo '<td class="product-quantity">
                           <form class="change-quantity" method="post" action="" role="form">';
                if ($row['stock'] == 0) {
                    echo '<input type="number" style="display: none;" name="quantity" value="0" min="1" max="' . $row['stock'] . '" />';
                    echo '<span class="comments">Produit épuisé</span>';
                    $total = 0;
                } else if ($row['quantite'] > $row['stock']) {
                    echo '<input type="number" name="quantity" value="' . $row['stock'] . '" min="1" max="' . $row['stock'] . '" />';
                    $total = $row['stock'] * $prix;
                } else {
                    echo '<input type="number" name="quantity" value="' . $row['quantite'] . '" min="1" max="' . $row['stock'] . '" />';
                    $total = $row['quantite'] * $prix;
                }
                $totalFinal += $total;
                echo '<input type="text" style="display: none;" name="id_product" value="' . $row['idProduit'] . '" />
                            </form>
                        </td>';
                echo '<td class="product-subtotal">' . $total . '</td>';
                echo '<td class="product-remove">
                            <form class="remove-product" method="post" action="" role="form">
                                <a href="#/"><span class="ti-trash" style="font-size: 25px;"></span></a>
                                <input type="text" style="display: none;" name="id_product" value="' . $row['idProduit'] . '" />
                            </form>
                        </td>';

                echo '</tr>';
            }
            $_SESSION["montantGlobale"] = $totalFinal;


            echo '</tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-xs-12">
                                    <div class="buttons-cart">
                                        <a href="#/">Vider le panier</a>
                                        <a href="index.php">Continuez vos achats</a>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-sm-5 col-xs-12">
                                    <div class="cart_totals">
                                        <h2>Bilan</h2>
                                        <table>
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Total</th>
                                                    <td><span id="sous_amount" class="amount">' . $totalFinal . ' DH</span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Livraison</th>
                                                    <td>';
            $row2 = mysqli_fetch_assoc($result2);
            $bilan = $row2['prix_livraison'] + $totalFinal;
            $_SESSION["type_livr"] = $row2['id_type'];

            echo '<form class="livraison" method="post" action="" role="form">
                                                            <ul id="shipping_method">
                                                                <li>
                                                                    <input type="radio" id="' . $row2['nom_type'] . '" name="type_livraison" value="' . $row2['id_type'] . '" checked>
                                                                    <label for="' . $row2['nom_type'] . '">
                                                                        ' . $row2['nom_type'] . ': <span class="amount">' . $row2['prix_livraison'] . ' DH</span>
                                                                    </label>
                                                                </li>';
            $row2 = mysqli_fetch_assoc($result2);
            echo '<li>
                                                                    <input type="radio" id="' . $row2['nom_type'] . '" name="type_livraison" value="' . $row2['id_type'] . '">
                                                                    <label for="' . $row2['nom_type'] . '">
                                                                        ' . $row2['nom_type'] . ': <span class="amount">' . $row2['prix_livraison'] . ' DH</span>
                                                                    </label>
                                                                </li>
                                                                <li></li>
                                                            </ul>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total à payer</th>
                                                    <td>
                                                        <strong><span id="final_amount" class="amount ">' . $bilan . ' DH</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form class="achat" method="post" action="" role="form">
                                            <div class="wc-proceed-to-checkout">
                                                <a href="#/">Finaliser la commande</a><br><br>
                                                <span id="cmdError" class="comments"></span>
                                            </div>
                                            <input type="text" style="display: none;" name="type_livr" value="' . $_SESSION["type_livr"] . '" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
        <!-- cart-main-area end -->
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
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
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