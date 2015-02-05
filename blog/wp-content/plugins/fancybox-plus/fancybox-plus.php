<?php
/*
Plugin Name: Fancybox Plus
Plugin URI: http://pferdecamp.us/wordpress-plugins/fancybox-plus/
Description: Seamless integration of Fancybox (similar to Lightview, Lightbox, Thickbox, Floatbox) to create a nice overlay to display images and videos without the need to change html. Further it shows youtube, vimeo and blip.tv videos in the overlay.
Author: Puzich
Author URI: http://www.pferdecamp.us
Version: 1.0.1
Put in /wp-content/plugins/ of your Wordpress installation
*/

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wp_version;
define('LVPISWP27', version_compare($wp_version, '2.7', '>='));
define('LVPISWP28', version_compare($wp_version, '2.8', '>='));
define('LVPISWP29', version_compare($wp_version, '2.9', '>='));
define('LVPISWP30', version_compare($wp_version, '3.0', '>='));
define('LVPISWP31', version_compare($wp_version, '3.1', '>='));


require_once(dirname(__FILE__) . '/libs/core.php');

class fancybox_plus extends plus_core {
	
	// core object
	var $core;
	
	// version
	var $version;
	
	// plugin name
	var $pluginname = 'Fancybox Plus';

	// Nag Check Url
	var $chk_url = 'http://chk.puzich.com/';
	
	var $adminPanel;
	
	
	// be compatible to php4
	function fancybox_plus() {
		$this->__construct();
	} 
	
	
	function __construct() {

		// install default options
		register_activation_hook(__FILE__, array(&$this, 'install'));
		
		// update options (exists since wp 3.1)
		if(function_exists('register_update_hook')) {
			register_update_hook(__FILE__, array(&$this, 'install'));
		}

		// uninstall features
		//register_deactivation_hook(__FILE__, array(&$this, 'uninstall'));
				
		//load language
		if (function_exists('load_plugin_textdomain'))
			load_plugin_textdomain( $this->_get_plugin_name(), false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
			
		// set video targets
		$this->videotargets();
		
		// set version
		$this->version = $this->get_version();
		
		// more setup links
		add_filter('plugin_row_meta', array(&$this, 'register_plugin_links'), 10, 2);
		
		// nagscreen at plugins page
		add_action('after_plugin_row', array(&$this, 'plugin_version_nag'));
 			
		// add wp-filter
		add_filter('the_content', array(&$this, 'change_content'), 150);
		
		// add wp-action
		// use wp_enqueue_scripts from WP2.8 and above
		add_action('wp_enqueue_scripts', array(&$this, 'enqueueJS'));
		add_action('wp_enqueue_scripts', array(&$this, 'enqueueCSS'));
		add_action('wp_head', array(&$this, 'add_header'));
		
		// add settings menu
		add_action('admin_init', array(&$this, 'AdminHeader'));
		add_action('admin_menu', array(&$this, 'AdminMenu'));
		
		//add wp-shortcodes
		if($this->get_option('load_gallery') && LVPISWP28 == true)
			add_filter('attachment_link', array(&$this, 'direct_image_urls_for_galleries'), 10, 2);
					
		// add MCE Editor Button
		if($this->get_option('show_video')) {
			add_action('init', array(&$this, 'mceinit'));
			add_action('admin_print_scripts', array(&$this, 'mce_header'));
		}
		
	}
	
	
	function register_plugin_links($links, $file) {
		$base = plugin_basename(__FILE__);
		if ($file == $base) {
			$links[] = '<a href="options-general.php?page=' . $base .'">' . __('Settings', $this->_get_plugin_name()) . '</a>';
			$links[] = '<a href="http://www.puzich.com/wordpress-plugins/fancybox-de">' . __('Support', $this->_get_plugin_name()) . '</a>';
			$links[] = '<a href="http://www.puzich.com/go/donate/">' . __('Donate with PayPal', $this->_get_plugin_name()) . '</a>';
			$links[] = '<a href="http://www.puzich.com/go/wishlist/">' . __('Donate with Amazon Wishlist', $this->_get_plugin_name()) . '</a>';
		}

		return $links;
	}
	

	// nagscreen at plugins page, based on the code of cformsII by Oliver Seidel
	function plugin_version_nag($plugin) {
		if (preg_match('/fancybox-plus/i', $plugin)) {
			$checkfile = $this->chk_url . 'fancybox-plus.' . $this->version . '.chk';
			$this->plugin_version_get($checkfile, $this->version);
		}
	}
	
	
	function plugin_version_get($checkfile, $version, $tr=false) {
		$vcheck = wp_remote_fopen($checkfile);
		
		if($vcheck) {
			$status = explode('@', $vcheck);
				$theVersion = $status[1];
				$theMessage = $status[3];
			
				if( $theMessage ) {
					if($tr == true)
						echo '</tr><tr>';
			
					if(version_compare($theVersion, $version) == 0) {
						$msg = __("Notice for:", $this->_get_plugin_name());
					} else {
						$msg = __("Update-Notice for:", $this->_get_plugin_name());
					}
				
					$msg .= ' <strong> Version '.$theVersion.'</strong><br />'.$theMessage;
					echo '<td colspan="5" class="plugin-update" style="line-height:1.2em;">'.$msg.'</td>';
				}
            
				if (version_compare($theVersion, $version) == 1) {
					$checkfile = $this->chk_url . 'fancybox-plus.' . $theVersion . '.chk';
					$this->plugin_version_get($checkfile, $theVersion, true);
				}
        }
    }


	// Returns the plugin version
	function get_version() {
		if(!function_exists('get_plugin_data')) {
			if(file_exists(ABSPATH . 'wp-admin/includes/plugin.php')) {
				require_once(ABSPATH . 'wp-admin/includes/plugin.php'); //2.3+
			} elseif (file_exists(ABSPATH . 'wp-admin/admin-functions.php')) {
				require_once(ABSPATH . 'wp-admin/admin-functions.php'); //2.1
			} else { 
				return "ERROR: couldn't get version";
			}
		}
		$data = get_plugin_data(__FILE__, false, false);
		
		return $data['Version'];
	}
	

	function install() {
		//add default options
		$default = array(
					'load_from_google' => 0,
					'load_gallery' => 1,
					'show_video' => 1,
					'video_showlink' => 1,
					'video_smallink' => 1,
					'video_preview_width'=> 300,
					'video_width' => 500,
					'video_separator' => '- ',
					'video_showinfeed' => 1,
					'video_debug' => 0,
					'fb_opacity' => 1,
					'fb_speedIn' => 300,
					'fb_speedOut' => 300,
					'fb_transitionInToggle' => 1,
					'fb_transitionIn' => 'fade',
					'fb_transitionOutToggle' => 1,
					'fb_transitionOut' => 'fade',
					'fb_titleShow'	=>	1,
					'fb_titlePosition' => 'outside',
					'fb_overlayColor' => '#060606'
					);
					
		// init options
		$this->init_plugin_options();
		
		// set default values, if they doesn't exist
		foreach ($default as $k => $v) {
			$i = $this->get_option($k);
			if(empty($i)) {
				$this->update_option($k, $v);
			}
		}
		
		// delete video cache data
		$this->delete_video_cache();
		
		return true;
	}
	
	
	// add fancybox and libraries
	function enqueueJS() {
			
		// load javascript librarys from google
		if ($this->get_option('load_from_google')) {
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.js', false, '1.4', false);
		} 
		
		wp_enqueue_script('fancybox', plugins_url('/fancybox-plus/fancybox/jquery.fancybox-1.3.4.pack.js'), array('jquery', 'jquery_metadata', 'jquery_easing', 'jquery_mousewheel'), $this->version, false);
		wp_enqueue_script('jquery_metadata', plugins_url('/fancybox-plus/js/jquery.metadata.pack.js'), array('jquery'), $this->version, false);
		wp_enqueue_script('jquery_easing', plugins_url('/fancybox-plus/fancybox/jquery.easing-1.3.pack.js'), array('jquery'), $this->version, false);
		wp_enqueue_script('jquery_mousewheel', plugins_url('/fancybox-plus/fancybox/jquery.mousewheel-3.0.4.pack.js'), array('jquery'), $this->version, false);
	}
	
	// add css
	function enqueueCSS() {
		wp_enqueue_style('fancybox', plugins_url('/fancybox-plus/fancybox/jquery.fancybox-1.3.4.css'), false, $this->version, 'screen');
		wp_enqueue_style('fancybox_plus', plugins_url('/fancybox-plus/css/style.css'), false, $this->version, 'screen');		
	}
	
	function add_header() {
		$path = "/wp-content/plugins/fancybox-plus";
		
		$script = "\n<!-- Fancybox Plus Plugin $this->version -->\n";
		
		// get some options before
		($this->get_option('fb_opacity')) ? $fb_opacity = 'true' : $fb_opacity = 'false';
		($this->get_option('fb_titleShow')) ? $fb_titleShow = 'true' : $fb_titleShow = 'false';
		
		
		
		$script .= '<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("a.fancyboxgroup").fancybox({
					\'transitionIn\'	:	\'' . $this->get_option('fb_transitionIn') . '\',
					\'transitionOut\'	:	\'' . $this->get_option('fb_transitionOut') . '\',
					\'speedIn\'			:	' . $this->get_option('fb_speedIn') . ', 
					\'speedOut\'		:	' . $this->get_option('fb_speedOut') . ', 
					\'opacity\'			: 	' . $fb_opacity. ',
					\'titleShow\'		:	' . $fb_titleShow  . ',
					\'titlePosition\'	:	\'' . $this->get_option('fb_titlePosition') . '\',
					\'overlayColor\'	: 	\'' . $this->get_option('fb_overlayColor') . '\',
					\'overlayOpacity\'	:	0.8,
					\'overlayShow\'		:	true

				});
				
				jQuery("a.fancyboxiframe").fancybox({
					\'transitionIn\'	:	\'' . $this->get_option('fb_transitionIn') . '\',
					\'transitionOut\'	:	\'' . $this->get_option('fb_transitionOut') . '\',
					\'speedIn\'			:	' . $this->get_option('fb_speedIn') . ', 
					\'speedOut\'		:	' . $this->get_option('fb_speedOut') . ', 
					\'opacity\'			: 	' . $fb_opacity . ',
					\'titleShow\'		:	' . $fb_titleShow  . ',
					\'titlePosition\'	:	\'' . $this->get_option('fb_titlePosition') . '\',
					\'overlayShow\'		:	true,
					\'type\'			:	\'iframe\'
				});
				
				jQuery("a.fancyboxflash").fancybox({
					\'transitionIn\'	:	\'' . $this->get_option('fb_transitionIn') . '\',
					\'transitionOut\'	:	\'' . $this->get_option('fb_transitionOut') . '\',
					\'speedIn\'			:	' . $this->get_option('fb_speedIn') . ', 
					\'speedOut\'		:	' . $this->get_option('fb_speedOut') . ', 
					\'opacity\'			: 	' . $fb_opacity . ',
					\'titleShow\'		:	' . $fb_titleShow  . ',
					\'titlePosition\'	:	\'' . $this->get_option('fb_titlePosition') . '\',
					\'overlayShow\'		:	true,
					\'type\'			:	\'flash\'
				});
			});
		</script>';
		$script .= "\n<!-- Fancybox Plus Plugin $this->version -->\n";
		
		echo $script;
	}
	
	
	function AdminMenu() {
		add_options_page('Fanybox Plus Options', '<img src="' . @plugins_url('fancybox-plus/img/icon.png') . '" width="10" height="10" alt="Fancybox Plus - Icon" /> ' . 'Fancybox Plus', 'manage_options', $this->_get_plugin_name().'/'.basename(__FILE__), array(&$this, 'OptionsMenu'));	
	}
	
	
	function AdminHeader() {
		wp_enqueue_script('plus_script', plugins_url($this->_get_plugin_name().'/js/admin.js'), array('jquery'), $this->version);
		wp_enqueue_script('mColorPicker', plugins_url($this->_get_plugin_name().'/js/mColorPicker.js'), array('jquery'), $this->version);
		wp_enqueue_style('plus_style', plugins_url($this->_get_plugin_name().'/css/admin.css'), false, $this->version, 'screen');
	}
	
	function show_help($text) {
		echo sprintf('[<a href="" class="tiptip_right" title="%s">?</a>]', $text);
	}

	function OptionsMenu() {

		if (!empty($_POST)) {
			// for security
			check_admin_referer('fancybox-plus/'.basename(__FILE__));
			
			$options = array(
							'load_from_google'		=> (bool)(!empty($_POST['load_from_google'])),
							'load_gallery'			=> (bool)(!empty($_POST['load_gallery'])),
							'show_video'			=> (bool)(!empty($_POST['show_video'])),
							'video_showlink'		=> (bool)(!empty($_POST['video_showlink'])),
							'video_smallink'		=> (bool)(!empty($_POST['video_smallink'])),
							'video_showinfeed'		=> (bool)(!empty($_POST['video_showinfeed'])),
							'video_debug'			=> (bool)(!empty($_POST['video_debug'])),
							'fb_opacity'			=> (bool)(!empty($_POST['fb_opacity'])),
							'fb_titleShow'			=> (bool)(!empty($_POST['fb_titleShow'])),
							'fb_titlePosition'		=>	$_POST['fb_titlePosition']
						);
						
			if(!empty($_POST['video_preview_width'])) {
				$options['video_preview_width'] = (int)$_POST['video_preview_width'];
			}

			if(!empty($_POST['video_width'])) {
				$options['video_width'] = (int)$_POST['video_width'];
			}

			if(!empty($_POST['video_separator'])) {
				$options['video_separator'] = (string)$_POST['video_separator'];
			}
			
			if(isset($_POST['fb_transitionInToggle'])) {
				$options['fb_transitionInToggle']	= (bool)(!empty($_POST['fb_transitionInToggle']));	
				$options['fb_transitionIn']			= $_POST['fb_transitionIn'];
				$options['fb_speedIn'] 				= (int)$_POST['fb_speedIn'];
			} else {
				$options['fb_transitionInToggle']	= (bool)(!empty($_POST['fb_transitionInToggle']));
				$options['fb_transitionIn']			= 'none';
			}
			
			if(isset($_POST['fb_transitionOutToggle'])) {
				$options['fb_transitionOutToggle']	= (bool)(!empty($_POST['fb_transitionOutToggle']));
				$options['fb_transitionOut']	=	$_POST['fb_transitionOut'];
				$options['fb_speedOut']			= (int)$_POST['fb_speedOut'];
			} else {
				$options['fb_transitionOutToggle']	= (bool)(!empty($_POST['fb_transitionOutToggle']));
				$options['fb_transitionOut']		=	'none';
			}
				
			if(!empty($_POST['fb_overlayColor'])) {
				$options['fb_overlayColor'] = (string)$_POST['fb_overlayColor'];
			}		
			
			
			$this->update_options($options); ?>
			<div id="message" class="updated fade"><p>
			<strong><?php esc_html_e('Settings saved.') ?></strong>
			</p></div>
<?php	}	?>
		<div class="wrap"><h2>Fancybox Plus</h2>
		<form method="post" action="">
		<?php wp_nonce_field($this->_get_plugin_name() . '/' . basename(__FILE__)); ?>
		
		<div id="poststuff">
			<div class="postbox">
				<h3><?php esc_html_e('Settings') ?></h3>
				<div class="inside">
					<ul><li><div>
						<input type="checkbox" name="load_from_google" id="load_from_google" value="1" <?php checked($this->get_option('load_from_google'), 1) ?> />
						<label for="load_from_google"><?php esc_html_e('Load jQuery Library from Google', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div></li></ul>
					<ul><li><div>
						<input type="checkbox" name="load_gallery" id="load_gallery" value="1" <?php checked($this->get_option('load_gallery'), 1) ?> />
						<label for="load_gallery"><?php esc_html_e('Activate Fancybox for [gallery]?', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('If activated, it shows the wordpress gallery with fancybox', $this->_get_plugin_name())); ?>
					</div></li></ul>
				
					<ul><li><div>
						<input type="checkbox" name="show_video" id="show_video" value="1" <?php checked($this->get_option('show_video'), 1) ?> />
						<label for="show_video"><?php esc_html_e('Activate Fancybox for Videos', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Implements the video function. ATTENTION: It only works, if you do not have the embedded video plugin activated', $this->_get_plugin_name())); ?>
					</div>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_showlink" id="video_showlink" value="1" <?php checked($this->get_option('video_showlink'), 1) ?> />
							<label for="video_showlink"><?php esc_html_e('Show Links under videos', $this->_get_plugin_name()) ?></label>
							&nbsp;<?php $this->show_help(__('Show a link to the original site of the video', $this->_get_plugin_name())); ?>
						</div>
							<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
								<input type="checkbox" name="video_smallink" id="video_smallink" value="1" <?php checked($this->get_option('video_smallink'), 1) ?> />
								<label for="video_smallink"><?php esc_html_e('Show a small Link under the Video', $this->_get_plugin_name()) ?></label>
								&nbsp;<?php $this->show_help(__('The video link will be shown smaller', $this->_get_plugin_name())); ?>
							</div></li></ul>
						</li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_separator"><?php esc_html_e('Separator', $this->_get_plugin_name()) ?>
							&nbsp;<?php $this->show_help(__('Defines the separator between the service (eg. YouTube) and your comment', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_separator" id="video_separator" value="<?php echo esc_attr($this->get_option('video_separator')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_preview_width"><?php esc_html_e('Video Preview Width (in px)', $this->_get_plugin_name()) ?>
								&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_preview_width" id="video_preview_width" value="<?php echo esc_attr($this->get_option('video_preview_width')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_width"><?php esc_html_e('Video Width (in px)', $this->_get_plugin_name()) ?>
								&nbsp;<?php $this->show_help(__('You can choose, what width the video and image have', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_width" id="video_width" value="<?php echo esc_attr($this->get_option('video_width')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_showinfeed" id="video_showinfeed" value="1" <?php checked($this->get_option('video_showinfeed'), 1) ?> />
							<label for="video_showinfeed"><?php esc_html_e('Show video in feed', $this->_get_plugin_name()) ?></label>
								&nbsp;<?php $this->show_help(__('Shows the video in the feed. Otherwise the preview image of the video is shown, with a link to your website.', $this->_get_plugin_name())); ?>
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_debug" id="video_debug" value="1" <?php checked($this->get_option('video_debug'), 1) ?> />
							<label for="video_debug"><?php esc_html_e('Show Video Debug Infos', $this->_get_plugin_name()) ?></label>
							&nbsp;<?php $this->show_help(__('Shows video informations, like embed url or image url of the video. Only for debug!', $this->_get_plugin_name())); ?>						
						</div></li></ul>
					</li></ul>

					<ul><li><div>
						<input type="checkbox" name="fb_opacity" id="fb_opacity" value="1" <?php checked($this->get_option('fb_opacity'), 1) ?> />
						<label for="fb_opacity"><?php esc_html_e('Changes transparency of content for elastic transitions', $this->_get_plugin_name()) ?></label>
						<?php //   &nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div></li></ul>
					
					<ul><li><div>
						<?php /*<input type="checkbox" name="fb_transitionInToggle" id="fb_transitionInToggle" value="1" <?php if ( $this->get_option('fb_transitionIn') == "elastic" || $this->get_option('fb_transitionIn') == "fade" ) echo 'checked="checked"'; ?> /> */ ?>
						<input type="checkbox" name="fb_transitionInToggle" id="fb_transitionInToggle" value="1" <?php checked($this->get_option('fb_transitionInToggle'), 1) ?> />
						<label for="fb_transitionInToggle"><?php esc_html_e('Transition In Effect', $this->_get_plugin_name()) ?></label>
						<?php //   &nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div>
					<ul class="shift <?php echo ($this->get_option('fb_transitionInToggle') ? '' : 'inact') ?>"><li><div>
						<label for="fb_transitionIn"><?php esc_html_e('Transition type for the fadein', $this->_get_plugin_name()) ?>
						<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
						<select name="fb_transitionIn" size="1">
							<option value="elastic" <?php selected($this->get_option('fb_transitionIn'), "elastic") ?> class="small-text code">elastic</option>
							<option value="fade" <?php selected($this->get_option('fb_transitionIn'), "fade") ?> class="small-text code">fade</option>
						</select>
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('fb_transitionInToggle') ? '' : 'inact') ?>"><li><div>
						<label for="fb_speedIn"><?php esc_html_e('Speed of the fadein and elastic transitions, in milliseconds', $this->_get_plugin_name()) ?>
						<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
						<input type="text" name="fb_speedIn" id="fb_speedIn" value="<?php echo esc_attr($this->get_option('fb_speedIn')); ?>" class="small-text code" />
					</div></li></ul>
					</li></ul>
					
					<ul><li><div>
						<input type="checkbox" name="fb_transitionOutToggle" id="fb_transitionOutToggle" value="1" <?php checked($this->get_option('fb_transitionOutToggle'), 1) ?> />
						<label for="fb_transitionOutToggle"><?php esc_html_e('Transition Out Effect', $this->_get_plugin_name()) ?></label>
						<?php //   &nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div>
					<ul class="shift <?php echo ($this->get_option('fb_transitionOutToggle') ? '' : 'inact') ?>"><li><div>
						<label for="fb_transitionOut"><?php esc_html_e('Transition type for the fadeout', $this->_get_plugin_name()) ?>
						<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
						<select name="fb_transitionOut" size="1">
							<option value="elastic" <?php selected($this->get_option('fb_transitionOut'), "elastic") ?> class="small-text code">elastic</option>
							<option value="fade" <?php selected($this->get_option('fb_transitionOut'), "fade") ?> class="small-text code">fade</option>
						</select>
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('fb_transitionOutToggle') ? '' : 'inact') ?>"><li><div>
						<label for="fb_speedOut"><?php esc_html_e('Speed of the fadeout and elastic transitions, in milliseconds', $this->_get_plugin_name()) ?>
						<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
						<input type="text" name="fb_speedOut" id="fb_speedOut" value="<?php echo esc_attr($this->get_option('fb_speedOut')); ?>" class="small-text code" />
					</div></li></ul>
					</li></ul>
					
					<ul><li><div>
						<input type="checkbox" name="fb_titleShow" id="fb_titleShow" value="1" <?php checked($this->get_option('fb_titleShow'), 1) ?> />
						<label for="fb_titleShow"><?php esc_html_e('Toggle title', $this->_get_plugin_name()) ?></label>
						<?php //   &nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div>
						<ul class="shift <?php echo ($this->get_option('fb_titleShow') ? '' : 'inact') ?>"><li><div>
							<label for="fb_titlePosition"><?php esc_html_e('Position of title.', $this->_get_plugin_name()) ?>
							<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
							<select name="fb_titlePosition" size="1">
								<option value="outside" <?php selected($this->get_option('fb_titlePosition'), "outside") ?> class="small-text code">outside</option>
								<option value="inside" <?php selected($this->get_option('fb_titlePosition'), "inside") ?> class="small-text code">inside</option>
								<option value="over" <?php selected($this->get_option('fb_titlePosition'), "over") ?> class="small-text code">over</option>
							</select>
						</div></li></ul>
					</li></ul>
					
					<ul><li><div>
						<label for="fb_overlayColor"><?php esc_html_e('Color of the overlay', $this->_get_plugin_name()) ?>
						<?php //&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
						<input type="color" data-hex="true" name="fb_overlayColor" id="fb_overlayColor" value="<?php echo esc_attr($this->get_option('fb_overlayColor')); ?>" class="text code" />
					</div></li></ul>
						

					</li></ul>
				<p><input type="submit" name="fancybox_plus_submit" class="button-primary" value="<?php esc_html_e('Save Changes') ?>" /></p>
				</div>
			</div>
			</form>
			
			<div id="poststuff">
				<div class="postbox">
					<h3><?php esc_html_e('Donation', $this->_get_plugin_name()) ?></h3>
					<div class="inside">
						<p>
							<?php _e('Fancybox Plus has required a great deal of time and effort to develop. If it\'s been useful to you then you can support this development by making a small donation. This will act as an incentive for me to carry on developing it, providing countless hours of support, and including any enhancements that are suggested. If you don\'t have a clue how much you want to spend, the average of the last donations were €8. But every other amount is welcome. Please note, that PayPal takes for every transaction round about €0.50. So every donation below €1 is only a donation to PayPal ;-) Further you have the options to have a look at my amazon wishlist.', $this->_get_plugin_name()); ?><br />
							<center><a href="http://www.puzich.com/go/donate"><img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/fancybox-plus/img/donate.gif" /> <?php _e('Donate via PayPal!', $this->_get_plugin_name()); ?></a> or <a href="http://www.puzich.com/go/wishlist/"><?php _e('make a gift with Amazon', $this->_get_plugin_name()) ?></a></center>
						</p>
					</div>
				</div>
			
			<p><small>Video Icon from <a href="http://www.famfamfam.com">famfamfam </a>. Special thanks to Jovelstefan and his plugin <a href="http://wordpress.org/extend/plugins/embedded-video-with-link/">Embedded Video with Link</a>, which inspired me.</small></p>
			
			
		</div>
		</div>
	<?php
	}
	
	function mcebutton($buttons) {
		array_push($buttons, "|", "fancyboxplus");
		return $buttons;
	}
	

	function mceplugin($ext_plu) {
		if (is_array($ext_plu) == false) {
			$ext_plu = array();
		}
		
		$url = get_option('siteurl')."/wp-content/plugins/fancybox-plus/editor_plugin.js";
		$result = array_merge($ext_plu, array('fancyboxplus' => $url));
		return $result;
	}
	

	function mceinit() {
		if (function_exists('load_plugin_textdomain')) load_plugin_textdomain( $this->_get_plugin_name(), false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
		if ( 'true' == get_user_option('rich_editing') ) {
			add_filter('mce_external_plugins', array(&$this, 'mceplugin'), 0);
			add_filter("mce_buttons", array(&$this, 'mcebutton'), 0);
		}
	}
	

	function mce_header() {
		echo "<script type='text/javascript' src='".get_option('siteurl')."/wp-content/plugins/fancybox-plus/fancybox-plus.js'></script>\n";
	}
	
	
	function direct_image_urls_for_galleries( $link, $id ) {
		if ( is_admin() ) return $link;

		$mimetypes = array( 'image/jpeg', 'image/png', 'image/gif' );

		$post = get_post( $id );

		if ( in_array( $post->post_mime_type, $mimetypes ) )
			return wp_get_attachment_url( $id );
		else
			return $link;
	}

}

//initalize class
if (class_exists('fancybox_plus'))
	$fancybox_plus = new fancybox_plus();
	
/* 
   if function simplexml_load_string is not compiled into php
   use simplexml.class.php
*/
if(!function_exists("simplexml_load_string")) {
	require_once('libs/simplexml.class.php');
	
	function simplexml_load_string($file) {
		$sx = new simplexml;
		return $sx->xml_load_string($file);
	}
}
?>
