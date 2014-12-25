<?php

/*
  Plugin Name: Woocommerce Category based sitemaps
  Plugin URI: http://phppoet.com
  Description: Woocommerce Category based sitemaps plugin lets you allow to separate xml and/or xml.gz sitemap for all your cateogories . 
  Version: 1.0.2
  Author: Parbat Patel
  Author URI: http://phppoet.com
  


 */

$wccs_options = get_option('wccs_settings');



//define plugin url
if( !defined( 'wccs_PLUGIN_URL' ) )
define( 'wccs_PLUGIN_URL', plugin_dir_url( __FILE__ ) );	

 if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    require 'classes/class-admin-settings.php';
	require 'classes/class-add-extra-category-edit-fields.php';
	require 'classes/class-add-extra-product-edit-fields.php';
	require 'includes/wccs-functions.php';
	require 'includes/wccs-update-sitemap-with-post.php';
	
	
    global $woocommerce_sitemaps;
    $woocommerce_sitemaps = new woocommerce_category_based_sitemaps();
	
}



//register deactivation hook
if(function_exists('register_activation_hook'))
	register_activation_hook(__FILE__, 'wccs_activation_hook'); 
	
function wccs_activation_hook() {


if (!get_option( 'wccs_sitemap_url' )) {
add_option( 'wccs_sitemap_url', 'Not generated yet', '', 'yes' );
}
if (!get_option( 'wccs_sitemap_generation_time' )) {
add_option( 'wccs_sitemap_generation_time', 'Never', '', 'yes' );
}
if (!get_option( 'wccs_ping_time' )) {
add_option( 'wccs_ping_time', 'Never', '', 'yes' );
}
}

   add_filter( 'plugin_action_links', 'wccs_plugin_action_links',10, 2 );
    function wccs_plugin_action_links( $links, $file ) {
    if ( $file == plugin_basename( dirname(__FILE__).'/index.php' ) ) {
		$links[] = '<a href="admin.php?page=wc_category_sitemaps">'.__('Settings ','wccs').'</a>';
	}

	return $links;
    }
?>