<?php
/*
Plugin Name: WLW Featured Image Plugin
Plugin URI: http://dev.scottisafool.co.uk
Description: A plugin to extend the functionality of the xmlrpc.php file to allow Live Writer to set the featured image for a post.
Version: 1.0
Author: Scott Lovegrove
Author URI: http://dev.scottisafool.co.uk
*/

add_filter('xmlrpc_methods', 'change_newmedia_object');

function change_newmedia_object($methods){
	$methods['metaWeblog.scottMediaObject'] = 'scottisafool_newMediaObject';
	return $methods;
}

function scottisafool_newMediaObject($args){
	global $wpdb;
	global $wp_xmlrpc_server;

            $wpdb->escape($args);
	
		$blog_ID     = (int) $args[0];
		$username  = $wpdb->escape($args[1]);
		$password   = $wpdb->escape($args[2]);
		$data        = $args[3];

		$name = sanitize_file_name( $data['name'] );
		$type = $data['type'];
		$bits = $data['bits'];
		$passedpostid = $data['postid'];

		logIO('O', '(MW) Received '.strlen($bits).' bytes');

		if ( !$user = $wp_xmlrpc_server->login($username, $password) )
			return $wp_xmlrpc_server->error;

		do_action('xmlrpc_call', 'metaWeblog.newMediaObject');

		if ( !current_user_can('upload_files') ) {
			logIO('O', '(MW) User does not have upload_files capability');
			$wp_xmlrpc_server->error = new IXR_Error(401, __('You are not allowed to upload files to this site.'));
			return $wp_xmlrpc_server->error;
		}

		if ( $upload_err = apply_filters( "pre_upload_error", false ) )
			return new IXR_Error(500, $upload_err);

		if ( !empty($data["overwrite"]) && ($data["overwrite"] == true) ) {
			// Get postmeta info on the object.
			$old_file = $wpdb->get_row("
				SELECT ID
				FROM {$wpdb->posts}
				WHERE post_title = '{$name}'
					AND post_type = 'attachment'
			");

			// Delete previous file.
			wp_delete_attachment($old_file->ID);

			// Make sure the new name is different by pre-pending the
			// previous post id.
			$filename = preg_replace("/^wpid\d+-/", "", $name);
			$name = "wpid{$old_file->ID}-{$filename}";
		}

		$upload = wp_upload_bits($name, NULL, $bits);
		if ( ! empty($upload['error']) ) {
			$errorString = sprintf(__('Could not write file %1$s (%2$s)'), $name, $upload['error']);
			logIO('O', '(MW) ' . $errorString);
			return new IXR_Error(500, $errorString);
		}
		// Construct the attachment array		
		$post_id = $passedpostid;
		$attachment = array(
			'post_title' => $name,
			'post_content' => '',
			'post_type' => 'attachment',
			'post_parent' => $post_id,
			'post_mime_type' => $type,
			'guid' => $upload[ 'url' ]
		);

		// Save the data
		$id = wp_insert_attachment( $attachment, $upload[ 'file' ], $post_id );
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );

		// Original return statement
		return apply_filters( 'wp_handle_upload', array( 'file' => $name, 'url' => $upload[ 'url' ], 'type' => $type, 'id' => $id ), 'upload' ); 
	}