






    $('#review-form').submit(function(e) {
        e.preventDefault();
        var postdata = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: 'comments.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                   
                    $(this)[0].reset();
                    
                }             
            }
        });
    });



   

})
