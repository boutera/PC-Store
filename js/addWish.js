$(document).ready(function () {

    $('.product__action a').click(function () {
        $(this).parents(".product__action").next().submit();
    });

    $('a.add').parents(".product__action").next().submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'addWish.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $(".flag").prev(".product__action ").children("li").replaceWith('<li><a title="Ajouté ♥" href="#/"><span class="ti-check-box" style="font-size: 25x; color: red">Favori</span></a></li>');
                     
                }
                else {
                    alert("erreur d'ajout !");
                    $('.flag').removeClass("flag");

                }
            }
        });

    });

    $('.pro__dtl__btn a').click(function () {
        $("#add-wish").submit();
    });

    $("#add-wish").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        $(this).addClass("flag");

        $.ajax({
            type: 'POST',
            url: 'addWish.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $(".flag").prev("#cart-form").children(".pro__dtl__btn").children("li.add").replaceWith('<li class="add"><a title="Ajouté ♥" href="#/" class="add"><span class="ti-heart" style="color: red; font-weight: bolder"></span></a></li>');
                    $('#cart-status').css('color', '#4a934a');
                    $('#cart-status').html('Produit ajouté à la liste d\'envies');
                    $('#cart-status').show();
                    $('#cart-status').delay(5000).fadeOut(400);

                }
                else {
                    alert("erreur d'ajout !");
                    $('.flag').removeClass("flag");

                }
            }
        });

    });

})
