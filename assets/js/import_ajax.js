
jQuery(document).ready(function($){
    var $loading = $('#jtg-manual-import-spinner').hide();
    // $loading.hide();
    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-manual-import-btn', function(event){

        event.preventDefault();

        
        // var jtg_security = $('#jtg-ajax-nonce').val();
        
        // Use ajax to do something...
        var postData = {
            action: 'jtg_run_manual_import',
        }
        $loading.show();
        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {
                $loading.hide();
                $(".jtg-ajax-response").fadeIn().html(response.data).show().delay(1500).fadeOut();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});