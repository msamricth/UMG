<?php // Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
// add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

 
function filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'supply-blocks',
                'title' => __( 'Supply Blocks', 'Work With Supply' ),
                'icon'  => null,
            )
        );
    }
    return $block_categories;
}
 
add_filter( 'block_categories_all', 'filter_block_categories_when_post_provided', 10, 2 );
function custom_block_category( $categories ) {
    $custom_block = array(
		'slug'  => 'supply-blocks',
		'title' => __( 'Supply Blocks', 'Work With Supply' ),
    );

    $categories_sorted = array();
    $categories_sorted[0] = $custom_block;

    foreach ($categories as $category) {
        $categories_sorted[] = $category;
    }

    return $categories_sorted;
}
add_filter( 'block_categories', 'custom_block_category', 10, 2);

add_filter(
    'acf/pre_save_block',
    function( $attributes ) {
        if ( empty( $attributes['anchor'] ) ) {
            $attributes['anchor'] = 'acf-block-' . uniqid();
        }
        return $attributes;
    }
);

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
    
    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        
        // register the careers search block.
        acf_register_block_type(array(
            'name'              => 'careers_searchbar',
            'title'             => __('Careers Searchbar'),
            'description'       => __('A custom Careers Searchbar block.'),
            'render_template'   => 'template-parts/blocks/careers/searchbar.php',
			'category' 				=> 'supply-blocks',
            'icon'              => 'search',
            'keywords'          => array( 'Careers', 'searchbar' ),
        ));
         // register the careers Values block.
         acf_register_block_type(array(
            'name'              => 'careers_Value',
            'title'             => __('UMG Side by side'),
            'description'       => __('A block that allows you to add a title and content in a 4x4 grid'),
            'render_template'   => 'template-parts/blocks/careers/values.php',
			'category' 				=> 'supply-blocks',
            'icon'              => 'format-aside',
            'keywords'          => array( 'Careers', 'values', 'grid' ),
        ));
        
         // register Repeatable Card block.
         acf_register_block_type(array(
            'name'              => 'repeatable_card',
            'title'             => __('UMG Repeatable Card block'),
            'description'       => __('A block that allows you to add multiple content cards'),
            'render_template'   => 'template-parts/blocks/careers/cards.php',
			'category' 				=> 'supply-blocks',
            'icon'              => 'format-aside',
            'keywords'          => array( 'Careers', 'cards', 'grid' ),
        ));
    }

}