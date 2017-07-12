jQuery(document).ready(function($){

    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-remove-favourite-btn', function(event){

        event.preventDefault();

        
        var jtg_security = $('#jtg-ajax-nonce').val();
        var favourite_id = $('#jtg-favourite-property-id').val();

        // Use ajax to do something...
        var postData = {
            action: 'jtg_remove_favourite',
            jtg_security: jtg_security,
            favourite_id: favourite_id
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
                $("#jtg-user-remove-favourite-btn").fadeOut();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});