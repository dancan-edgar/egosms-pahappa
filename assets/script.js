jQuery(function () {


    jQuery('#submit[value="Send message"]').click(function (e) {
        e.preventDefault();
        let form = jQuery('#send-message-form').serialize();

        jQuery.ajax({
            method: 'POST',
            url: '../wp-content/plugins/egosms/inc/Api/SendingAPI.php',
            data: form,
            success: function (data) {

                console.log(data);

                let para_msg = jQuery('.msg');

                if (data == "OK") {
                    form.clearForm();
                    para_msg.html("Message sent successfully").css({"color":"green","font-weight": 500,"font-size":"20px","font-style":"italic"}).fadeIn('slow', function () {
                        setTimeout(function () {
                            para_msg.html(data).fadeOut('slow');
                        },3000);
                    });
                } else {
                    para_msg.html(data).css({"color":"red","font-weight": 500,"font-size":"20px"}).fadeIn('slow', function () {
                        setTimeout(function () {
                            para_msg.html(data).fadeOut('slow');
                        },3000);
                    });
                }
            }
        });
    });



});