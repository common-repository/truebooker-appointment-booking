<?php 

function truebooker_install()
        {
			global $wpdb;
			global $truebooker_db_version;
			global $table_truebooker_customers, $table_truebooker_services, $table_truebooker_categories, $charset_collate, $table_truebooker_payments, $table_truebooker_setting,$table_truebooker_stransactions;

			$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
			$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
			$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
			$table_truebooker_payments = $wpdb->prefix . 'truebooker_payments';
			$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
			$table_truebooker_stransactions = $wpdb->prefix . 'truebooker_stransactions';
			
			$charset_collate = $wpdb->get_charset_collate();
			
			 include_once ABSPATH . 'wp-admin/includes/upgrade.php';

                $charset_collate = '';
                if ($wpdb->has_cap('collation') ) {
                    if (! empty($wpdb->charset) ) {
                        $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
                    }
                    if (! empty($wpdb->collate) ) {
                        $charset_collate .= " COLLATE $wpdb->collate";
                    }
                }
				
			$truebooker_dbtbl_create = array();
			
			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_customers}`(
				`truebooker_user_id` bigint(11) NOT NULL AUTO_INCREMENT,
				`truebooker_user_firstname` VARCHAR(255) NOT NULL,
				`truebooker_user_lastname` VARCHAR(255) NOT NULL,
				`truebooker_user_email` VARCHAR(255) NOT NULL,
				`truebooker_user_phone` VARCHAR(63) DEFAULT NULL,
				`truebooker_user_phonecode` VARCHAR(63) DEFAULT NULL,
				`truebooker_user_note` VARCHAR(255) DEFAULT NULL,
				`truebooker_user_service` VARCHAR(255) DEFAULT NULL,
				`truebooker_user_dt` DATE DEFAULT NULL,
				`truebooker_user_time` VARCHAR(255) DEFAULT NULL,
				`truebooker_time_meridiem` VARCHAR(255) DEFAULT NULL,
				`truebooker_appointment_status` VARCHAR(20) DEFAULT NULL,
				`truebooker_user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`truebooker_user_id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_customers ] = dbDelta($sql_table);
		
			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_categories}`(
				`truebooker_category_id` bigint(11) NOT NULL AUTO_INCREMENT,
				`truebooker_category_name` VARCHAR(255) NOT NULL,
				`truebooker_category_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`truebooker_category_id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_categories ] = dbDelta($sql_table);
			
			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_services}`(
				`truebooker_service_id` bigint(11) NOT NULL AUTO_INCREMENT,
				`truebooker_service_name` VARCHAR(255) NOT NULL,
				`truebooker_service_category` VARCHAR(255) NOT NULL,
				`truebooker_service_duration_val` VARCHAR(255) NOT NULL,
				`truebooker_service_duration_unit` VARCHAR(63) DEFAULT NULL,
				`truebooker_service_price` VARCHAR(63) DEFAULT NULL,
				`truebooker_service_description` VARCHAR(255) DEFAULT NULL,
				`truebooker_user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`truebooker_service_id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_services ] = dbDelta($sql_table);
			
			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_payments}`(
				`truebooker_payment_id` bigint(11) NOT NULL AUTO_INCREMENT,
				`truebooker_paypalid` VARCHAR(255) NOT NULL,
				`truebooker_paypalapi` VARCHAR(255) NOT NULL,
				`truebooker_payment_email` VARCHAR(255) NOT NULL,
				`truebooker_api_username` VARCHAR(63) NOT NULL,
				`truebooker_payment_mode` VARCHAR(63) NOT NULL,
				PRIMARY KEY (`truebooker_payment_id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_payments ] = dbDelta($sql_table);
			
			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_setting}`(
				`truebooker_setting_id` bigint(11) NOT NULL AUTO_INCREMENT,
				`truebooker_setting_name` VARCHAR(255) NOT NULL,
				`truebooker_setting_value` text NOT NULL,
				`truebooker_setting_type` VARCHAR(255) NOT NULL,
				`truebooker_setting_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`truebooker_setting_id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_setting ] = dbDelta($sql_table);

			$sql_table = "CREATE TABLE IF NOT EXISTS `{$table_truebooker_stransactions}`(
				`id` bigint(11) NOT NULL AUTO_INCREMENT,
				`customer_name` VARCHAR(255) NOT NULL,
				`customer_email` VARCHAR(255) NOT NULL,
				`item_name` VARCHAR(255) NOT NULL,
				`item_price` float(10,2) NOT NULL,
				`item_price_currency` VARCHAR(255) NOT NULL,
				`paid_amount` VARCHAR(255) NOT NULL,
				`paid_amount_currency` VARCHAR(255) NOT NULL,
				`txn_id` VARCHAR(255) NOT NULL,
				`payment_status` VARCHAR(255) NOT NULL,
				`created` datetime NOT NULL,
				`modified` datetime NOT NULL,
				`truebooker_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`id`)
			) {$charset_collate};";
			$truebooker_dbtbl_create[ $table_truebooker_stransactions ] = dbDelta($sql_table);
	
			add_option( 'truebooker_db_version', $truebooker_db_version );
		}

	
		function truebooker_uninstall()
        {
            global $wp, $wpdb, $table_truebooker_customers, $table_truebooker_services, $table_truebooker_categories, $truebooker_tables, $table, $table_truebooker_payments, $table_truebooker_setting, $table_truebooker_stransactions;
			
			$base_prefix = $wpdb->get_blog_prefix();
			
			if(is_multisite()){
				
				$table_truebooker_customers = $base_prefix . 'truebooker_user';
				$table_truebooker_services = $base_prefix . 'truebooker_service';
				$table_truebooker_categories = $base_prefix . 'truebooker_categories';
				$table_truebooker_payments = $base_prefix . 'truebooker_payments';
				$table_truebooker_setting = $base_prefix . 'truebooker_setting';
				$table_truebooker_stransactions = $base_prefix . 'truebooker_stransactions';
				
				$truebooker_tables = array(
				$table_truebooker_customers,
				$table_truebooker_services,
				$table_truebooker_categories,
				$table_truebooker_payments,
				$table_truebooker_setting,
				$table_truebooker_stransactions
				);
	
			} else {
				
				$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
				$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
				$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
				$table_truebooker_payments = $wpdb->prefix . 'truebooker_payments';
				$$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
				$table_truebooker_stransactions = $wpdb->prefix . 'truebooker_stransactions';
				
				$truebooker_tables = array(
				$table_truebooker_customers,
				$table_truebooker_services,
				$table_truebooker_categories,
				$table_truebooker_payments,
				$table_truebooker_setting,
				$table_truebooker_stransactions
				);
			}	
				foreach ( $truebooker_tables as $table ) {
					$wpdb->query("DROP TABLE IF EXISTS `{$table}` ");
				}
			
            do_action('truebooker_after_uninstall');
        }
		
add_action('admin_menu', 'truebooker_menu' );


function truebooker_menu()       {
	add_menu_page('Truebooker', 'Truebooker', 'manage_options', 'truebooker', 'truebooker_dashboard_form', 'dashicons-calendar-alt',30);
	add_submenu_page( 'truebooker', 'Appointments', 'Appointments', 'manage_options', 'appointments', 'truebooker_appointment_form' );
	add_submenu_page( 'truebooker', 'Customers', 'Customers', 'manage_options', 'customers', 'truebooker_customer_form' );
	add_submenu_page('truebooker', 'Services', 'Services', 'manage_options','services', 'truebooker_service');
	add_submenu_page('truebooker', 'Categories', 'Categories', 'manage_options','categories', 'truebooker_categories');					
	add_submenu_page('truebooker', 'Setting', 'Setting', 'manage_options','setting', 'truebooker_setting');	
	add_submenu_page('truebooker', 'FAQ', 'FAQ', 'manage_options','faq', 'truebooker_faq');					
}
			
function truebooker_customer_form() {
	include_once TRUEBOOKER_DIR . '/main/truebooker-user.php';
	truebooker_user_insert_data();
	truebooker_user_remove_data();
}

function truebooker_service() {
	include_once TRUEBOOKER_DIR . '/main/truebooker-service.php';
	truebooker_service_insert_data();
	truebooker_service_remove_data();
}

function truebooker_categories() {
	include_once TRUEBOOKER_DIR . '/main/truebooker-category.php';
	truebooker_service_cat_insert_data();
	truebooker_service_cat_remove_data();
}

function truebooker_dashboard_form() {
	include_once TRUEBOOKER_DIR . '/main/truebooker-dashboard.php';
	truebooker_appointment_remove_data();
	truebooker_status_update_data();
}

function truebooker_appointment_form() {
	include_once TRUEBOOKER_DIR . '/main/truebooker-appointment.php';
	truebooker_appointment_remove_data();
}

function truebooker_setting () {
	include_once TRUEBOOKER_DIR . '/main/truebooker-setting.php';
}

function truebooker_faq () {
	include_once TRUEBOOKER_DIR . '/main/truebooker-faq.php';
}


function truebooker_appointment_booking_handler(){


	global $userinsertobj, $wpdb;

	check_ajax_referer( 'truebooker_appointment_booking_nonce_action', 'security' );

	$message = array();

	$searcharray = array();
	parse_str($_POST['alldata'], $searcharray);
	

	$insertmessage = $userinsertobj->user_insertdata($searcharray);

	echo json_encode($insertmessage);
	die;	
}


add_action( 'wp_ajax_truebooker_appointment_booking_action', 'truebooker_appointment_booking_handler' );
add_action( 'wp_ajax_nopriv_truebooker_appointment_booking_action', 'truebooker_appointment_booking_handler' );