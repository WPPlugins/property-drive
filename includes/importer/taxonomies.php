<?php 
function jtg_setup_taxonomies_data()
	{
		return Array(

			'property_status'			=> Array(
				'post_type'				=> 'property'
				, 'args'				=> Array(
					'hierarchical'		=> true
					, 'label'			=> _x( "Status", "Property Status Label")
					, 'labels'			=> Array(
						'menu_name'		=> _x( "Status", "Property Status Name")
					)
					, 'rewrite'			=> Array(
						'slug'			=> 'property_status'
					)
				)
			)
			
			, 'property_type'			=> Array(
				'post_type'				=> 'property'
				, 'args'				=> Array(
					'hierarchical'		=> true
					, 'label'			=> _x( "Types", "Property Types Label")
					, 'labels'			=> Array(
						'menu_name'		=> _x( "Types", "Property Types Name")
					)
					, 'rewrite'			=> Array(
						'slug'			=> 'property_type'
					)
				)
			)
			, 'property_county'			=> Array(
				'post_type'				=> 'property'
				, 'args'				=> Array(
					'hierarchical'		=> true
					, 'label'			=> _x( "County", "County Label")
					, 'labels'			=> Array(
						'menu_name'		=> _x( "County", "County Name")
					)
					, 'rewrite'			=> Array(
						'slug'			=> 'property_county'
					)
				)
			) 
			,  'property_area'		=> Array(
				'post_type'				=> 'property'
				, 'args'				=> Array(
					'hierarchical'		=> true
					, 'label'			=> _x( "Area", "Property Area Label")
					, 'labels'			=> Array(
						'menu_name'		=> _x( "Area", "Property Area Name")
					)
					, 'rewrite'			=> Array(
						'slug'			=> 'property_area'
					)
				)
			)
			, 'property_features'		=> Array(
				'post_type'				=> 'property'
				, 'args'				=> Array(
					'hierarchical'		=> true
					, 'label'			=> _x( "Features", "Features Label")
					, 'labels'			=> Array(
						'menu_name'		=> _x( "Features", "Features Name")
					)
					, 'rewrite'			=> Array(
						'slug'			=> 'property_features'
					)
				)
			)
			
		);
	}

function jtg_setup_taxonomies() {
	$importer_taxonomies = jtg_setup_taxonomies_data();

	foreach( $importer_taxonomies as $taxonomy => $options ) {
		register_taxonomy( $taxonomy, $options[ 'post_type' ], $options[ 'args' ] );
	}
}
add_action('init', 'jtg_setup_taxonomies');

function jtg_custom_fields()
{
	return Array(
		'_bedrooms'			=> Array(
			'label'			=> __( "Bedrooms" )
			, 'element'		=> 'input'
			, 'type'		=> 'number'
			, 'class'		=> 'all-options'
		)
		, '_bathrooms'		=> Array(
			'label'			=> __( "Bathrooms" )
			, 'element'		=> 'input'
			, 'type'		=> 'number'
			, 'class'		=> 'all-options'
		)
		, '_garages'		=> Array(
			'label'			=> __( "Garages" )
			, 'element'		=> 'input'
			, 'type'		=> 'number'
			, 'class'		=> 'all-options'
		)
		, '_price'			=> Array(
			'label'			=> __( "Price" )
			, 'element'		=> 'input'
			, 'type'		=> 'number'
			, 'class'		=> 'all-options'
		)
		, '_price_prefix'	=> Array(
			'label'			=> __( "Currency" )
			, 'element'		=> 'input'
			, 'type'		=> 'text'
			, 'class'		=> 'all-options'
		)
		, '_area'			=> Array(
			'label'			=> __( "Area" )
			, 'element'		=> 'input'
			, 'type'		=> 'number'
			, 'class'		=> 'all-options'
		)
		, '_area_prefix'	=> Array(
			'label'			=> __( "Unit" )
			, 'element'		=> 'input'
			, 'type'		=> 'text'
			, 'class'		=> 'all-options'
		)
		, '_phone1'			=> Array(
			'label'			=> __( "Contact Mobile" )
			, 'element'		=> 'input'
			, 'type'		=> 'text'
			, 'class'		=> 'large-text'
		)
	);
}