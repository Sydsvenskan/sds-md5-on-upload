<?php
/*
Plugin Name: SDS md5 on upload
Plugin URI: http://sydsvenskan.se
Description: Adds md5 hash to file name on file upload
Version: 1.1
Author: Johannes Fosseus
*/

add_filter( 'wp_handle_upload_prefilter', 'sds_add_md5_on_upload' );

/**
 * Create an md5 of the filename and
 */
function sds_add_md5_on_upload( $file ) {

	/**
	 * Get the file name
	 */
	$name = $file['name'];

	$md5 = md5( "$name{$file['size']}{$file['tmp_name']}" . date('l jS \of F Y h:i:s A') );

	/**
	 * Get file suffix
	 */
	$pos = strrpos( $name, '.' );

	if ( !$pos ) {
		$md5_name = basename( "{$md5}" );
	} else {
		$md5_name = basename( "{$md5}" . substr( $name, $pos ) );
	}

	/**
	 * Set the new file name
	 */
	$file['name'] = $md5_name;

	return $file;
}