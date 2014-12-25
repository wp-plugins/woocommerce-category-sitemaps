<?php

function wccs_generate_sitemap_function() {


global $product;



$args = array( 
 	  'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => true,
    'number'        => '', 
    'fields'        => 'all', 
    'slug'          => '', 
    'parent'         => '',
    'hierarchical'  => true, 
    'child_of'      => 0, 
    'get'           => '', 
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => '', 
    'search'        => '', 
    'cache_domain'  => 'core' );

$product_categories = get_terms( 'product_cat', $args );
global $wccs_options;
if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
$url=''.site_url().'/'.$wccs_options['foldername'].'';
} else {
$url=site_url();
}

$categorysitemapindex = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; 

$categorysitemapindex .= '<?xml-stylesheet type="text/xsl" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/woocommerce-catsitemap/sitemapindex.xsl"?>' . "\n";

$categorysitemapindex .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n"; 



foreach ($product_categories as $cat ) { 

    
   
	$args = array( 'post_type' => 'product', 'product_cat' => $cat->name  );
                    
	$products=get_posts( $args );	
    $eachcategorysitemap  ='<?xml version="1.0" encoding="UTF-8"?>' . "\n";	
	$eachcategorysitemap .= '<?xml-stylesheet type="text/xsl" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/woocommerce-catsitemap/urlset.xsl"?>' . "\n";
	$eachcategorysitemap .='<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	
	foreach ($products as $product) {
	$productid=$product->ID;
	
	$sitemap_tab_options = array(
                'priority' => get_post_meta($productid, '_sitemappriority', true),
                'change' => get_post_meta($productid, '_sitemapchange', true),
				'exclude' => get_post_meta($productid, '_sitemapexclude', true)
        );
		
	if ($sitemap_tab_options['priority'] != '') {
	 $changefrequency=$sitemap_tab_options['change'];
	} else { 
	$t_id = $cat->term_id;
    $cat_meta = get_option( "category_$t_id");
	
	
	if ($cat_meta['change'] != '') {
	 $changefrequency=$cat_meta['change'];
	} else {
	global $wccs_options;
	if ($wccs_options['productchange'] != '') {
      $changefrequency=$wccs_options['productchange'];
	} else {
	$changefrequency='monthly';
	}
	}
	}
	
		if ($sitemap_tab_options['priority'] != '') {
	 $priority=$sitemap_tab_options['priority'];
	} else { 
	$t_id = $cat->term_id;
    $cat_meta = get_option( "category_$t_id");
	
	
	if ($cat_meta['priority'] != '') {
	 $priority=$cat_meta['priority'];
	} else {
	global $wccs_options;
	if ($wccs_options['productpriority'] != '') {
      $priority=$wccs_options['productpriority'];
	} else {
	$priority='0.5';
	}
	}
	}
	
	if ($sitemap_tab_options['exclude'] != 'yes')	{
	
	                $eachcategorysitemap .= "<url>\n";
					$eachcategorysitemap .= '<loc>'.get_permalink( $productid ).'</loc>\n'; 
					$eachcategorysitemap .= "<lastmod>$product->post_modified_gmt</lastmod>\n"; 
					$eachcategorysitemap .= "<changefreq>$changefrequency</changefreq>\n"; 
					$eachcategorysitemap .= "<priority>$priority</priority>\n"; 
					$eachcategorysitemap .= "</url>\n";
					
					}
	 
	}
	$eachcategorysitemap.='</urlset>';	
	global $wccs_options;
	
	if ((isset($wccs_options['gzip'])) && (!isset($wccs_options['both']))) {
	
	  if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
    $eachcatesitemapurl=''.ABSPATH.''.$wccs_options['foldername'].'/sitemap_'.$cat->name.'.xml';
    } else {
    $eachcatesitemapurl=''.ABSPATH.'sitemap_'.$cat->name.'.xml';
    }
	
	$fp2 = gzopen(''.$eachcatesitemapurl.'.gz', 'w9');
	gzwrite ($fp2, $eachcategorysitemap);
	gzclose($fp2);
	$sitemapurl="$url/sitemap_$cat->name.xml.gz";
	
	} elseif (isset($wccs_options['both'])) {
	
	  if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
    $eachcatesitemapurl=''.ABSPATH.''.$wccs_options['foldername'].'/sitemap_'.$cat->name.'.xml';
    } else {
    $eachcatesitemapurl=''.ABSPATH.'sitemap_'.$cat->name.'.xml';
    }
	
	
	$fp1= fopen($eachcatesitemapurl, 'w');	
    fwrite($fp1,$eachcategorysitemap);
	fclose($fp1);
	
	$fp2 = gzopen(''.$eachcatesitemapurl.'.gz', 'w9');
	gzwrite ($fp2, $eachcategorysitemap);
	gzclose($fp2);
	
	switch($wccs_options['type']) {
	case 01:
	$sitemapurl="$url/sitemap_$cat->name.xml";
	break;
	
	case 02:
	$sitemapurl="$url/sitemap_$cat->name.xml.gz";
	break;
	
	case 03:
	$t_id = $cat->term_id;
    $cat_meta = get_option( "category_$t_id");
	$catsitemaptype=$cat_meta['sitemaptype'];
	switch($catsitemaptype) {
	case 01:
	$sitemapurl="$url/sitemap_$cat->name.xml";
	break;
	
	case 02:
	$sitemapurl="$url/sitemap_$cat->name.xml.gz";
	break;
	
	default:
	$sitemapurl="$url/sitemap_$cat->name.xml";
	}
	break;
	
	default:
	$sitemapurl="$url/sitemap_$cat->name.xml";
	}
	
	} else { 
	
	global $wccs_options;
    if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
    $eachcatesitemapurl=''.ABSPATH.''.$wccs_options['foldername'].'/sitemap_'.$cat->name.'.xml';
    } else {
    $eachcatesitemapurl=''.ABSPATH.'sitemap_'.$cat->name.'.xml';
    }
	
	$fp1= fopen($eachcatesitemapurl, 'w');	
    fwrite($fp1,  $eachcategorysitemap);
	fclose($fp1);
	$sitemapurl="$url/sitemap_$cat->name.xml";
	
	
	}
	

	
	
	
	
	$args = array( 'post_type' => 'product', 'product_cat' => $cat->name , 'orderby'   => 'modified' );
	
	$query = new WP_Query( $args );
	$date = '';
	if ( $query->have_posts() )
					$date = $query->posts[0]->post_modified_gmt;
   	                $date = date( 'c', strtotime( $date ) );
					$t_id = $cat->term_id;
    $cat_meta = get_option( "category_$t_id");
	$catsitemaptype=$cat_meta['exclude'];
	   
	    if ($catsitemaptype != "no") {
					$categorysitemapindex .= "<sitemap>\n";
					$categorysitemapindex .= "<loc>$sitemapurl</loc>\n"; 
					$categorysitemapindex .= "<lastmod>" . htmlspecialchars( $date ) . "</lastmod>\n"; 
					$categorysitemapindex .= "</sitemap>\n";
				}	
			}
			
    
        $categorysitemapindex .= '</sitemapindex>';
	global $wccs_options;
	if ( isset($wccs_options['xmltitle']) && $wccs_options['xmltitlename'] !='' )
	{  
	   if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' )
	   { 
	  
	   
	   $indexsitemapname=''.$wccs_options['foldername'].'/'.$wccs_options['xmltitlename'].'.xml'; 
	   } else {
	   $indexsitemapname=''.$wccs_options['xmltitlename'].'.xml'; 
	   }
	   
	   } else {
	    if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' )
	   { 
	 
	   $indexsitemapname =''.$wccs_options['foldername'].'/product_category_index.xml';
	   } else {
	   $indexsitemapname ='product_category_index.xml';
	   }
	   
	
	}
	
	
	$fp2 = fopen(ABSPATH . $indexsitemapname, 'w');
	
        
	fwrite($fp2,  $categorysitemapindex);   
	fclose($fp2 ); 
	$sitemapindexurl=''.site_url().'/'.$indexsitemapname.'';
	$currenttime    = current_time( 'mysql' );
	update_option('wccs_sitemap_url',$sitemapindexurl);
    update_option('wccs_sitemap_generation_time',$currenttime);
	
	
	
	
	}
	
	/*
	 * function to add extra category field
	 */
	 
	   function extra_category_fields( $tag ) { 
	   global $wccs_options;
  $t_id = $tag->term_id;
  $cat_meta = get_option( "category_$t_id");
  	if ($cat_meta['priority'] == '') {
		if ( (isset($wccs_options['catpriority'])) && ($wccs_options['catpriority'] != '' ) ) {
		$cat_meta['priority']=$wccs_options['catpriority']; 
		} else {
		$cat_meta['priority']='0.5';
		}
		}
		if ($cat_meta['change'] == '') {
		
			if ( (isset($wccs_options['catchange'])) && ($wccs_options['catchange'] != '' ) ) {
		$cat_meta['change']=$wccs_options['catchange'];
		} else {
		$cat_meta['change']='monthly';
		}
        }
  
  ?>

  <tr class="form-field">
  <th scope="row" valign="top"><label for="extra1"><?php
  _e('Sitemap Priority'); ?></label></th>
  <td>
  <select id="Cat_meta[priority]" name="Cat_meta[priority]">
  <option value="0.0" <?php selected($cat_meta['priority'],'0.0'); ?>>0.0</option>
  <option value="0.1" <?php selected($cat_meta['priority'],'0.1'); ?>>0.1</option>
  <option value="0.2" <?php selected($cat_meta['priority'],'0.2'); ?>>0.2</option>
  <option value="0.3" <?php selected($cat_meta['priority'],'0.3'); ?>>0.3</option>
  <option value="0.4" <?php selected($cat_meta['priority'],'0.4'); ?>>0.4</option>
  <option value="0.5" <?php selected($cat_meta['priority'],'0.5'); ?>>0.5</option>
  <option value="0.6" <?php selected($cat_meta['priority'],'0.6'); ?>>0.6</option>
  <option value="0.7" <?php selected($cat_meta['priority'],'0.7'); ?>>0.7</option>
  <option value="0.8" <?php selected($cat_meta['priority'],'0.8'); ?>>0.8</option>
  <option value="0.9" <?php selected($cat_meta['priority'],'0.9'); ?>>0.9</option>
  <option value="1.0" <?php selected($cat_meta['priority'],'1.0'); ?>>1.0</option>
  </select>
  </td>
  </tr>
  
 
  <tr class="form-field" >
   <th scope="row" valign="top"><label for="extra1"><?php
  _e('Change Frequency'); ?></label></th>
  <td><select id="Cat_meta[change]" name="Cat_meta[change]">
  <option value="always" <?php selected($cat_meta['change'],'always'); ?>>Always</option>
  <option value="hourly" <?php selected($cat_meta['change'],'hourly'); ?>>Hourly</option>
  <option value="daily" <?php selected($cat_meta['change'],'daily'); ?>>Daily</option>
  <option value="weekly" <?php selected($cat_meta['change'],'weekly'); ?>>Weekly</option>
  <option value="monthly" <?php selected($cat_meta['change'],'monthly'); ?>>Monthly</option>
  <option value="yearly" <?php selected($cat_meta['change'],'yearly'); ?>>Yearly</option>
   <option value="never" <?php selected($cat_meta['change'],'never'); ?>>Never</option>
  </select> </td>
  </tr>
  	 <tr class="form-field">
		  <th scope="row" valign="top"><label for="Cat_meta[exclude]"><?php
  _e('Always include this category into sitemap'); ?></label></th>
		 <td>
  <select id="Cat_meta[exclude]" name="Cat_meta[exclude]">
  <option value="yes" <?php if ( (isset($cat_meta['exclude'])) && ($cat_meta['exclude'] == "yes") ) { echo "selected"; } ?>>YES</option>
  <option value="no" <?php if ( (isset($cat_meta['exclude'])) && ($cat_meta['exclude'] == "no") ) { echo "selected"; } ?>>No</option>
  </select>
        </td>
		 </tr>
  <?php
  } 
  
  
  	   function extra_category_fields_choosesitemap( $tag ) { 
  $t_id = $tag->term_id;
  $cat_meta = get_option( "category_$t_id");
  
  ?>
   
	   <tr  class="form-field" >
	  <th scope="row" valign="top">
	 <font size="02"> <?php echo __('Sitemap type for this category','wccs'); ?></font>
	  </th>
	  <td>
	<label  for="Cat_meta[sitemaptype]"></label>
    <input type="radio" style="width:1.5%" name="Cat_meta[sitemaptype]" id="Cat_meta[sitemaptype]" value="01" <?php if ( (isset($cat_meta['sitemaptype'])) && ($cat_meta['sitemaptype'] == "01") ) {echo "checked";} ?> />
    <?php echo  __('xml','wccs'); ?>
    &emsp;

    <input type="radio" style="width:1.5%" name="Cat_meta[sitemaptype]" id="Cat_meta[sitemaptype]" value="02"  <?php if ( (isset($cat_meta['sitemaptype'])) && ($cat_meta['sitemaptype'] == "02") ) {echo "checked";} ?> />
    <?php echo __('gzip ','wccs'); ?>
    &emsp;


 
	  </td>
	  </tr>
  

  <?php
  } 


 
  
  function save_extra_category_fileds( $term_id ) {
  if ( isset( $_POST['display_type'] ) ) {
  $t_id = $term_id;
  $cat_meta = get_option( "category_$t_id");
  $cat_keys = array_keys($_POST['Cat_meta']);
  foreach ($cat_keys as $key){
  if (isset($_POST['Cat_meta'][$key])){
  $cat_meta[$key] = $_POST['Cat_meta'][$key];
  }
  }
  
  update_option( "category_$t_id", $cat_meta );
  }
  }
	
  /*
   * Function to add writepanel tabs field
   * since version 1.0.0
   */
  function wccs_product_sitemap_options() {
  ?>
        <a href="#sitemap_tab_data"><li class="sitemap_tab"><img src="<?php echo wccs_PLUGIN_URL; ?>/images/sitemapicon.png" width="13px" height="13px"/>&nbsp;&nbsp;&nbsp;<?php _e('Sitemap', 'wccs'); ?></a></li>
   <?php
  }
  
  /*
   * Function to add writepanel tabs field options
   * since version 1.0.0
   */
   
  function sitemap_tab_options() {
  global $post;
  global $wccs_options;
  

  
  
       
        $sitemap_tab_options = array(
                'priority' => get_post_meta($post->ID, '_sitemappriority', true),
                'change' => get_post_meta($post->ID, '_sitemapchange', true),
				'exclude' => get_post_meta($post->ID, '_sitemapexclude', true)
        );
        
		if ($sitemap_tab_options['priority'] == '') {
		if ( (isset($wccs_options['productpriority'])) && ($wccs_options['productpriority'] != '' ) ) {
		$sitemap_tab_options['priority']=$wccs_options['productpriority']; 
		} else {
		$sitemap_tab_options['priority']='0.5';
		}
		}
		if ($sitemap_tab_options['change'] == '') {
		
			if ( (isset($wccs_options['productchange'])) && ($wccs_options['productchange'] != '' ) ) {
		$sitemap_tab_options['change']=$wccs_options['productchange'];
		} else {
		$sitemap_tab_options['change']='monthly';
		}
        }
?>
        <div id="sitemap_tab_data" class="panel woocommerce_options_panel">
                <div class="options_group">
                        <p class="form-field">
                                <?php woocommerce_wp_checkbox( array( 'id' => '_sitemapexclude', 'label' => __('Exclude from sitemap', 'wccs'), 'description' => __('Enable this option to prevent this product entry into sitemap.', 'wccs') ) ); ?>
                        </p>
                
               
                                                                                   
                        <p class="form-field">
                                <label><?php _e('Priority:', 'wccs'); ?></label>
                               
  <select id="_sitemappriority" name="_sitemappriority">
  <option value="0.0" <?php selected($sitemap_tab_options['priority'],'0.0'); ?>>0.0</option>
  <option value="0.1" <?php selected($sitemap_tab_options['priority'],'0.1'); ?>>0.1</option>
  <option value="0.2" <?php selected($sitemap_tab_options['priority'],'0.2'); ?>>0.2</option>
  <option value="0.3" <?php selected($sitemap_tab_options['priority'],'0.3'); ?>>0.3</option>
  <option value="0.4" <?php selected($sitemap_tab_options['priority'],'0.4'); ?>>0.4</option>
  <option value="0.5" <?php selected($sitemap_tab_options['priority'],'0.5'); ?>>0.5</option>
  <option value="0.6" <?php selected($sitemap_tab_options['priority'],'0.6'); ?>>0.6</option>
  <option value="0.7" <?php selected($sitemap_tab_options['priority'],'0.7'); ?>>0.7</option>
  <option value="0.8" <?php selected($sitemap_tab_options['priority'],'0.8'); ?>>0.8</option>
  <option value="0.9" <?php selected($sitemap_tab_options['priority'],'0.9'); ?>>0.9</option>
  <option value="1.0" <?php selected($sitemap_tab_options['priority'],'1.0'); ?>>1.0</option>
  </select>
 
						
						</p>
                       
                        <p class="form-field">
                               <label> <?php _e('Change Frequency:', 'wccs'); ?></label>
                
   <select id="_sitemapchange" name="_sitemapchange">
  <option value="always" <?php selected($sitemap_tab_options['change'],'always'); ?>>Always</option>
  <option value="hourly" <?php selected($sitemap_tab_options['change'],'hourly'); ?>>Hourly</option>
  <option value="daily" <?php selected($sitemap_tab_options['change'],'daily'); ?>>Daily</option>
  <option value="weekly" <?php selected($sitemap_tab_options['change'],'weekly'); ?>>Weekly</option>
  <option value="monthly" <?php selected($sitemap_tab_options['change'],'monthly'); ?>>Monthly</option>
  <option value="yearly" <?php selected($sitemap_tab_options['change'],'yearly'); ?>>Yearly</option>
   <option value="never" <?php selected($sitemap_tab_options['change'],'never'); ?>>Never</option>
  </select>      
              </p>       
        </div> 
        </div>
   <?php
  }
  
  /*
   * Function to save sitemap tab fields
   * since version 1.0.0
   */
  
  function process_product_meta_sitemap_tab($post_id) {
        update_post_meta( $post_id, '_sitemapexclude', ( isset($_POST['_sitemapexclude']) && $_POST['_sitemapexclude'] ) ? 'yes' : 'no' );
        update_post_meta( $post_id, '_sitemapchange', $_POST['_sitemapchange']);
        update_post_meta( $post_id, '_sitemappriority', $_POST['_sitemappriority']);
  }
  
  /*
   * Function to Ping generated sitemap
   * since version 1.0.0
   */
   
  function wccs_ping_sitemap_function() {
  $wccssitemapurl=get_option('wccs_sitemap_url');
  function pingSE($wccssitemapurl,$searchengine){

	switch ($searchengine) {
		case 'bing':
			$pingurl = "http://www.bing.com/webmaster/ping.aspx?siteMap=$wccssitemapurl";
			break;
		
		case 'google':
			$pingurl = "http://www.google.com/webmasters/sitemaps/ping?sitemap=$wccssitemapurl";
			break;
		
		default:
      		 return false;
	}

	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,$pingurl);
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
    		if (empty($buffer))
	{
		echo '<tr><td><font size="02" color="black">'.__('Ping to ','wccs').'<a href="'.$pingurl.'"><font size="02" color="green">'.$searchengine.'</font></a> '.__('was unsuccessful.Please try again later','wccs').'.</font></td></tr><br />';
	    $currenttime    = 'unsuccessfull ping at '.current_time( 'mysql' ).' ';
		update_option('wccs_ping_time',$currenttime);
	}
	else
	{
		echo '<tr><td><font size="02" color="black">'.__('Your sitemap is successfully notified to ','wccs').' <a href="'.$pingurl.'"><font size="02" color="green">'.$searchengine.'</font></a>.</font></td></tr><br />';
		$currenttime    = current_time( 'mysql' );
	    update_option('wccs_ping_time',$currenttime);
	}
   }

   pingSE($wccssitemapurl,'google');

   pingSE($wccssitemapurl,'bing');
   
   
   
   
  }
  
    /*
   * Function to Ping generated sitemap whenever product is published
   * since version 1.0.0
   */
   
  function wccs_ping_sitemap_with_product_update() {
  
 
  $wccssitemapurl = get_option('wccs_sitemap_url');
  
  function pingSE($wccssitemapurl,$searchengine){

	switch ($searchengine) {
		case 'bing':
			$pingurl = "http://www.bing.com/webmaster/ping.aspx?siteMap=$wccssitemapurl";
			break;
		
		case 'google':
			$pingurl = "http://www.google.com/webmasters/sitemaps/ping?sitemap=$wccssitemapurl";
			break;
		
		default:
      		 return false;
	}

	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,$pingurl);
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
    		if (empty($buffer))
	{
		
	    $currenttime    = 'unsuccessfull ping at '.current_time( 'mysql' ).' ';
		update_option('wccs_ping_time',$currenttime);
	}
	else
	{
		
		$currenttime    = current_time( 'mysql' );
	    update_option('wccs_ping_time',$currenttime);
	}
   }

   pingSE($wccssitemapurl,'google');

   pingSE($wccssitemapurl,'bing');
   
   
   
   
  }
?>