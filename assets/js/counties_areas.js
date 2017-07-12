jQuery(document).ready(function($){

        $( document ).on( 'change', '#property_county_select', function(event){

            event.preventDefault();

            
            var county_id = $('#property_county_select').val();

            // Use ajax to do something...
            var postData = {
                action: 'jtg_counties_areas_ajax',
                county_id: county_id
            }

            //Ajax load more posts
            $.ajax({
                type: "POST",
                data: postData,
                url: ajaxurl, 
                //This fires when the ajax 'comes back' and it is valid json
                success: function (response) {
                    console.log(response);
                    $("#property_area_select")
                    .find("option")
                    .remove()
                    .end()
                    .append("<option value='' selected disabled>Any Area</option>");
                    $("#property_area_select").append(response);
                    
                }
                //This fires when the ajax 'comes back' and it isn't valid json
            }).fail(function (data) {
                console.log(data);
            }); 

        });


    });