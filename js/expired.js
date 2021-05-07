$(document).ready(function () {


    function Counter(options) {
        var timer;
        var instance = this;
        var seconds = options.seconds || 10;
        var onUpdateStatus = options.onUpdateStatus || function () { };
        var onCounterEnd = options.onCounterEnd || function () { };
        var onCounterStart = options.onCounterStart || function () { };

        function decrementCounter() {
            onUpdateStatus(seconds);
            if (seconds === 0) {
                stopCounter();
                onCounterEnd();
                return;
            }
            seconds--;
        };

        function startCounter() {
            onCounterStart();
            clearInterval(timer);
            timer = 0;
            decrementCounter();
            timer = setInterval(decrementCounter, 1000);
        };

        function stopCounter() {
            clearInterval(timer);
        };

        return {
            start: function () {
                startCounter();
            },
            stop: function () {
                stopCounter();
            }
        }
    };


    var countdown = new Counter({
        // number of seconds to count down
        seconds: 1800,

        onCounterStart: function () {
            // show pop up with a message 
        },

        // callback function for each second
        onUpdateStatus: function (second) {
            // change the UI that displays the seconds remaining in the timeout 
        },

        // callback function for final action after countdown
        onCounterEnd: function () {
            // show message that session is over, perhaps redirect or log out 
            $.ajax({
                type: 'GET',
                url: 'reset.php',
                success: function (result) {

                    location.href = "session_expired.php";
                }
            });
        }
    });
    countdown.start();

    $(".applyCoupon").submit(function (e) {
        e.preventDefault();
        var postdata = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'coupon.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {

                if (result.isSuccess) {
                    $('#totalFinal').html(result.totalFinal + ' DH');
                    $('#couponValidity').css('color', '#4a934a');
                    $('#couponValidity').html('Coupon appliqué avec succès !');
                    $('#couponValidity').show();
                    $('#couponValidity').delay(5000).fadeOut(400);
                }
                else if (result.couponApplyed) {
                    $('#couponValidity').css('color', '#ff4136');
                    $('#couponValidity').html('Vous avez déjà appliqué un coupon !');
                    $('#couponValidity').show();
                    $('#couponValidity').delay(5000).fadeOut(400);
                }
                else {
                    $('#couponValidity').css('color', '#ff4136');
                    $('#couponValidity').html('Coupon invalide !');
                    $('#couponValidity').show();
                    $('#couponValidity').delay(5000).fadeOut(400);
                }


            }
        });
    });



}

)
