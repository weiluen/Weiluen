<?php
/**
 * Plugin Name: Bit.ly Service
 * Plugin URI: https://github.com/niftytheme/bitly-service
 * Description: Bit.ly Service allows you to generate a bitly.com, bit.ly or j.mp shortlink for all of your posts and pages and custom post types.
 * Version: 1.1.0
 * Author: Luis Alberto Ochoa Esparza
 * Author URI: http://luisalberto.org
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Bit.ly Service
 * @version 1.1.0
 * @author Luis Alberto Ochoa Esparza <soy@luisalberto.org>
 * @copyright Copyright (C) 2011-2012, Luis Alberto Ochoa Esparza
 * @link https://github.com/niftytheme/bitly-service
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Bitly Class
 *
 * @link https://github.com/albertochoa/bitly-class/wiki
 */
require_once( 'library/Bitly.php' );

/**
 * Bitly Service.
 * 
 * @since 1.0.0
 */
class Bitly_Service extends Bitly {

	/**
	 * Constructor PHP5.
	 * 
	 * @since 1.0.0
	 */
	function __construct() {

		/* Load the translation file for current language. */
		load_plugin_textdomain( 'bitly-service', false, 'bitly-service/languages' );

		/* Shortlink filter. */
		add_filter( 'pre_get_shortlink', array( &$this, 'bitly_get_shortlink' ), 10, 4 );

		/* Rewrite Admin Bar (WP 3.1+). */
		add_action( 'admin_bar_menu', array( &$this, 'bitly_admin_bar_menu' ), 99 );

		/* Register QR Code shortcode. */
		add_action( 'init', array( $this, 'bitly_shortcodes' ) );

		/* Admin functions. */
		add_action( 'wp_loaded', array( &$this, 'bitly_admin' ) );

		/* Deactivation. */
		register_deactivation_hook( __FILE__, array( &$this, 'bitly_desactivation' ) );
	}

	/**
	 * Return a shortlink for a post, page, attachment, or blog.
	 * 
	 * @since 1.0.0
	 */
	function bitly_get_shortlink( $shortlink, $id, $context, $allow_slugs ) {

		/* El Shortlink no se muestra en la página principal. */
		if ( is_front_page() && !is_paged() )
			return apply_filters( 'bitly_front_page', false );

		if ( is_singular() && is_preview() )
			return false;

		global $wp_query;

		$post_id = '';

		if ( 'query' == $context && is_singular() )
			$post_id = $wp_query->get_queried_object_id();

		else if ( 'post' == $context ) {
			$post = get_post( $id );
			$post_id = $post->ID;
		}

		if ( $shortlink = get_metadata( 'post', $post_id, '_bitly_shortlink', true ) )
			return $shortlink;

		$url = get_permalink( $post_id );

		$domain = bitly_settings( 'domain' );
		$shortlink = $this->shorten( $url, $domain );

		if ( !empty( $shortlink ) ) {
			update_metadata( 'post', $post_id, '_bitly_shortlink', $shortlink );
			return $shortlink;
		}

		return false;
	}

	/**
	 * Creates new shortcodes for display the QR Code image.
	 *
	 * @since 1.1.0
	 */
	function bitly_shortcodes() {
		add_shortcode( 'qrcode', array( $this, 'bitly_qrcode_shortcode' ) );
	}

	/**
	 * Shortcode to display the QR Code image.
	 *
	 * @since 1.1.0
	 * @param array $attr The arguments.
	 */
	function bitly_qrcode_shortcode( $attr ) {
		global $wp_query;

		$image = '';

		$attr = shortcode_atts( array(
			'url' => '',
			'size' => '',
		), $attr );

		extract( $attr );

		$info = $this->info( $url );

		if ( isset( $info['error'] ) || empty( $url ) ) {
			return;
		}

		$cache_dir = plugin_dir_path( __FILE__ ) . 'library/cache/';
		$cache_url = plugin_dir_url ( __FILE__ ) . 'library/cache/';

		$image = $this->qrcode( $url, absint( $size ), $cache_dir );

		list( $size ) = @getimagesize( "{$cache_url}{$image}" );

		$image = "<img class ='qrcode' src='{$cache_url}{$image}' alt='{$url}' width='{$size}' height='{$size}' />";

		return "<p><a class='bitly' href='{$url}' rel='shortlink'>{$image}</a></p>";
	}

	/**
	 * Adds Share on Twitter/Global Stats/User's Stats links
	 *
	 * @since 1.0.0
	 */
	function bitly_admin_bar_menu() {
		global $wp_admin_bar;

		$shortlink = wp_get_shortlink( 0, 'query' );

		if ( empty( $shortlink ) )
			return false;

		$wp_admin_bar->remove_menu( 'get-shortlink' );
		$wp_admin_bar->add_menu( array( 'id' => 'shortlink', 'title' => __( 'Shortlink' ), 'href' => $shortlink ) );

		$twitter = sprintf( 'http://twitter.com/?status=%1$s', str_replace( '+', '%20', urlencode( get_the_title() . ' - ' . $shortlink ) ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'bitly-share', 'title' => __( 'Share on Twitter', 'bitly-service' ), 'href' => $twitter, 'meta' => array( 'target' => '_blank' ) ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'bitly-stats', 'title' => __( 'User\'s Stats', 'bitly-service' ), 'href' => "{$shortlink}+", 'meta' => array( 'target' => '_blank' ) ) );
		$wp_admin_bar->add_menu( array( 'parent' => 'shortlink', 'id' => 'bitly-stats-global', 'title' => __( 'Global Stats', 'bitly-service' ), 'href' => "{$shortlink}+/global", 'meta' => array( 'target' => '_blank' ) ) );
	}

	/**
	 * Setup the admin hooks, actions and filters.
	 * 
	 * @since 1.0.0
	 */
	function bitly_admin() {

		if ( is_admin() ) {

			add_action( 'admin_menu', 'bitly_admin_setup' );

			add_action( 'save_post', array( &$this, 'bitly_cache_delete' ) );
			add_action( 'added_post_meta', array( &$this, 'bitly_cache_delete' ) );
			add_action( 'updated_post_meta', array( &$this, 'bitly_cache_delete' ) );
			add_action( 'deleted_post_meta', array( &$this, 'bitly_cache_delete' ) );

			add_filter( 'plugin_action_links', 'bitly_service_action_link', 10, 2 );
		}
	}

	/**
	 * Removes all the cache.
	 *
	 * @since 1.0.0
	 */
	function bitly_desactivation() {

		delete_metadata( 'post', false, '_bitly_shortlink', '', true );

		delete_option( 'bitly_settings' );
	}

	/**
	 * Removes the cache of a post.
	 *
	 * @since 1.0.0
	 * @param int $post_ID A post or blog id.
	 */
	function bitly_cache_delete( $post_id ) {
		delete_metadata( 'post', $post_id, '_bitly_shortlink' );
	}
}

/* Hook Bitly Service early onto the 'plugins_loaded' action. */
add_action( 'plugins_loaded', 'bitly_service' );

/**
 * The main function!
 *
 * @since 1.1.0
 */
function bitly_service() {
	$bitly = new Bitly_Service();

	if ( $login = bitly_settings( 'login' ) )
		$bitly->login( $login );

	if ( $apiKey = bitly_settings( 'apiKey' ) )
		$bitly->apiKey( $apiKey );
}

/**
 * Loads the settings once and allows the input of the specific field the user would
 * like to show.
 *
 * @since 1.0.0
 */
function bitly_settings( $option = '' ) {

	if ( empty( $option ) )
		return false;

	$settings = get_option( 'bitly_settings' );

	if ( !is_array( $settings ) || empty( $settings[$option] ) )
		return false;

	return $settings[$option];
}

/**
 * Agrega la página de configuración y registra las opciones del plugin.
 *
 * @since 1.0.0
 */
function bitly_admin_setup() {
	add_options_page( __( 'Bit.ly Service Settings', 'bitly-service' ), 'Bit.ly Service', 'manage_options', 'bitly-service', 'bitly_service_settings_page' );

	add_action( 'admin_init', 'bitly_service_register_settings' );
	add_action( 'load-settings_page_bitly-service', 'bitly_service_admin_enqueue_style' );
}

/**
 * Adds the Bitly Service settings page.
 *
 * @since 1.0.0
 */
function bitly_service_settings_page() { ?>

	<div class="wrap">

		<?php screen_icon( 'bitly-service' ); ?>

		<h2><?php _e( 'Bit.ly Service Settings', 'bitly-service' ); ?></h2>

		<form id="bitly_service_options_form" action="<?php echo admin_url( 'options.php' ); ?>" method="post">

			<?php settings_fields( 'bitly_settings' ); ?>

			<table class="form-table">
				<tr>
					<th><label for="bitly_settings-login"><?php _e( 'Login Name', 'bitly-service' ); ?></label></th>
					<td>
						<input id="bitly_settings-login" name="bitly_settings[login]" type="text" value="<?php echo bitly_settings( 'login' ); ?>" /><br />
						<span class="description"><?php printf( __( 'Enter your %s.', 'bitly-service' ), '<a href="http://bitly.com/a/your_api_key" title="bitly API Key" target="_blank">Login Name</a>' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="bitly_settings-apiKey"><?php _e( 'API Key', 'bitly-service' ); ?></label></th>
					<td>
						<input id="bitly_settings-apiKey" name="bitly_settings[apiKey]" type="text" value="<?php echo bitly_settings( 'apiKey' ); ?>" /><br />
						<span class="description"><?php printf( __( 'Enter your %s.', 'bitly-service' ), '<a href="http://bitly.com/a/your_api_key" title="bitly API Key" target="_blank">API Key</a>' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="bitly_settings-domain"><?php _e( 'Domain', 'bitly-service' ); ?></label></th>
					<td>
						<?php _e( 'Select a domain you would  like to use.', 'bitly-service' ); ?>
						<br />
						<select name="bitly_settings[domain]" id="bitly_settings-domain">
							<?php foreach ( array( 'bitly.com', 'bit.ly', 'j.mp' ) as $domain ) { ?>
								<option value="<?php echo $domain; ?>" <?php selected( $domain, bitly_settings( 'domain' ) ); ?>><?php echo $domain; ?></option>
							<?php } ?>
						</select>
						<br />
						<span class="description"><?php printf( __( 'You can also use your own short domain with %s.', 'bitly-service' ), '<a href="https://bitly.com/a/custom_domain_settings" title="Custom Domain" target="_blank">Custom Domain Settings</a>' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="bitly_settings-qrcode-size"><?php _e( 'QR Code', 'bitly-service' ); ?></label></th>
					<td>
						<input id="bitly_settings-qrcode-size" name="bitly_settings[qrcode-size]" type="text" value="<?php echo bitly_settings( 'qrcode-size' ); ?>" /><br />
						<span class="description"><?php _e( 'Enter size of the QR Code (in pixels). Default: 249', 'bitly-service' ); ?></span>
					</td>
				</tr>
			</table>

			<p class="submit" style="clear: both;">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
			</p><!-- .submit -->

		</form>

	</div> <!-- .wrap --> <?php
}

/**
 * Registra la configuración de Bitly Service con WordPress.
 *
 * @since 1.0.0
 */
function bitly_service_register_settings() {
	register_setting( 'bitly_settings', 'bitly_settings', 'bitly_service_validate_settings' );
}

/**
 * Sanitize the settings before adding them to the database.
 *
 * @since 1.0.0
 */
function bitly_service_validate_settings( $input ) {

	if ( !is_numeric( $input['qrcode-size'] ) )
		$input['qrcode-size'] = '';

	return $input;
}

/**
 * Loads admin stylesheets.
 *
 * @since 1.0.0
 */
function bitly_service_admin_enqueue_style() {
	wp_enqueue_style( 'bitly-service-admin', plugin_dir_url( __FILE__ ) . 'css/bitly-service.css', false, '1.0.0', 'screen' );
}

/**
 * Adds an Settings link to the admin page.
 * 
 * @since 1.0.0
 */
function bitly_service_action_link( $links, $file ) {

	if ( 'bitly-service/bitly-service.php' !== $file )
		return $links;

	$settings = '<a href="' . admin_url( 'options-general.php?page=bitly-service' ) . '">' . __( 'Settings', 'bitly-service' ) . '</a>';
	array_unshift( $links, $settings );
	return $links;
}

