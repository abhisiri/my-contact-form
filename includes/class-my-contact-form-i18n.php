<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/includes
 * @author     Abhishek shukla <abhishekshukla2021dec@cedcoss.com>
 */
class My_Contact_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'my-contact-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
