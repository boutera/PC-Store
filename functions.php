<?php

function getParent($id){

        global $con;
        $result = mysqli_query($con, "SELECT idCat_parente FROM categorie WHERE idCategorie = $id ");
        $item = mysqli_fetch_assoc($result);
      
        return $item['idCat_parente'];
    }

function creationPanier()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['idProduit'] = array();
        $_SESSION['panier']['libelleProduit'] = array();
        $_SESSION['panier']['qteProduit'] = array();
        $_SESSION['panier']['prixProduit'] = array();
    }
    return true;
}

function ajouterArticle($idProduit, $libelleProduit, $qteProduit, $prixProduit)
{

    //Si le panier existe
    if (creationPanier()) {
        //Si le produit existe déjà on ajoute seulement la quantité
        $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

        if ($positionProduit !== false) {
            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            $_SESSION['cartItems'] += $qteProduit;
        } else {
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['idProduit'], $idProduit);
            array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
            array_push($_SESSION['panier']['qteProduit'], $qteProduit);
            array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            $_SESSION['cartItems'] += $qteProduit;
        }
    } else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($idProduit, $qteProduit)
{
    //Si le panier existe
    if (creationPanier()) {

        //Recherche du produit dans le panier
        $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

        if ($positionProduit !== false) {
            $_SESSION['cartItems'] += $qteProduit - $_SESSION['panier']['qteProduit'][$positionProduit];
            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
        }
    } else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}



function supprimerArticle($idProduit)
{
    //Si le panier existe
    if (creationPanier()) {
        //Nous allons passer par un panier temporaire
        $tmp = array();
        $tmp['idProduit'] = array();
        $tmp['libelleProduit'] = array();
        $tmp['qteProduit'] = array();
        $tmp['prixProduit'] = array();

        for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {
            if ($_SESSION['panier']['idProduit'][$i] !== $idProduit) {

                array_push($tmp['idProduit'], $_SESSION['panier']['idProduit'][$i]);
                array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
            }
        }
        //On remplace le panier en session par notre panier temporaire à jour
        $_SESSION['panier'] =  $tmp;
        //On efface notre panier temporaire
     unset($tmp);
    } else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function viderPanier()
{
    //Si le panier existe
    if (creationPanier()) {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['idProduit'] = array();
        $_SESSION['panier']['libelleProduit'] = array();
        $_SESSION['panier']['qteProduit'] = array();
        $_SESSION['panier']['prixProduit'] = array();
        
    } else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


/*function estVide(){

    $estVide = true;
    if (creationPanier()) {
        for ($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {
            if($_SESSION['panier']['qteProduit'][$i] > 0)
            $estVide = false;
        }
    }
    return $estVide;
}*/

?>