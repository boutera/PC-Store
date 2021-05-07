$(document).ready(function () {

    $(".remove-wish a").click(function () {
        $(this).parents(".remove-wish").submit();
    });

    $(".remove-wish").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'removeWish.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    if(result.wishItems > 0){
                        $('.flag').parents("tr").remove();
                        $('.flag').removeClass("flag");
                    }
                    else{
                        $('#wishlist').replaceWith('<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">' +
                            '<div class="ht__bradcaump__wrap">' +
                            '<div class="container">' +
                            '<div class="row">' +
                            '<div class="col-xs-12">' +
                            '<div class="bradcaump__inner text-center">' +
                            '<nav class="bradcaump-inner">' +
                            '<span class="breadcrumb-item active">Votre liste d\'envies est vide !</span>' +
                            '<a class="continuer" href="index.php">Continuer vos achats</a>' +
                            '</nav>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div >' +
                            '</div >') ;
                    }
                    
                }
                else {
                    alert("erreur de suppression !");
                    $('.flag').removeClass("flag");

                }
            }
        });

    });

    $(".add-wish a").click(function () {
        $(this).parents(".add-wish").submit();
    });

    $(".add-wish").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'addWishToCart.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
              
                    $(".cart-counter").html(result.cartItems);
                    $(".flag a").replaceWith('<span class="wish-added">Produit ajouté au panier</span>');
                    if(result.wishItems > 0){
                        $('.flag').parents("tr").delay(2000).queue(function () { $(this).remove(); });
                        $('.flag').removeClass("flag");
                    }
                    else{
                        $('#wishlist').delay(2000).queue(function () { $(this).replaceWith('<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">'+
                                                            '<div class="ht__bradcaump__wrap">'+
                                                                '<div class="container">'+
                                                                    '<div class="row">'+
                                                                        '<div class="col-xs-12">'+
                                                                            '<div class="bradcaump__inner text-center">'+
                                                                                '<nav class="bradcaump-inner">'+
                                                                                    '<span class="breadcrumb-item active">Votre liste d\'envies est vide !</span>'+
                                                                                    '<a class="continuer" href="index.php">Continuer vos achats</a>'+
                                                                                '</nav>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div >'+
                                                        '</div >');
                        });
                    }
                    
                }
                else {
                    alert("erreur d'ajout !");
                    $('.flag').removeClass("flag");

                }
            }
        });

    });

    $(".buttons-cart input:first").click(function (e) {

        $.ajax({
            type: 'POST',
            url: 'resetWishList.php',
            data: "",
            dataType: 'json',
            success: function (result) {

                $('#wishlist').replaceWith('<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">' +
                        '<div class="ht__bradcaump__wrap">' +
                        '<div class="container">' +
                        '<div class="row">' +
                        '<div class="col-xs-12">' +
                        '<div class="bradcaump__inner text-center">' +
                        '<nav class="bradcaump-inner">' +
                        '<span class="breadcrumb-item active">Votre liste d\'envies est vide !</span>' +
                        '<a class="continuer" href="index.php">Continuer vos achats</a>' +
                        '</nav>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div >' +
                        '</div >');
                


            }
        });

    });

})
