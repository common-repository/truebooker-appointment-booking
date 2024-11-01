<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');

global $wpdb, $table_truebooker_services, $truebooker_service_id, $truebooker_service_name, $truebooker_service_category, $truebooker_service_duration_val, $truebooker_service_duration_unit, $truebooker_service_price, $truebooker_service_description;

   if ( ! isset( $_POST[ 'truebooker_meta_box_noncename' ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash($_POST['truebooker_meta_box_noncename'] ) ), 'truebooker_meta_box_nonce' ) ) {
	   $er_msg =  esc_html__('Sorry, Your request can not be processed due to security reason.', 'truebooker');
	  $message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';
		echo wp_json_encode($message);
		exit;
   }
   
if (isset($_POST['truebooker_service_name'])) {
    $truebooker_service_name = $_POST['truebooker_service_name'];
}
if (isset($_POST['truebooker_service_category'])) {
    $truebooker_service_category = sanitize_text_field($_POST['truebooker_service_category']);
}
if (isset($_POST['truebooker_service_duration_val'])) {
    $truebooker_service_duration_val = $_POST['truebooker_service_duration_val'];
}
if (isset($_POST['truebooker_service_duration_unit'])) {
    $truebooker_service_duration_unit = $_POST['truebooker_service_duration_unit'];
}
if (isset($_POST['truebooker_service_price'])) {
    $truebooker_service_price = $_POST['truebooker_service_price'];
}
if (isset($_POST['truebooker_service_description'])) {
    $truebooker_service_description = $_POST['truebooker_service_description'];
}

global $wpdb, $table_truebooker_setting, $result;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
$message = array();	

$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 18"), ARRAY_A);


$table_truebooker_services = $wpdb->prefix . 'truebooker_service';

	$truebooker_service_name = sanitize_text_field($_POST['truebooker_service_name']);
	$truebooker_service_category = sanitize_text_field($_POST['truebooker_service_category']);
	$truebooker_service_duration_val = sanitize_text_field($_POST['truebooker_service_duration_val']);
	$truebooker_service_duration_unit = sanitize_text_field($_POST['truebooker_service_duration_unit']);
	$truebooker_service_price = sanitize_text_field($_POST['truebooker_service_price']);
	$truebooker_service_description = sanitize_text_field($_POST['truebooker_service_description']);

	$data = array(
		'truebooker_service_name'=> $truebooker_service_name,
		'truebooker_service_category'=> $truebooker_service_category,
		'truebooker_service_duration_val'=> $truebooker_service_duration_val,
		'truebooker_service_duration_unit'=> $truebooker_service_duration_unit,
		'truebooker_service_price'=> $truebooker_service_price,
		'truebooker_service_description'=> $truebooker_service_description
	);

		if(!empty($truebooker_service_name) && !empty($truebooker_service_category) && !empty($truebooker_service_duration_val) && !empty($truebooker_service_price) ){
	  
		$wpdb->insert($table_truebooker_services,
						  $data
						  );
	
		global $wpdb, $table_truebooker_setting, $result, $paysandbox, $er_msg;
	
		$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
			
		
		$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 18"), ARRAY_A);

			
		$message ['success'] = '<div class="truebooker_success tba-popconfirm"><span>'.esc_html__( 'Service has been added successfully.', 'truebooker' ).'</span></div>'; 
			
		} else {
			if(!empty($result['4']['truebooker_setting_value']) ){
				$er_msg = $result['4']['truebooker_setting_value'];
			} else {
				$er_msg ='There is some error!!';
		    }
			$message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';

			if(empty($truebooker_service_name)) {
				$error_msg['truebooker_service_name'] = esc_html__( 'Please enter service', 'truebooker' );
			}
			if(empty($truebooker_service_category)) {
				$error_msg['truebooker_service_category'] = esc_html__( 'Please select category', 'truebooker' );
			}
			if(empty($truebooker_service_duration_val)) {
				$error_msg['truebooker_service_duration_val'] = esc_html__( 'Please enter duration value', 'truebooker' );
			}
			if(empty($truebooker_service_price)) {
				$error_msg['truebooker_service_price'] = esc_html__( 'Please enter price', 'truebooker' );
			}

			$message['error']=$error_msg;
		 }

	echo wp_json_encode($message);
	?>