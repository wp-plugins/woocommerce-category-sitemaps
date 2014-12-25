<?php

/*
 * this function automattically updates sitemap whenever product is updated
 * since version 1.0.0
 */

class wccs_update_sitemap_with_post {
   public function __construct() {
   global $wccs_options;
   if  ((isset($wccs_options['autoupdate'])) && ($wccs_options['autoupdate'] == "on") )  {
   
   
   add_action('publish_product', 'wccs_generate_sitemap_function');

   
   
   }
   
   if ( (isset($wccs_options['autoping'])) && ($wccs_options['autoping'] == "on") ) {
   
     
    
   add_action('new_to_publish', 'wccs_ping_sitemap_with_product_update');
   add_action('draft_to_publish', 'wccs_ping_sitemap_with_product_update');
   add_action('pending_to_publish', 'wccs_ping_sitemap_with_product_update');
   
   }
   
   }
}
$wccs_update_sitemap_with_post= new wccs_update_sitemap_with_post();
?>