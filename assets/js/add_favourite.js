jQuery(document).ready(function($){

    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-favourite-btn', function(event){

        event.preventDefault();

        
        var jtg_security = $('#jtg-ajax-nonce').val();
        var user_id = $('#jtg-favourite-user-id').val();
        var property_id = $('#jtg-favourite-property-id').val();

        // Use ajax to do something...
        var postData = {
            action: 'jtg_add_favourite',
            jtg_security: jtg_security,
            user_id: user_id,
            property_id: property_id
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
                $("#jtg-user-favourite-btn i").hide();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});