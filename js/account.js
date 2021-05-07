$(document).ready(function () {

    $("#account-form").submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#account-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'manageAccount.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $('#account-form')[0].reset();
                    $('#account-status').css('color', '#4a934a');
                    $('#account-status').html('Modifications enregistrées avec succès');
                    $('#account-status').show();
                    $('#account-status').delay(5000).fadeOut(400);
                    $('#firstName').val(result.firstName);
                    $('#lastName').val(result.lastName);
                    $('#email').val(result.email);
                    $('#tel').val(result.tel);

                }   
                 else {
                    if(result.emailError!=""){
                        $('#email-status').css('color', '#ff4136');
                        $('#email-status').html('e-mail invalide !');
                        $('#email-status').show();
                        $('#email-status').delay(5000).fadeOut(400);
                    }
                }
            }
        });
    });

})
