$(document).ready(function () {


    $("#cart-form").submit(function (e) {
        e.preventDefault();

        var postdata = $('#cart-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'manage-cart.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $('#cart-status').css('color', '#4a934a');
                    $('#cart-status').html('Produit ajouté avec succès');
                    $('#cart-status').show();
                    $('#cart-status').delay(5000).fadeOut(400);
                    $(".cart-counter").html(result.cartItems);
                }
                else {
                    $('#cart-status').css('color', '#ff4136');
                    $('#cart-status').html('Produit épuisé');
                    $('#cart-status').show();
                    $('#cart-status').delay(5000).fadeOut(400);
                }
            }
        });
    });

    $(":input").change(function () {
        $(this).parents(".change-quantity").submit();
    });


    $(".change-quantity").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'quantity.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $('.flag').parents(".product-quantity").next().html(result.total);
                    $('form.flag > input:first').attr("value", result.quantite);
                    $('.flag').removeClass("flag");
                    $(".cart-counter").html(result.cartItems);
                    $('#sous_amount').html(result.global + ' DH');
                    $('#final_amount').html(result.global2 + ' DH');

                }
                else {
                    if (result.quantite <= 0) {
                        $('form.flag > input:first').attr("value", "1");
                    }
                    else {
                        $('form.flag > input:first').attr("value", result.stock);
                    }

                    alert("quantité invalide !");
                    $('.flag').removeClass("flag");
                }
            }
        });

    });

    $(".remove-product a").click(function () {
        $(this).parents(".remove-product").submit();
    });

    $(".remove-product").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'remove.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    if (result.cartItems == 0) {
                        if (result.isLogged) {
                            location.href = "cart_logged_in.php";
                        }
                        else{
                            location.href = "cart_logged_out.php";
                        }
                        
                        
                    }
                    else {
                        $('.flag').parents("tr").remove();
                        $(".cart-counter").html(result.cartItems);
                        $('.flag').removeClass("flag");
                    }


                }
                else {
                    alert("erreur de suppression !");
                    $('.flag').removeClass("flag");

                }
            }
        });

    });

    $('input[type=radio][name=type_livraison]').change(function () {
        $(this).parents(".livraison").submit();
    });

    $(".livraison").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'livraison.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                $('#final_amount').html(result.total + ' DH');
            }
        });

    });

    $(".wc-proceed-to-checkout a").click(function () {
        $(this).parents(".achat").submit();
    });

    $(".achat").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'commande.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if(result.isEmpty){
                    $('#cmdError').css('color', '#d82c2e');
                    $('#cmdError').html('Votre panier est vide!')
                    $('#cmdError').show();
                    $('#cmdError').delay(5000).fadeOut(400);    
                }
                else{
                    location.href = "checkout.php";
                }

                
            }
        });
    });


    $(".buttons-cart a:first").click(function (e) {
        
        $.ajax({
            type: 'POST',
            url: 'resetCart.php',
            data: "",
            dataType: 'json',
            success: function (result) {

                if (result.isLogged) {
                    location.href = "cart_logged_in.php";
                    
                }
                else {
                    location.href = "cart_logged_out.php";
                }


            }
        });

    });



}

)
