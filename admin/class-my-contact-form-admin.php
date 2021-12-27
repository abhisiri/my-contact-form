<?php
	
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_Contact_Form
 * @subpackage My_Contact_Form/admin
 * @author     Abhishek shukla <abhishekshukla2021dec@cedcoss.com>
 */
class My_Contact_Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-contact-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-contact-form-admin.js', array( 'jquery' ), $this->version, false );

	}

}

add_action('admin_menu', 'my_contact_form_plugin_setup_menu');
 
function my_contact_form_plugin_setup_menu(){
    add_menu_page( 'My Contact Form', 'My Contact Form', 'manage_options', 'My-Contact-Form', 'plugin_settings_page', 'dashicons-format-aside' );
	add_submenu_page( 'My-Contact-Form', 'Add New', 'Add New', 'manage_options', 'Add-New', 'add_contact_form_code' );
}
 function plugin_settings_page() {

	
	require_once( 'table/class-my-contact-forms-list-table.php' );
		$contact_name = new My_Contact_Form_List();
		?>
		
		<div class="wrap">
		<h2>ALL record</h2>
		
		<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
		<div id="post-body-content">
		<div class="meta-box-sortables ui-sortable">
		<form method="post">
		<?php
		 $contact_name->prepare_items();
		 $contact_name->display(); ?>
		</form>
		</div>
		</div>
		</div>
		<br class="clear">
		</div>
		</div><table style="border: 2px solid black;">
	<thead>
	<tr>
	<th>
	shortcode: 
	</th>
	</tr>	
	<tbody>
	<tr>
	<td>
	[my_contact_form] 
	</td>
	</tr>
	</tbody>
	</thead></table>
		<?php
		} ?><?php
	

function add_contact_form_code() {
	$contact_form = '
	<h2>Contact Form</h2>
	<form action="" method="post">
	<p>
	Your Name (*) <br/>
	<input type="text" name="name" value="" size="40" />
	</p>
     <p>
	Your Email (*) <br/>
	<input type="email" name="email" value="" size="40" />
	</p>
	<p>
	Your Message (*) <br/>
	<textarea rows="10" cols="35" name="message"></textarea>
	</p>
	<p><input type="submit" name="submitted" value="Send"></p>
	</form>';

	echo $contact_form;
}



add_shortcode( 'my_contact_form', 'add_contact_form_code' );


if(isset($_POST['submitted'])){
	global $wpdb;
	$wpdb->insert( 'wp_my_contact_form', array( 'name' =>
	$_POST['name'], 'email' => $_POST['email'], 'text' => $_POST['message'] ),
	array( '%s', '%s', '%s' ) );
}

