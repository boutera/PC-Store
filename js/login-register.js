$(document).ready(function () {

    $("#register-form").submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#register-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $('#register-form')[0].reset();
                    if (result.isCart) {
                        location.href = "checkout.php?isCart=1";
                    }
                    else {
                        location.href = "index.php";
                    }

                }
                else {
                    $('#firstname + .comments').html(result.firstnameError);
                    $('#name + .comments').html(result.nameError);
                    $('#email + .comments').html(result.emailError);
                    $('#password ~ .comments').html(result.passwordError);
                }
            }
        });
    });

    $("#login-form").submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#login-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccessClient || result.isSuccessAdmin) {
                    $('#login-form')[0].reset();
                    if(result.isSuccessAdmin){
                        location.href = "admin/index.php";
                    }
                    else if (result.isCart) {
                        location.href = "checkout.php?isCart=1";
                    }
                    else {
                        location.href = "index.php";
                    }



                }
                else {
                    $('#email2 + .comments').html(result.emailError);
                    $('#password2 ~ .comments').html(result.passwordError);
                }
            }
        });
    });





})
