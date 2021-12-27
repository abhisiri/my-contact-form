<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_Contact_Form_List extends WP_List_Table {

	// public static function define_columns() {
	// 	$columns = array(
	// 		'cb' => '<input type="checkbox" />',
	// 		'title' => __( 'Title', 'my-contact-form' ),
	// 		'shortcode' => __( 'Shortcode', 'my-contact-form' ),
	// 		'author' => __( 'Author', 'my-contact-form' ),
	// 		'date' => __( 'Date', 'my-contact-form' ),
	// 	);

	// 	return $columns;
	// }

	public function __construct() {
		parent::__construct( array(
			'singular' => 'post',
			'plural' => 'posts',
			'ajax' => false,
		) );
	}

	public static function get_contact_form( $per_page = 5, $page_number = 1 ) {

		global $wpdb;
		
		$sql = "SELECT * FROM {$wpdb->prefix}my_contact_form";
		
		if ( ! empty( $_REQUEST['orderby'] ) ) {
		$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
		$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}
		
		$sql .= " LIMIT $per_page";
		
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		
		return $result;
		}

		public static function delete_contact_form( $id ) {
			global $wpdb;
			
			$wpdb->delete(
			"{$wpdb->prefix}my_contact_form",
			[ 'ID' => $id ],
			[ '%d' ]
			);
			}

			public static function record_count() {
				global $wpdb;
				
				$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}my_contact_form";
				
				return $wpdb->get_var( $sql );
				}

				function column_name( $item ) {

					// create a nonce
					$delete_nonce = wp_create_nonce( 'sp_delete_contact_form' );
					
					$title = '<strong>' . $item['name'] . '</strong>';
					
					$actions = [
					'delete' => sprintf( '<a href="?page=%s&action=%s&contact=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
					];
					
					return $title . $this->row_actions( $actions );
					}

					function column_email( $item ) {

						// create a nonce
						$delete_nonce = wp_create_nonce( 'sp_delete_contact_form' );
						
						$email = '<strong>' . $item['email'] . '</strong>';
						
						$actions = [
						'delete' => sprintf( '<a href="?page=%s&action=%s&contact=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
						];
						
						return $email . $this->row_actions( $actions );
						}

						function column_text( $item ) {

							// create a nonce
							$delete_nonce = wp_create_nonce( 'sp_delete_contact_form' );
							
							$text = '<strong>' . $item['text'] . '</strong>';
							
							$actions = [
							'delete' => sprintf( '<a href="?page=%s&action=%s&contact=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
							];
							
							return $text . $this->row_actions( $actions );
							}
	

					function get_columns() {
						$columns = array(
							'cb' => '<input type="checkbox" />',
								'name' => 'Name',
								'email' => 'Subject',
								'text' => 'Text'
								);
						return $columns;
					}
					
						 function column_cb( $item ) {
						 	return sprintf(
						 	'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
						 	);
						 	}

							public function get_sortable_columns() {
								$sortable_columns = array(
								'name' => array( 'name', true ),
								'email' => array( 'email', false )
								);
								
								return $sortable_columns;
								}

								public function get_bulk_actions() {
									$actions = [
									'bulk-delete' => 'Delete'
									];
									
									return $actions;
									}

									public function prepare_items() {

										$columns=$this->get_columns();
										$hidden=array();
										$sortable=$this->get_sortable_columns();

										$this->_column_headers=array($columns,$hidden,$sortable);
										
										/** Process bulk action */
										$this->process_bulk_action();
										
										$per_page = $this->get_items_per_page( 'contacts_per_page', 5 );
										$current_page = $this->get_pagenum();
										$total_items = self::record_count();
										
										$this->set_pagination_args( [
										'total_items' => $total_items, //WE have to calculate the total number of items
										'per_page' => $per_page //WE have to determine how many items to show on a page
										] );
										
										$this->items = self::get_contact_form( $per_page, $current_page );
										}
	
}