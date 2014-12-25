jQuery(document).ready(function($) {
$('#wccsgeneratesitemap').click(function() {
       document.getElementById('wccsgenerate').style.display = "block";
	   document.getElementById('wccsgeneratesitemap').value= "Generating Sitemap";
	   console.log('Generating Sitemap');
	  

        $.ajax({
            data: {action: "wcgenerate_sitemap" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			 document.getElementById('wccssitemapgeneratestatus').innerHTML = response;
	         document.getElementById('wccsgenerate').style.display = "none";
			 document.getElementById('wccssitemapgeneratestatus').style.display = "block";
			 document.getElementById('wccsgeneratesitemap').value= "Re-generate sitemap";
			 
			console.log('your sitemap has been generated successfully  ' + response); 
			   setTimeout(function(){
             location.reload();
             }, 3000);
			 }
        });
});

$('#wccspingsitemap').click(function() {
       document.getElementById('wccsping').style.display = "block";
	   document.getElementById('wccspingsitemap').value= "Generating Sitemap";
	   console.log('Generating Sitemap');
	  

        $.ajax({
            data: {action: "wccsping_sitemap" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			 document.getElementById('wccssitemapgeneratestatus').innerHTML = response;
	         document.getElementById('wccsping').style.display = "none";
			 document.getElementById('wccssitemapgeneratestatus').style.display = "block";
			 document.getElementById('wccspingsitemap').value= "Notified";
			 
			console.log('your sitemap has been  successfully notified ' + response);
              
			}
        });
});




    $('#_foldernamecheckbox').change(function(){
        if(this.checked) {
		    
            $('#_foldernametr').show('slow');
			
			 
		}	
			 
        else {
            $('#_foldernametr').hide('slow');
			
            
			}

    });
	
	    $('#_xmltitletrcheckbox').change(function(){
        if(this.checked) {
		    
            $('#_xmltitletr').show('slow');
			
			 
		}	
			 
        else {
            $('#_xmltitletr').hide('slow');
			
            
			}

    });
	
	    $('#_bothsitemaptrcheckbox').change(function(){
        if(this.checked) {
		    
            $('#_bothsitemaptr').show('slow');
			
			 
		}	
			 
        else {
            $('#_bothsitemaptr').hide('slow');
			
            
			}

    });




}
);

 

