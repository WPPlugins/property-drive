jQuery(document).ready(function($){


    $( document ).on( 'click', '#jtg-update-property-btn', function(event){

        event.preventDefault();

        
        var jtg_security = $('#jtg-ajax-nonce').val();

        var post_id = $('#jtg_property_id').val();


        var latitude = $('#jtg_latitude').val();
        var longitude = $('#jtg_longitude').val();

        var price = $('#jtg_price').val();
        var price_term = $('#jtg_price_term').val();

        var property_size = $('#jtg_property_size').val();
        var property_floors = $('#jtg_property_floors').val();

        var bedrooms = $('#jtg_bedrooms').val();
        var bathrooms = $('#jtg_bathrooms').val();

        var ber_rating = $('#jtg_ber_rating').val();
        var energy_details = $('#jtg_energy_details').val();

        var agent_id = $('#jtg_agent_id').val();
        var agent_name = $('#jtg_agent_name').val();
        var agent_email = $('#jtg_agent_email').val();

        var agent_number = $('#jtg_agent_number').val();
        var agent_mobile = $('#jtg_agent_mobile').val();

        var brochure_1 = $('#jtg_brochure_1').val();
        var brochure_2 = $('#jtg_brochure_2').val();
        var brochure_3 = $('#jtg_brochure_3').val();

        var residential_otw = $('#residential_otw').is(':checked');
        var commercial_otw = $('#commercial_otw').is(':checked');

        var is_featured = $('#is_featured').is(':checked');



        // var secondary_colour = $('#jtg_secondary_plugin_color').val();
        // var header_show_type = $('#jtg_design_show_type').is(':checked');



        // Use ajax to do something...
        var postData = {
            action: 'jtg_save_property_details',
            jtg_security: jtg_security,
            post_id: post_id,
            latitude: latitude,
            longitude: longitude,
            price: price,
            price_term: price_term,
            property_size: property_size,
            property_floors: property_floors,
            bedrooms: bedrooms,
            bathrooms: bathrooms,
            ber_rating: ber_rating,
            energy_details: energy_details,
            agent_id: agent_id,
            agent_name: agent_name,
            agent_email: agent_email,
            agent_number: agent_number,
            agent_mobile: agent_mobile,
            brochure_1: brochure_1,
            brochure_2: brochure_2,
            brochure_3: brochure_3,
            commercial_otw: commercial_otw,
            residential_otw: residential_otw,
            is_featured: is_featured,

        }

        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {

                $(".jtg-ajax-response").fadeIn().html(response.data).show().delay(1500).fadeOut();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data);
        }); 

    });

});