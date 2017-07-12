jQuery(document).ready(function($){

    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-request-viewing', function(event){

        event.preventDefault();

        

        var jtg_security = $('#jtg-ajax-nonce').val();

        var property_id = $('#jtg-viewing-property-id').val();
        var user_id = $('#jtg-viewing-user-id').val();
        var first_name = $('#jtg-viewing-first-name').val();
        var last_name = $('#jtg-viewing-last-name').val();
        var email = $('#jtg-viewing-email').val();
        var phone = $('#jtg-viewing-phone').val();
        var date = $('#jtg-viewing-date').val();
        var time = $('#jtg-viewing-time').val();

        // Use ajax to do something...
        var postData = {
            action: 'jtg_add_viewing',
            jtg_security: jtg_security,

            property_id: property_id,
            user_id: user_id,
            first_name: first_name,
            last_name: last_name,
            email: email,
            phone: phone,
            date: date,
            time: time
        }

        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {
                console.log(response.data);
                $(".jtg-viewing-response").fadeIn().html(response.data).show().delay(2500).fadeOut();

                $( '#jtg-request-viewing-form' ).each(function(){
                    this.reset();
                });
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});