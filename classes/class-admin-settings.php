<?php
class woocommerce_category_based_sitemaps {

   

    public function __construct() {

	    add_action('admin_enqueue_scripts', array(&$this, 'wccs_register_scripts'));
        add_action('admin_init', array(&$this, 'woocommerce_sitemap_register_settings'));
        add_action('admin_menu', array(&$this, 'wccs_admin_menu'), 99);
		add_action('wp_ajax_wcgenerate_sitemap', array(&$this, 'wccs_ajax_sitemap_generate'));
		add_action('wp_ajax_wccsping_sitemap', array(&$this, 'wccsping_sitemap'));
		
    }

    public function wccs_register_scripts() {
	   wp_register_script( 'wccs', ''.wccs_PLUGIN_URL.'js/wccs.js' );
	   wp_register_style ( 'wccs', ''.wccs_PLUGIN_URL.'css/wccs.css' );
	}
	
    public function wccs_admin_menu() {
        $slug = add_submenu_page( 'woocommerce', __('Sitemaps'), __('Sitemaps'), 'manage_woocommerce', 'wc_category_sitemaps', array(&$this, 'woocategory_based_sitemap'));
    }

    public function woocategory_based_sitemap() {
    wp_enqueue_script('wccs');
	wp_enqueue_style('wccs');
	include ('admin-form.php');
    }
	
	public function woocommerce_sitemap_register_settings() {
	
	   register_setting('wccs_settings_group','wccs_settings');
	   
	}
	
	public function wccs_ajax_sitemap_generate() {
	$this->wccs_generate_sitemap();
	die();
	}
	
	public function wccsping_sitemap() {
	$this->wccs_ping_sitemap_process();
	die();
	}
	
	public function wccs_generate_sitemap() {
	wccs_generate_sitemap_function();
	global $wccs_options;
	if ( isset($wccs_options['xmltitle']) && $wccs_options['xmltitlename'] !='' )
	{  
	     if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
	     $indexsitemapname=''.$wccs_options['foldername'].'/'.$wccs_options['xmltitlename'].'.xml';
          } else {
          $indexsitemapname=''.$wccs_options['xmltitlename'].'.xml';
          }
		 } else {
	  
	  	  if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
	      $indexsitemapname=''.$wccs_options['foldername'].'/product_category_index.xml';
          } else {
          $indexsitemapname='product_category_index.xml';
          }
	   
	}
	echo 'Your <a href="'.site_url().'/'.$indexsitemapname.'">'.$indexsitemapname.'</a> sitemap has been updated successfully.';
	}
	
	public function wccs_ping_sitemap_process() {
	wccs_ping_sitemap_function();
    }
	
	
	
	

}
?>