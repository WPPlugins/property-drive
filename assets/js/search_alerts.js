jQuery(document).ready(function($){

    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-save-this-search', function(event){

        event.preventDefault();

        
        var jtg_security = $('#jtg-ajax-nonce').val();
        var user_id = $('#property_user_id').val();

        var type = $('#property_type').val();
        var status = $('#property_status').val();
        var price_min = $('#property_price_min').val();
        var price_max = $('#property_price_max').val();
        var bedrooms = $('#property_bedrooms').val();
        var bathrooms = $('#property_bathrooms').val();
        var area = $('#property_area').val();
        var county = $('#property_county').val();
 


        // Use ajax to do something...
        var postData = {
            action: 'jtg_add_search_alert',
            jtg_security: jtg_security,
            user_id: user_id,

            type: type,
            status: status,
            price_min: price_min,
            price_max: price_max,
            bedrooms: bedrooms,
            bathrooms: bathrooms,
            area: area,
            county: county
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
                $(".jtg-ajax-response").fadeIn().html(response.data).show().delay(1500).fadeOut();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});