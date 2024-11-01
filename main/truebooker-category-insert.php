<?php 
if (isset($_POST['truebooker_category_name'])) {
    $truebooker_category_name = $_POST['truebooker_category_name'];
}

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');


global $wpdb, $table_truebooker_categories, $truebooker_category_name;

global $wpdb, $table_truebooker_setting, $result, $paysandbox;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
$message = array();	


   if ( ! isset( $_POST[ 'truebooker_meta_box_noncename' ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash($_POST['truebooker_meta_box_noncename'] ) ), 'truebooker_meta_box_nonce' ) ) {
	   $er_msg =  esc_html__('Sorry, Your request can not be processed due to security reason.', 'truebooker');
	  $message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';
		echo wp_json_encode($message);
		exit;
   }
   
$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 18"), ARRAY_A);


	$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';

	$truebooker_category_name = sanitize_text_field($_POST['truebooker_category_name']);

	$data = array(
		'truebooker_category_name'=> $truebooker_category_name
	);

		if(!empty($truebooker_category_name) ){
	  
		$wpdb->insert($table_truebooker_categories,
						$data
					 );
	
		global $wpdb, $table_truebooker_setting, $result, $er_msg;
	
		$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
			
		
		$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 18"), ARRAY_A);
		
		$message ['success'] = '<div class="truebooker_success tba-popconfirm"><span>'.esc_html__( 'Category has been added successfully.', 'truebooker' ).'</span></div>'; 
			
		}
		 else {
			if(!empty($result['4']['truebooker_setting_value']) ){
				$er_msg = $result['4']['truebooker_setting_value'];
			} else {
				$er_msg ='There is some error!!';
		    }		
			$message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';
			if(empty($truebooker_category_name)) {
				$error_msg['truebooker_category_name'] = esc_html__( 'Please enter category', 'truebooker' );
			}
			$message['error'] = $error_msg;
		 }

	echo json_encode($message);
?>

