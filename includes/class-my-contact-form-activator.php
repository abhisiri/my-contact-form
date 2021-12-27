<?php

/**
 * Fired during plugin activation
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/includes
 * @author     Abhishek shukla <abhishekshukla2021dec@cedcoss.com>
 */
class My_Contact_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		global $wpdb;
		$table_name = 'wp_my_contact_form';
		$sql = "CREATE TABLE $table_name (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(50) NOT NULL,
			email varchar(50) NOT NULL,
			text text NOT NULL,
			PRIMARY KEY  (id)
		  )";
		  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		  dbDelta( $sql ); 
}

function my_render_list_page(){
	$myListTable = new My_Contact_Form_Activator();
	echo '<div class="wrap"><h2>My List Table Test</h2>'; 
	$myListTable->prepare_items(); 
	$myListTable->display(); 
	echo '</div>'; 
  }
}
