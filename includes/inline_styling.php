<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Inline Styling
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_plugin_styles() {
    global $post;


    $options = get_option('pm_design_options');

    $search_options = get_option('pm_search_options');
    
    $user_custom_css = get_option('pm_css_options', true);
    
    $column_options = get_option('pm_property_results_options');
    
    $search_type_3_options = get_option('search_type_3_options');








    if ($options['jtg_single_page_template'] == '1') {
        wp_enqueue_style( 'jtg-main-styles' );
        wp_enqueue_style( 'jtg-single-property' );
    } elseif ($options['jtg_single_page_template'] == '2') {
        wp_enqueue_style( 'jtg-main-styles' );
        wp_enqueue_style( 'jtg-single-property-2' );
    } else {
        wp_enqueue_style( 'jtg-main-styles' );
    }

    $primary_color = $options['base_colour'];
    $secondary_color = $options['secondary_colour'];
    $featured_title_background = $options['featured_title_background'];
    $featured_title_text_color = $options['featured_title_color'];

    $search_box_color = $search_options['search_background_color'];
    $search_space_above = $search_options['search_space_above'];
    $search_space_below = $search_options['search_space_below'];
    $search_btn_color = $search_options['search_btn_color'];
    $search_btn_hover_color = $search_options['search_btn_hover_color'];
    $search_btn_text_color = $search_options['search_btn_text_color'];
    $search_btn_hover_text_color = $search_options['search_btn_hover_text_color'];
    $price_slider_bar = $search_options['price_slider_bar'];

    $search_3_background_color = $search_type_3_options['search_3_background_color'];

    $style = $column_options['property_box_style'];
    $single_margin_top = 0 + $options['single_page_margin_top'];
    $columns = $column_options['results_grid_columns'];

    $page_margin_top = $options['pd_page_margin_top'];

    if ($columns == 4 && $style == 3) {
        $property_box_image_height = '
        .jtg-pb-image img {
            height: 150px!important;
        }
        .jtg-pb-top {
            top: unset!important;
            bottom: -155px!important;
        }
        ';
    }
    if ($style == 2 || $style == 3) {
        $columns = 2;
        $style_2_extra_css = "
        .jtg-box-status-type {
            background-color: {$primary_color}!important;
        }

        .jtg-box {
            background-color: #fff;
            border: 1px solid {$primary_color}!important;
            box-shadow: 0px 2px 0 0 {$primary_color}!important;
        }

        .jtg-box-image span {
            background-color: {$primary_color}!important;
        }
        ";
    } else {
        $style_2_extra_css = '';
    }
    if ($columns == 2) {
        $dynamic_grid = '
        /*Desktop Sizing*/
        @media (min-width: 48em) {
            .jtg-grid-wrap {
                justify-content: center;
            }
            .jtg-grid-item {
                flex-basis: 48%;
            }
            /* grid fix page specific*/
            .jtg-grid-container {
                margin: 0 100px;
                margin-bottom: 20px;
            }
        }
        ';
    }
    if ($columns == 3) {
        $dynamic_grid = '
        .jtg-grid-wrap {
            justify-content: center;
        }
        /*Desktop Sizing*/
        @media (min-width: 48em) {
            .jtg-grid-item {
                flex-basis: 32%;
            }
            /* grid fix page specific*/
            .jtg-grid-container {
                margin: 0 100px;
                margin-bottom: 20px;
            }
        }
        ';
    }
    if ($columns == 4) {
        $dynamic_grid = '
        /*Desktop Sizing*/
        @media (min-width: 48em) {
            .jtg-grid-item {
                flex-basis: 24%;
            }
            /* grid fix page specific*/
            .jtg-grid-container {
                margin: 0 100px;
                margin-bottom: 20px;
            }
        }
        ';
    }
    $grid_css = "
    .jtg-grid-container {
        margin: 0 10px;
        margin-bottom: 20px;
    }
    .jtg-grid-wrap {
        display: flex; 
        padding: 0px 0px;
        flex-flow: row wrap;
        /*align-items: center;*/
        /*justify-content: center;*/
        list-style: none; 
    }
    .jtg-grid-item {
        flex-basis: 99%;
        flex-direction:column;
        flex-wrap: nowrap;
        padding: 0px;
        margin: 0.5%; 
        margin-bottom: 20px;
    }
    /* MAKE THE FEATURED IMAGES BEHAVE PROPERLY ACROSS ALL DEVICES */
    .grid-item img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    /* FIX THE TYPICAL INDENTION BEHAVIOR OF UNORDERED LISTS */
    .jtg-grid-wrap ul {
        margin-left: 0;
    }
    /*Tablets sizing*/
    @media (min-width: 30em) {
        .jtg-grid-item {
            flex-basis: 48%;
        }
        .jtg-grid-container {
            margin: 0 10px;
            margin-bottom: 20px;
        } 
    }
    {$dynamic_grid}
    ";
    $custom_css = "
    {$grid_css}
    {$style_2_extra_css}
    .pd-page {
        margin-top: {$page_margin_top}px;
    }
    .listing-section-title {
        background-color: {$primary_color};
        padding: 10px 15px;
        color: #fff!important;
        margin-bottom: 20px;
    }
    .listing-spacer {
        margin: 25px 0px;
    }

    li.jtg-grid-item {
        list-style: none !important;
    }
    ul.jtg-grid-wrap {
        margin-left: 0px!important;
    }
    .jtg-image-slider-wrapper {
        margin-top: {$single_margin_top}px;
        margin-bottom: 20px;
    }
    ul.jtg-grid-wrap {
        margin-left: 0px;
    }
    .screen-reader-text {
        display: none;
    }
    .jtg-view-more-btn {
        padding: 10px 15px;
        background-color: {$primary_color}; 
        border: none;
        color: #fff;
        font-weight: bold; 
        text-transform: uppercase;
        font-size: 20px;
    }
    .jtg-view-more-btn:hover {
        background-color: {$secondary_color};
        color: #fff;
    }
    /*** 
    Specific to the Jupiter Theme
    Removes the Page title generated on dynamic pages
    ***/
#mk-page-introduce {
    display:none;
}
{$property_box_image_height}
.jtg-featured-title {
    border-bottom: solid {$featured_title_background} 5px;
    margin-bottom: 15px;
    margin-left: -5px;
    margin-right: -5px;
}
.jtg-featured-title h5{
    display: inline-block;
    background-color: {$featured_title_background};
    color: {$featured_title_text_color}!important;
    padding: 5px 15px;
    margin-bottom: -5px;
}
.noUi-connect {
    background: {$price_slider_bar}!important;
}
.jtg-search-sc {
    padding-top: {$search_space_above}px;
    padding-bottom: {$search_space_below}px;
    background-color: {$search_box_color};
    border: solid 1px #ccc;
}
.jtg-search-sc-btn {
    text-align: center;
    width:100%;
    padding: 8px 10px;
    background-color: {$search_btn_color};
    color: {$search_btn_text_color};
    font-size: 14px;
    line-height: 14px;
    font-weight: 700;
    text-transform: uppercase;
    border: none!important;
    margin-right: 0px!important;
}
.jtg-search-sc-btn:hover {
    background-color: {$search_btn_hover_color};
    color: {$search_btn_hover_text_color};
}
.jtg-page-hr {
    border-bottom: 5px solid {$secondary_color};
}
.pm-list-style-border{
    border-left: 5px solid {$primary_color}!important;
}
.pm-single-contact {
    padding-bottom: 0px;
    background-color: {$primary_color};
    text-align: center;
}
.pm-single-contact h1{
    color: #fff;
    font-weight: bold;
    margin-top: 10px;
}
.pm-button-base {
    background-color: {$primary_color};
    border-color: {$primary_color};
}
.pd-title-border {

    margin: 0;

border-bottom: {$primary_color} solid 5px;
margin-left: -15px;
    margin-right: -15px;
}
.listing-header-item i {
    color: {$primary_color};
}
.pm-button-secondary {
    background-color: {$primary_color};
    border-color: {$primary_color};
}
.pm-listing-head-nav {
    background-color: {$secondary_color};
    display: block;
    background-color: #666; 
    text-transform: uppercase;
}
.pm-listing-head-nav h1 {
    color: #fff!important;
// margin-left: 15px;
}
.pm-listing-head-nav li {
    margin-top: 15px;
}
.property-box-image img {
    height: 150px;
}
.jtg-viewing-response {
    background-color: {$primary_color};
    padding: 10px;
    color: #fff;
    text-align: center;
    margin-bottom: 15px;
    display: none;
}
.jtg-request-viewing, .jtg-login-sidebar {
    text-align: center;
}
.jtg-request-viewing input, select {
    width: 80%;
    margin-bottom: 10px;
}
.jtg-request-viewing select {
    font-size: 13px;
    color: #767676;
    padding: 10px 12px;
    background-color: #fdfdfd;
    border: 1px solid #e3e3e3;
    outline: 0;
}
.jtg-request-viewing-btn {
    margin-top: 10px;
    width: 80%;
    background-color: {$primary_color};
    padding: 10px 15px;
    color: #fff;
    border: 0px;
}
li.tablink {
    margin: 15px 0px;
    border: 1px {$primary_color} solid;
    cursor: pointer;
    padding: 5px 10px;
}
.user-dash-active-tab {
    background-color: {$primary_color};
    color: #fff;
}
.jtg-save-user-profile {
    background-color: {$primary_color};
    padding: 5px 10px;
    color: #fff;
    border: 0px;
    float: right;
}
.jtg-user-logout {
    position: relative;
    background-color: {$primary_color};
    padding: 5px 10px;
    color: #fff;
    border: 0px;
    top: 25px;
}
.search_type_3_inner {
    position: absolute;
    top: 55%;
    left: 50%; 
    transform: translate(-50%, -50%);
    width: 80%;
    background-color: {$search_3_background_color};
    padding: 35px;
}



#jtg-property-title {
padding-bottom: 0px!important;
    }
/* MOBILE INLINE STYLES */
@media only screen and (max-width: 500px) {

    #pd-property-page-slider {

        margin-top: 170px;
    }


#jtg-property-title {
    margin-bottom: 25px;

    background-color: #fff;
    position: relative;
    padding-top: 80px;
    padding-bottom: 0px;
}
}
{$user_custom_css}
";
wp_add_inline_style( 'jtg-main-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'add_plugin_styles' );