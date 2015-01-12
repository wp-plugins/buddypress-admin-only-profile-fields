<?php
/*
Plugin Name: BuddyPress Admin Only Profile Fields
Plugin URI: http://ashleyrich.com/buddypress-admin-only-profile-fields/
Description: Easily set the visibility of BuddyPress profile fields to hidden, allowing only admin users to edit and view them.
Version: 1.0
Author: Ashley Rich
Author URI: http://ashleyrich.com
License: GPL2

Copyright 2013  Ashley Rich (email : hello@ashleyrich.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * BuddyPress Admin Only Profile Fields
 *
 * @package  BuddyPress Admin Only Profile Fields
 * @since    1.0
*/
class BP_Admin_Only_Profile_Fields {

	/**
	 * Instance of this class.
	 *
	 * @since  1.0
	 */
	private static $instance = null;

	/**
	 * Initialize the plugin.
	 *
	 * @since  1.0
	 */
	private function __construct() {

		// Setup plugin constants
		self::setup_constants();

		// Load plugin text domain
		self::load_plugin_textdomain();

		// Filters
		add_filter( 'bp_xprofile_get_visibility_levels', array( $this, 'custom_visibility_levels' ) );
		add_filter( 'bp_xprofile_get_hidden_fields_for_user', array( $this, 'hide_hidden_fields' ), 10, 3 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since  1.0
	 */
	public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @since  1.0
	 */
	private function setup_constants() {

		if( !defined( 'BPAOPF_VERSION' ) ) {
			define( 'BPAOPF_VERSION', '1.0' );
		}

		if( !defined( 'BPAOPF_PLUGIN_URL' ) ) {
			define( 'BPAOPF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		if( !defined( 'BPAOPF_PLUGIN_DIR' ) ) {
			define( 'BPAOPF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );			
		}
	}

	/**
     * Load the plugin text domain.
     *
     * @since  1.0
     */
    private function load_plugin_textdomain() {

        load_plugin_textdomain( 'bp_admin_only_profile_fields', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * Add our hidden visibility level.
     *
     * @since  1.0
     */
    public function custom_visibility_levels($levels) {

    	$levels['hidden'] = array(
			'id' 	=> 'hidden',
			'label' => __( 'Hidden', 'bp_admin_only_profile_fields' )
		);

		return $levels;
    }

    /**
     * Hide our hidden fields.
     *
     * @since  1.0
     */
    public function hide_hidden_fields($hidden_fields, $displayed_user_id, $current_user_id) {

    	$hidden_fields = bp_xprofile_get_fields_by_visibility_levels( $displayed_user_id, ['hidden'] );

		if ( !current_user_can( apply_filters( 'bp_admin_only_profile_fields_cap', 'manage_options' ) ) ) {
			return $hidden_fields;
		}

		return [];
    }

}

$bp_admin_only_profile_fields = BP_Admin_Only_Profile_Fields::get_instance();