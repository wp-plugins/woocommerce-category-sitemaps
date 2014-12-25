<?php
class wccs_extra_category_edit_sitemap_field  {
   public function __construct() {
   add_action ( 'product_cat_edit_form_fields', 'extra_category_fields');
   add_action ( 'edit_term', 'save_extra_category_fileds' , 10,3);
   
   
   global $wccs_options;
   if ( (isset($wccs_options['type'])) && ($wccs_options['type'] == "03") ) {
   add_action ( 'product_cat_edit_form_fields', 'extra_category_fields_choosesitemap');
   
   }
   
   
   }
    
}


$wccs_extra_category_edit_sitemap_field = new wccs_extra_category_edit_sitemap_field();
?>