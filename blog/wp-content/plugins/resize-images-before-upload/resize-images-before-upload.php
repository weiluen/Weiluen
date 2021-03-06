<?php
/*
Plugin Name: Resize images before upload
Plugin URI: https://github.com/WPsites/Resize-images-before-upload
Description: Resize your images before they are uploaded to the server, no need to use image editing software. You can drag+drop images straight from your digital camera right into WordPress
Version: 0.6
Author: Simon @ WPsites
Author URI: http://www.wpsites.co.uk
License: GPL3
*/

if ( ! defined( 'RIBU_RESIZE_WIDTH' ) )
       define( 'RIBU_RESIZE_WIDTH', 'resize_width' );
 if ( ! defined( 'RIBU_RESIZE_HIGHT' ) )
       define( 'RIBU_RESIZE_HEIGHT', 'resize_height' );
       
       
class WP_Resize_Images_Before_Upload {
		
	/**
	 * The constructor 
	 * @return void
	 */
	function __construct() {

            add_filter('plupload_init', array($this,'plupload_init'),10,1);
	    
	    add_action('post-upload-ui', array($this,'rbu_show_option'),10);
	    
	    
	    add_action('admin_init', array($this,'admin_init_settings'));

	}


	
	function rbu_show_option(){
		$quality =  $this->get_resize_quality() ;
		echo "<p><input name='image_resize' id='image_resize' type='checkbox' value='HellYea'  /> " . __('Resize images before uploading them to the server.') . " " . __('Images will be resized to the large image dimensions, as specified in your media settings') . "</p>";
		echo "<script> jQuery(window).load(function($){
		
		jQuery('#image_resize').click();
		jQuery('.max-upload-size').css('display', 'none');
		
		uploader.settings['resize'] = { width: ". RIBU_RESIZE_WIDTH .", height: ". RIBU_RESIZE_HEIGHT .", quality: ${quality} };

		
			jQuery('#image_resize').click(function(event){
				if (jQuery('#image_resize').is(':checked')){
					jQuery('.max-upload-size').css('display', 'none');
					//uploader.settings['resize'] = { width: ". RIBU_RESIZE_WIDTH .", height: ". RIBU_RESIZE_HEIGHT .", quality: ${quality} };
				}else{
					jQuery('.max-upload-size').css('display', 'inline');
				}
				return true;
			});
			
		//flash uploader seems to need an extra nudge with the resize settings
		jQuery('div.plupload.flash').load(function($){
			uploader.settings['resize'] = { width: ". RIBU_RESIZE_WIDTH .", height: ". RIBU_RESIZE_HEIGHT .", quality: ${quality} };
		});
		
			
		
		});</script>";
		
		if ( $this->incompatible_browser() && !isset($_GET['you_toldmeabout_flash']) ){
		
		    ?>
				<script>
				    if(typeof navigator.plugins['Shockwave Flash']=='undefined'){
					
					alert('<?php echo __('The Adobe Flash plug-in is required for automatic image resizing in your browser.'); ?>');
					
					location.href = location.href + "&you_toldmeabout_flash=donttellmeagain";
				    }
				</script>
		    <?php
		
		}
		
		
	}

        function plupload_init($plupload_init_array){
            //remove max file size
             unset($plupload_init_array['max_file_size']);
             
             //change runtime to flash for non firefox/chrome browsers, unless this action is cancelled by the rbu_cancel_force_flash setting
	     if (!get_option('rbu_cancel_force_flash')){
		
		// if incompatible and we havent told them about flash being missing then lets use flash runtime -
		// we can't be sure if they have flash though - and if they don't we'll load this again after telling them about no resize/flash, once told we will just roll without flash, no resize possible
		if ( $this->incompatible_browser() && !isset($_GET['you_toldmeabout_flash']) ){
			$plupload_init_array['runtimes'] = "flash"; // 'runtimes' => 'html5,silverlight,flash,html4',
		}
		
	     }

            
            return $plupload_init_array;
        }
	
	// Register and define the settings
	function admin_init_settings(){
		
		//create settings section
		add_settings_section('rbu_media_settings_section',
				'Resize before upload',
				array($this,'media_settings_section_callback_function'),
				'media');
		
		// settings, put it in our new section
		add_settings_field('rbu_resize_quality',
			'Resize quality',
			array($this,'resize_quality_callback_function'),
			'media',
			'rbu_media_settings_section');
		
		add_settings_field('rbu_cancel_force_flash',
			'Disable force flash',
			array($this,'cancel_force_flash_callback_function'),
			'media',
			'rbu_media_settings_section');
		
		// Register our setting so that $_POST handling is done for us and
		register_setting('media',
				 'rbu_resize_quality',
				 array($this,'resize_quality_validate_input') );
		register_setting('media',
				 'rbu_cancel_force_flash',
				 array($this,'cancel_force_flash_validate_input') );
	
	}
	
	function media_settings_section_callback_function(){
		//output nothing at this stage.
	}
	
	function resize_quality_callback_function(){
		echo '<input name="rbu_resize_quality" id="rbu_resize_quality" type="text" value="'. $this->get_resize_quality() .'" class="small-text" /> <em class="description">1 - 100   (a low quality value will result in a considerably smaller file size and lower quality images - 80 is optimum)</em>';
	}
	
	function cancel_force_flash_callback_function(){
		echo '<input name="rbu_cancel_force_flash" id="rbu_cancel_force_flash" type="checkbox" value="1" ' . checked( 1, get_option('rbu_cancel_force_flash'), false ) . ' class="small-text" /> <em class="description">Do not force the Flash uploader for non Chrome/Firefox browsers.</em>';
	}
	
	function incompatible_browser(){
	    
		if (! preg_match("#Firefox|Chrome#", $_SERVER['HTTP_USER_AGENT']) ){
			return true;
		}
		
		return false;
	}
	
	function resize_quality_validate_input($quality){
		
		$quality = absint( $quality ); //validate
		
		if ($quality > 0 && $quality < 101){
			return $quality;
		}else{
			add_settings_error(
				'rbu_resize_quality',           // setting title
				'rbu_resize_quality_error',            // error ID
				'Invalid resize quality, a value between 1-100 is required -  so a default value of 80 has been set.',   // error message
				'error'                        // type of message
			);
			return 80;
		}
		
	}
	
	function cancel_force_flash_validate_input($val){
		
		if ($val === "" || $val == 1){
			return $val;
		}else{
			add_settings_error(
				'cancel_force_flash',           // setting title
				'cancel_force_flash_error',            // error ID
				'Cancel force flash is either enabled or not',   // error message
				'error'                        // type of message
			);
			return "";
		}
		
	}
	
	function get_resize_quality(){
		
		//get quality out of settings
		$quality = get_option('rbu_resize_quality');
		
		//return quality or default setting 
		if ($quality > 0 && $quality < 101){
			return $quality;
		}else{
			return 80;
		}
	}

}

/**
 * Register the plugin - unless we have told them about a flash problem in which case this plugin is useless
 */
if ( !isset($_GET['you_toldmeabout_flash']) ){
    add_action("init", create_function('', 'new WP_Resize_Images_Before_Upload();'));
}

// Ending PHP tag is not needed, it will only increase the risk of white space 
// being sent to the browser before any HTTP headers.