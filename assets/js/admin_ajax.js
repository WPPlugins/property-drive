jQuery(document).ready(function($){

    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'submit', '#jtg-ajax-form', function(event){

        event.preventDefault();

        
        var jtg_security = $('#jtg-ajax-nonce').val();


        var agency_name = $('#plugin_agency_name').val();
        var agency_email = $('#plugin_agency_email').val();
        var agency_phone = $('#plugin_agency_phone').val();
        var agency_logo = $('#pm-image-url').val();


        var search_type = $('#jtg-search-type').val();
        var padding_above = $('#search_space_above').val();
        var padding_below = $('#search_space_below').val();
        var search_background_color = $('#jtg_search_back_color').val();
        var search_btn_color = $('#jtg_search_btn_back').val();
        var search_btn_text_color = $('#jtg_search_btn_text_color').val();
        var search_btn_hover_text_color = $('#jtg_search_btn_hover_text_color').val();
        var search_btn_hover_color = $('#jtg_search_btn_hover_back').val();
        var price_slider_bar = $('#jtg_price_bar_color').val();

        var jtg_auto_select_county = $('#jtg_auto_select_county').val();


        var search_grouping = $('#jtg_search_grouping').is(':checked');

        var pd_page_margin_top = $('#pd_page_margin_top').val();


        var base_colour = $('#jtg_main_plugin_color').val();
        var secondary_colour = $('#jtg_secondary_plugin_color').val();
        var header_show_type = $('#jtg_design_show_type').is(':checked');
        var header_show_status = $('#jtg_design_show_status').is(':checked');
        var header_show_beds = $('#jtg_design_show_beds').is(':checked');
        var header_show_price = $('#jtg_design_show_price').is(':checked');
        var header_show_ber = $('#jtg_design_show_ber').is(':checked');
        var header_show_area = $('#jtg_design_show_area').is(':checked');

        var slider_auto_play = $('#jtg_slider_auto_play').is(':checked');
        var show_sidebar = $('#jtg_show_sidebar').is(':checked');

        var single_container_padding = $('#jtg_single_container_padding').val();

        var featured_title = $('#jtg_shortcode_title_show').is(':checked');
        var featured_title_background = $('#jtg_shortcode_title_back').val();
        var featured_title_color = $('#jtg_shortcode_title_text').val();
        var property_grid_title = $('#jtg_property_grid_title').val();
        var show_view_more = $('#jtg_show_view_more').is(':checked');

        var design_option = $('#jtg_property_box_layout').val();
        var results_grid_columns = $('#jtg_property_box_columns').val();
        var property_box_style = $('#jtg_property_card_style').val();

        var custom_css = $('#jtg_custom_css').val();
        var single_page_margin_top = $('#jtg_single_page_margin_top').val();

        var pd_auto_draft_properties = $('#pd_auto_draft_properties').is(':checked');


        var auto_sync = $('#jtg_auto_sync_switch').is(':checked');

        var jtg_pd_api = $('#jtg_api_key_field').val();
        var author = $('#jtg_properties_author').val();

        var allow_tax = $('#jtg_allow_tax_switch').is(':checked');
        var allow_styling = $('#jtg_allow_styles_switch').is(':checked');


        var jtg_importer_schedule = $('#jtg_importer_schedule').val();
        var jtg_currency = $('#jtg_currency').val();

        var jtg_theme_compatibility = $('#jtg_theme_compatibility').val();
        var jtg_email_alert_frequency = $('#jtg_email_alert_frequency').val();

        var property_drive_license_key = $('#property_drive_license_key').val();
        var property_drive_purchase_email = $('#property_drive_purchase_email').val();

        var jtg_single_page_template = $('#jtg_single_page_template').val();

        var search_type_3_images = $('#search_type_3_images').val();

        var search_3_background_color = $('#search_3_background_color').val();

        var slider_pause_time = $('#slider_pause_time').val();



        // Use ajax to do something...
        var postData = {
            action: 'wpa_49691',
            jtg_security: jtg_security,

            agency_name: agency_name,
            agency_email: agency_email,
            agency_phone: agency_phone,
            agency_logo: agency_logo,
            jtg_auto_select_county: jtg_auto_select_county,

            search_type: search_type,
            padding_above: padding_above,
            padding_below: padding_below,
            search_background_color: search_background_color,
            search_btn_color: search_btn_color,
            search_btn_text_color: search_btn_text_color,
            search_btn_hover_text_color: search_btn_hover_text_color,
            search_btn_hover_color: search_btn_hover_color,
            price_slider_bar: price_slider_bar,
            search_grouping: search_grouping,
            property_grid_title: property_grid_title,
            show_view_more: show_view_more,

            pd_page_margin_top: pd_page_margin_top,
            pd_auto_draft_properties: pd_auto_draft_properties,

            base_colour: base_colour,
            secondary_colour: secondary_colour,

            header_show_type: header_show_type,
            header_show_status: header_show_status,
            header_show_beds: header_show_beds,
            header_show_price: header_show_price,
            header_show_ber: header_show_ber,
            header_show_area: header_show_area,

            slider_auto_play: slider_auto_play,

            single_container_padding: single_container_padding,

            show_sidebar: show_sidebar,

            featured_title: featured_title,
            featured_title_background: featured_title_background,
            featured_title_color: featured_title_color,

            design_option: design_option,
            results_grid_columns: results_grid_columns,
            property_box_style: property_box_style,
            custom_css: custom_css,
            auto_sync: auto_sync,
            jtg_pd_api: jtg_pd_api,
            author: author,
            allow_tax: allow_tax,
            allow_styling: allow_styling,
            jtg_importer_schedule: jtg_importer_schedule,
            jtg_currency: jtg_currency,
            jtg_theme_compatibility: jtg_theme_compatibility,
            single_page_margin_top: single_page_margin_top,
            jtg_email_alert_frequency: jtg_email_alert_frequency,
            property_drive_license_key: property_drive_license_key,
            property_drive_purchase_email: property_drive_purchase_email,
            jtg_single_page_template: jtg_single_page_template,
            search_type_3_images: search_type_3_images,
            search_3_background_color: search_3_background_color,
            slider_pause_time: slider_pause_time




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