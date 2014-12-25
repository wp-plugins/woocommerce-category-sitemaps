<?php
class wccs_add_product_extra_fields {

  public function __construct() {
  add_action('woocommerce_product_write_panel_tabs', 'wccs_product_sitemap_options');
  add_action('woocommerce_product_write_panels', 'sitemap_tab_options');
  add_action('woocommerce_process_product_meta', 'process_product_meta_sitemap_tab', 10, 2);
  }
}
$wccs_add_product_extra_fields= new wccs_add_product_extra_fields();
?>