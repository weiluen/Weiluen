<?php
/*
Plugin Name: WP Smush.it NextGEN Gallery Integration
Plugin URI: http://dialect.ca/code/wp-smushit/
Description: Reduce image file sizes and improve performance using the <a href="http://smush.it/">Smush.it</a> API via the <a href="http://wordpress.org/extend/plugins/wp-smushit/">WP Smush.it plugin</a>.
Author: Dialect
Version: 0.1.0
Author URI: http://dialect.ca/
*/

class WPSmushitNGG {
  static $plugins_ok = false; 

  function WPSmushitNGG() {
    add_action( 'ngg_added_new_image', array( &$this, 'added_new_image' ) );
    add_filter( 'ngg_manage_images_columns', array( &$this, 'manage_images_columns' ) );
    add_action( 'ngg_manage_image_custom_column', array( &$this, 'manage_image_custom_column' ), 10, 2 );
  }

  /* ngg_added_new_image hook */
  function added_new_image( $image ) {
    self::check_support();

    global $wpdb;
    $q = $wpdb->prepare( "SELECT path FROM {$wpdb->prefix}ngg_gallery WHERE gid = %d LIMIT 1", $image['galleryID'] );
    $gallery_path = $wpdb->get_var($q);

    if ( $gallery_path ) {
      $file_path = trailingslashit($gallery_path) . $image['filename'];
      $res = wp_smushit(ABSPATH . $file_path, site_url($file_path) );
      nggdb::update_image_meta($image['id'], array('_wp_smushit'=> $res[1]));
    }
  }

  /* ngg_manage_images_columns hook */
  function manage_images_columns( $columns ) {
    self::check_support();
    $columns['smushit'] = 'Smush.it';
    return $columns;
  }

  /* ngg_manage_image_custom_column hook */
  function manage_image_custom_column( $column_name, $id ) {
    self::check_support();
    
    if( $column_name == 'smushit' ) {    
      $meta = new nggMeta( $id );
      $status = $meta->get_META( '_wp_smushit' );
      if ( !$status || empty( $status ) ) {
        echo 'Not processed';
        // TODO: allow manual re-smushing
      } else {
        echo $status;
      }
    }
  }

  /* ensure NextGEN Gallery and WP Smush.it are installed */
  static function check_support() {
    if (self::$plugins_ok) {
      return true;
    }

    if ( !class_exists( 'nggdb' ) ) {
      wp_die("
        <h2>WP Smush.it NextGEN Gallery Integration Error</h2>
        <p>It appears that the NextGEN Gallery plugin isn't installed or activated.</p>
        <p>Either install NextGEN Gallery or deactivate the WP Smush.it NextGEN Gallery Integration plugin.</p>
      ");
    }

    if ( !function_exists( 'wp_smushit' ) ) {
      wp_die("
        <h2>WP Smush.it NextGEN Gallery Integration Error</h2>
        <p>It appears that the WP Smush.it plugin isn't installed or activated.</p>
        <p>Either install WP Smush.it or deactivate the WP Smush.it NextGEN Gallery Integration plugin.</p>
      ");
    }
    
    // check the WP Smush.it version number
    preg_match( '/\/([\d]+)\.([\d]+)\.([\d]+)/', WP_SMUSHIT_UA, $version );        

    if ( count($version) === 0 || intval($version[1]) < 1 || ( intval($version[1]) === 1 && intval($version[2]) < 5 ) ) {
      wp_die("
        <h2>WP Smush.it NextGEN Gallery Integration Error</h2>
        <p>WP Smush.it version 1.5 or higher is required.</p>
        <p>Either update WP Smush.it or deactivate the WP Smush.it NextGEN Gallery Integration plugin.</p>
      ");
    }
    
    // all the unsuccessful checks result in `wp_die` so if we've
    // made it this far we can assume everything is good
    self::$plugins_ok = true;
  }

}

add_action( 'init', 'WPSmushitNGG' );

function WPSmushitNGG() {
	global $WPSmushitNGG;
	$WPSmushitNGG = new WPSmushitNGG();
}