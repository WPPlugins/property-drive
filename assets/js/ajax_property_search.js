            jQuery(document).ready(function($){
    // var $loading = $('#jtg-manual-import-spinner').hide();
    // $loading.hide();
    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-run-search', function(event){

        var data = {
            action: 'ajax_property_search',
        }

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: ajaxurl, 
            success: function (response) {
                console.log(response);
                $("#jtg-search-response").append(response);
            }
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});