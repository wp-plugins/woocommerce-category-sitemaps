<?php

global $wccs_options;


?>
<div class="wrap">

<form  action="options.php" method="post">
   <?php settings_fields('wccs_settings_group'); ?>
   
    <table class="widefat">
      <thead>
        <tr>
          <th scope="col" style="width: 40%;"><?php echo __('Category based sitemap Options','wccs'); ?></th><th></th>
        </tr>
      </thead>
      <tbody>
       
		


 </tbody>
	  
	 </table>
	  <div id="wccsveifystatus" style="display:none; background-color:#ffffe0; border-color: #e6db55;  border-width: 1px; border-style: solid; width :auto; height:auto;"> </div>
  <br /><br />
	<table class="widefat">
      <thead>
        <tr>
          <th scope="col" style="width: 40%;"><?php echo __('Sitemap Actions','wccs'); ?></th><th></th>
        </tr>
      </thead>

        <tbody>
	<tr><td><?php _e('Sitemap Address','wccs'); ?></td> <td><?php if (get_option('wccs_sitemap_url') != "Not generated yet") { ?> <a href="<?php echo get_option('wccs_sitemap_url'); ?>"><?php echo get_option('wccs_sitemap_url'); ?></a> <?php } else { echo "Not generated yet"; } ?></td></tr>
   <tr><td><font size="02" style="float:left"><?php echo __('Click on Generate sitemap to generate your sitemap ','wccs'); ?></font></td><td><div style="float:left;">&emsp;&emsp;&emsp;</div><input id="wccsgeneratesitemap" type="button" value="Generate Sitemap" class="button-primary" style="float:left;"  /><img  src="<?php echo wccs_PLUGIN_URL; ?>/images/ajax-loader.gif"  class="waiting" id="wccsgenerate" style="display:none; float:left;">&emsp;&emsp;&emsp;<b><?php _e('Previously Generated On','wccs'); ?>:</b><font color="green"><b><?php echo get_option('wccs_sitemap_generation_time'); ?></b></font></td>
   <tr><td><font size="02" style="float:left"><?php echo __('Click on Ping sitemap to notify sitemap to search engines','wccs'); ?></font></td><td><div style="float:left;">&emsp;&emsp;&emsp;</div><input id="wccspingsitemap" type="button" value="Notify search Engines" class="button-primary" style="float:left;"  /><img  src="<?php echo wccs_PLUGIN_URL; ?>/images/ajax-loader.gif"  class="waiting" id="wccsping" style="display:none; float:left;">&emsp;&emsp;<b><?php _e('Previous Ping Time','wccs'); ?>:</b><font color="green"><b><?php echo get_option('wccs_ping_time'); ?></b></font></td>
	  
		 <tr>
		 <td>
		 <label for="wccs_settings[autoupdate]"><font size="02"><?php _e( 'Automatically update sitemap when Product is updated(recommended)', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="wccs_settings[autoupdate]" name="wccs_settings[autoupdate]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['autoupdate'])) {echo "checked";}?> />
		  <label class="toggle-label" for="wccs_settings[autoupdate]">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>  
	  		 <tr>
		 <td>
		 <label for="wccs_settings[autoping]"><font size="02"><?php _e( 'Automatically ping sitemap when product is created (not recommended)', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="wccs_settings[autoping]" name="wccs_settings[autoping]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['autoping'])) {echo "checked";}?> />
		  <label class="toggle-label" for="wccs_settings[autoping]">
                <div class="toggle-internal"></div>
		 </td>
		 </tr> 
	  
	  
	  
	  </tbody>
	  
	 </table>
    <div id="wccssitemapgeneratestatus" style="display:none; background-color:#ffffe0; border-color: #e6db55;  border-width: 1px; border-style: solid; width :auto; height:auto;"> </div>
	<br /> <br />
	<table class="widefat">
      <thead>
        <tr>
          <th scope="col" style="width: 40%;"><?php echo __('Sitemap Settings','wccs'); ?></th><th></th>
        </tr>
      </thead>

        <tbody>

         <tr>
		 <td>
		 <label for="wccs_settings[folder]"><font size="02"><?php _e( 'Write sitemaps into a folder', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="_foldernamecheckbox"  name="wccs_settings[folder]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['folder'])) {echo "checked";}?> />
		  <label class="toggle-label" for="_foldernamecheckbox">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>
		 <tr id="_foldernametr" style="<?php if (!isset($wccs_options['folder'])) { echo "display:none;"; }  ?>">
		 <td>
		 <label for="wccs_settings[foldername]"><font size="02"><?php _e( 'folder name', 'wccs' ); ?></font></label>
		 <p><font size="01"> <?php echo __('Folder will be created by plugin so do not create it ','wccs'); ?> </font></p>
		 </td>
		 <td class="widefat">
		
       <input id="wccs_settings[foldername]" name="wccs_settings[foldername]"  type="text" value="<?php if (isset($wccs_options['foldername'])) { echo $wccs_options['foldername']; } else { echo "sitemap"; }?>"    />
		  
               
		 </td>
		 </tr>
		 
		          <tr>
		 <td>
		 <label for="wccs_settings[xmltitle]"><font size="02"><?php _e( 'use different sitemap name', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="_xmltitletrcheckbox" name="wccs_settings[xmltitle]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['xmltitle'])) {echo "checked";}?> />
		  <label class="toggle-label" for="_xmltitletrcheckbox">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>
		 <tr id="_xmltitletr" style="<?php if (!isset($wccs_options['xmltitle'])) { echo "display:none;"; }  ?>">
		 <td>
		 <label for="wccs_settings[xmltitlename]"><font size="02"><?php _e( 'file name', 'wccs' ); ?></font></label>
		
		 </td>
		 <td class="widefat">
		
       <input id="wccs_settings[xmltitlename]" name="wccs_settings[xmltitlename]"  type="text" value="<?php if ((isset($wccs_options['xmltitlename'])) && ($wccs_options['xmltitlename'] != '')) { echo $wccs_options['xmltitlename']; } else { echo "product_category_index"; }?>"    />
		  
               
		 </td>
		 </tr>
      
		 
		 <tr>
		 <td>
		 <label for="wccs_settings[gzip]"><font size="02"><?php _e( 'Use gzipped sitemap files instead of xml', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="wccs_settings[gzip]" name="wccs_settings[gzip]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['gzip'])) {echo "checked";}?> />
		  <label class="toggle-label" for="wccs_settings[gzip]">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>
		 
		  <tr>
		 <td>
		 <label for="wccs_settings[both]"><font size="02"><?php _e( 'Write both gzip and xml sitemaps', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		 <div class="toggle">
       <input id="_bothsitemaptrcheckbox" name="wccs_settings[both]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['both'])) {echo "checked";}?> />
		  <label class="toggle-label" for="_bothsitemaptrcheckbox">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>
             
	        <tr id="_bothsitemaptr" style="<?php if (!isset($wccs_options['both'])) { echo "display:none;"; }  ?>">
	  <td>
	 <font size="02"> <?php echo __('Which sitemap should be included in sitemap index','wccs'); ?></font>
	 <p><font size="01"> <?php echo __('In custom mode each category will have its own choice between xml and gz on product category edit page. ','wccs'); ?> </font></p>
	  </td>
	  <td>
	<label  for="wccs_settings[type]"></label>
  <input type="radio" name="wccs_settings[type]" id="wccs_settings[type]" value="01" <?php if ( (isset($wccs_options['type'])) && ($wccs_options['type'] == "01") ) {echo "checked";} ?> />
 <?php echo  __('xml','wccs'); ?>
&emsp;

  <input type="radio" name="wccs_settings[type]" id="wccs_settings[type]" value="02"  <?php if ( (isset($wccs_options['type'])) && ($wccs_options['type'] == "02") ) {echo "checked";} ?> />
 <?php echo __('gzip ','wccs'); ?>
&emsp;

  <input type="radio" name="wccs_settings[type]" id="wccs_settings[type]" value="03"  <?php if ( (isset($wccs_options['type'])) && ($wccs_options['type'] == "03") ) {echo "checked";} ?> />
 <?php echo __('Custom ','wccs'); ?>
&emsp;

 
	  </td>
	  </tr>
	  
	  	<tr>
		 <td>
		 <label for="wccs_settings[robots]"><font size="02"><?php _e( 'Add sitemap index file to robots.txt', 'wccs' ); ?></font></label>
		 </td>
		 <td class="widefat">
		  <div class="toggle">
       <input id="wccs_settings[robots]" name="wccs_settings[robots]" class="toggle-checkbox" type="checkbox" value="on"   <?php if (isset($wccs_options['robots'])) {echo "checked";}?> />
		   <label class="toggle-label" for="wccs_settings[robots]">
                <div class="toggle-internal"></div>
		 </td>
		 </tr>
	<?php if (!get_option('wccs_settings')) { 
	
	$wccs_options['catpriority'] = "0.5";
	$wccs_options['productpriority'] = "0.5";
	$wccs_options['catchange'] = "monthly";
	$wccs_options['productchange'] = "monthly";
	
	} ?>
  <tr>
  <td ><label for="wccs_settings[catpriority]"><?php
  _e('Default Category Priority','wccs'); ?></td>
  <td><div class="priorityselectbox">
  <select id="wccs_settings[catpriority]" name="wccs_settings[catpriority]">
  <option value="0.0" <?php selected($wccs_options['catpriority'],'0.0'); ?>>0.0</option>
  <option value="0.1" <?php selected($wccs_options['catpriority'],'0.1'); ?>>0.1</option>
  <option value="0.2" <?php selected($wccs_options['catpriority'],'0.2'); ?>>0.2</option>
  <option value="0.3" <?php selected($wccs_options['catpriority'],'0.3'); ?>>0.3</option>
  <option value="0.4" <?php selected($wccs_options['catpriority'],'0.4'); ?>>0.4</option>
  <option value="0.5" <?php selected($wccs_options['catpriority'],'0.5'); ?>>0.5</option>
  <option value="0.6" <?php selected($wccs_options['catpriority'],'0.6'); ?>>0.6</option>
  <option value="0.7" <?php selected($wccs_options['catpriority'],'0.7'); ?>>0.7</option>
  <option value="0.8" <?php selected($wccs_options['catpriority'],'0.8'); ?>>0.8</option>
  <option value="0.9" <?php selected($wccs_options['catpriority'],'0.9'); ?>>0.9</option>
  <option value="1.0" <?php selected($wccs_options['catpriority'],'1.0'); ?>>1.0</option>
  </select></div>
  </label>
  </td>
  </tr>
  
  <tr>
  <td ><label for="wccs_settings[productpriority]"><?php
  _e('Default Single Product Priority','wccs'); ?></td>
  <td><div class="priorityselectbox">
  <select id="wccs_settings[productpriority]" name="wccs_settings[productpriority]">
  <option value="0.0" <?php selected($wccs_options['productpriority'],'0.0'); ?>>0.0</option>
  <option value="0.1" <?php selected($wccs_options['productpriority'],'0.1'); ?>>0.1</option>
  <option value="0.2" <?php selected($wccs_options['productpriority'],'0.2'); ?>>0.2</option>
  <option value="0.3" <?php selected($wccs_options['productpriority'],'0.3'); ?>>0.3</option>
  <option value="0.4" <?php selected($wccs_options['productpriority'],'0.4'); ?>>0.4</option>
  <option value="0.5" <?php selected($wccs_options['productpriority'],'0.5'); ?>>0.5</option>
  <option value="0.6" <?php selected($wccs_options['productpriority'],'0.6'); ?>>0.6</option>
  <option value="0.7" <?php selected($wccs_options['productpriority'],'0.7'); ?>>0.7</option>
  <option value="0.8" <?php selected($wccs_options['productpriority'],'0.8'); ?>>0.8</option>
  <option value="0.9" <?php selected($wccs_options['productpriority'],'0.9'); ?>>0.9</option>
  <option value="1.0" <?php selected($wccs_options['productpriority'],'1.0'); ?>>1.0</option>
  </select></div>
  </label>
  </td>
  </tr>
  
    <tr>
   <td ><label for="wccs_settings[catchange]"><?php
  _e('Default Product Category Frequency','wccs'); ?></td>
  <td><div class="adminselectbox"><select id="wccs_settings[catchange]" name="wccs_settings[catchange]">
  <option value="always" <?php selected($wccs_options['catchange'],'always'); ?>>Always</option>
  <option value="hourly" <?php selected($wccs_options['catchange'],'hourly'); ?>>Hourly</option>
  <option value="daily" <?php selected($wccs_options['catchange'],'daily'); ?>>Daily</option>
  <option value="weekly" <?php selected($wccs_options['catchange'],'weekly'); ?>>Weekly</option>
  <option value="monthly" <?php selected($wccs_options['catchange'],'monthly'); ?>>Monthly</option>
  <option value="yearly" <?php selected($wccs_options['catchange'],'yearly'); ?>>Yearly</option>
   <option value="never" <?php selected($wccs_options['catchange'],'never'); ?>>Never</option>
  </select></label></div> </td>
  </tr>
 
  <tr>
   <td ><label for="wccs_settings[productchange]"><?php
  _e('Default Single Product change Frequency','wccs'); ?></td>
  <td><div class="adminselectbox"><select id="wccs_settings[productchange]" name="wccs_settings[productchange]">
  <option value="always" <?php selected($wccs_options['productchange'],'always'); ?>>Always</option>
  <option value="hourly" <?php selected($wccs_options['productchange'],'hourly'); ?>>Hourly</option>
  <option value="daily" <?php selected($wccs_options['productchange'],'daily'); ?>>Daily</option>
  <option value="weekly" <?php selected($wccs_options['productchange'],'weekly'); ?>>Weekly</option>
  <option value="monthly" <?php selected($wccs_options['productchange'],'monthly'); ?>>Monthly</option>
  <option value="yearly" <?php selected($wccs_options['productchange'],'yearly'); ?>>Yearly</option>
   <option value="never" <?php selected($wccs_options['productchange'],'never'); ?>>Never</option>
  </select></div> </label></td>
  <tr><td>
  <p><font size="01"><?php _e('Note:priority of any URL is relative to other URLs on your site.This value has no effect on your pages compared to pages on other sites.','wccs'); ?></font><p>
  </td>
  </tr>
  
  
 
		 
		<?php 
		$sitemaplocaton = get_option('wccs_sitemap_url');
		if (isset($wccs_options['robots'])) {
    $file = ''.ABSPATH.'robots.txt';
	
    $sitemapurl="Sitemap: $sitemaplocaton \n";
    // Open the file to get existing content
    $current = file_get_contents($file);
    $current = str_replace($sitemapurl, "", $current);
    $current .= $sitemapurl;
    // Write the contents back to the file
    file_put_contents($file, $current);
	} else  {
	 $file = ''.ABSPATH.'robots.txt';
	$sitemapurl="Sitemap: $sitemaplocaton \n";
    // Open the file to get existing content
    $current = file_get_contents($file);
    $current = str_replace($sitemapurl, "", $current);

    file_put_contents($file, $current);
	}
	
	if ( isset($wccs_options['folder']) && $wccs_options['foldername'] !='' ) {
	 $dir="".ABSPATH."/".$wccs_options['foldername']."";
	   if (!is_dir($dir)) {
	   mkdir($dir, 0700);
	   }
	}
	?> </tbody>
	  
	 </table>
	 <br /><br />



 
<br /><br />
  <center>   <input type="submit" class="button-primary" value="<?php echo __('update option','wccs'); ?>" /> </center>
   
  </form>


  </div>
