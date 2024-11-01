<?php

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
global $wpdb, $table_truebooker_payments, $truebooker_user_id, $truebooker_paypalid, $truebooker_paypalapi, $truebooker_payment_email, $truebooker_api_username, $truebooker_payment_mode, $table_truebooker_setting, $truebooker_payment_select, $truebooker_s_name, $truebooker_s_mail, $truebooker_s_phone, $truebooker_s_date, $truebooker_s_time, $truebooker_s_service, $truebooker_s_success, $truebooker_s_error, $truebooker_s_sendername, $truebooker_s_sendermail, $truebooker_s_adminmail, $truebooker_s_subject, $payment_setting, $messages_settings, $email_settings, $truebooker_stripe_api, $truebooker_stripe_scretkey;

   if ( ! isset( $_POST[ 'truebooker_meta_box_noncename' ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash($_POST['truebooker_meta_box_noncename'] ) ), 'truebooker_meta_box_nonce' ) ) {
	   $er_msg =  esc_html__('Sorry, Your request can not be processed due to security reason.', 'truebooker');
	  $message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';
		echo wp_json_encode($message);
		exit;
   }
   
if (isset($_POST['truebooker_stripe_api'])) {
    $truebooker_stripe_api = $_POST['truebooker_stripe_api'];
}
if (isset($_POST['truebooker_stripe_scretkey'])) {
    $truebooker_stripe_scretkey = $_POST['truebooker_stripe_scretkey'];
}
if (isset($_POST['truebooker_payment_select'])) {
    $truebooker_payment_select = sanitize_text_field($_POST['truebooker_payment_select']);
}
if (isset($_POST['truebooker_paypalid'])) {
    $truebooker_paypalid = $_POST['truebooker_paypalid'];
}
if (isset($_POST['truebooker_paypalapi'])) {
    $truebooker_paypalapi = $_POST['truebooker_paypalapi'];
}
if (isset($_POST['truebooker_payment_email'])) {
    $truebooker_payment_email = sanitize_text_field($_POST['truebooker_payment_email']);
}
if (isset($_POST['truebooker_api_username'])) {
    $truebooker_api_username = $_POST['truebooker_api_username'];
}
if (isset($_POST['truebooker_payment_mode'])) {
    $truebooker_payment_mode = $_POST['truebooker_payment_mode'];
}
if (isset($_POST['truebooker_s_sendername'])) {
    $truebooker_s_sendername = $_POST['truebooker_s_sendername'];
}	
if (isset($_POST['truebooker_s_sendermail'])) {
    $truebooker_s_sendermail = $_POST['truebooker_s_sendermail'];
}
if (isset($_POST['truebooker_s_adminmail'])) {
    $truebooker_s_adminmail = $_POST['truebooker_s_adminmail'];
}
if (isset($_POST['truebooker_s_subject'])) {
    $truebooker_s_subject = $_POST['truebooker_s_subject'];
}	
	
global $wpdb, $table_truebooker_setting, $result;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
    
	$truebooker_stripe_api = sanitize_text_field($_POST['truebooker_stripe_api']);
	$truebooker_stripe_scretkey = sanitize_text_field($_POST['truebooker_stripe_scretkey']);
	$truebooker_payment_select = sanitize_text_field($_POST['truebooker_payment_select']);
	$truebooker_paypalid = sanitize_text_field($_POST['truebooker_paypalid']);
	$truebooker_paypalapi = sanitize_text_field($_POST['truebooker_paypalapi']);
	$truebooker_payment_email = sanitize_text_field($_POST['truebooker_payment_email']);
	$truebooker_api_username = sanitize_text_field($_POST['truebooker_api_username']);
	$truebooker_payment_mode = sanitize_text_field($_POST['truebooker_payment_mode']);
	$truebooker_s_name = sanitize_text_field($_POST['truebooker_s_name']);
	$truebooker_s_mail = sanitize_text_field($_POST['truebooker_s_mail']);
	$truebooker_s_phone = sanitize_text_field($_POST['truebooker_s_phone']);
	$truebooker_s_date = sanitize_text_field($_POST['truebooker_s_date']);
	$truebooker_s_time = sanitize_text_field($_POST['truebooker_s_time']);
	$truebooker_s_service = sanitize_text_field($_POST['truebooker_s_service']);
	$truebooker_s_success = sanitize_text_field($_POST['truebooker_s_success']);
	$truebooker_s_error = sanitize_text_field($_POST['truebooker_s_error']);
	$truebooker_s_sendername = sanitize_text_field($_POST['truebooker_s_sendername']);
	$truebooker_s_sendermail = sanitize_text_field($_POST['truebooker_s_sendermail']);
	$truebooker_s_adminmail = sanitize_text_field($_POST['truebooker_s_adminmail']);
	$truebooker_s_subject = sanitize_text_field($_POST['truebooker_s_subject']);
	
	
	$payment_setting = esc_html__( 'payment_settings', 'truebooker' );
	$messages_settings = esc_html__( 'messages_settings', 'truebooker' );
	$email_settings = esc_html__( 'email_settings', 'truebooker' );

	
	$data = array(
		array(
			'truebooker_setting_name' => 'truebooker_stripe_api', 
			'truebooker_setting_value' => $truebooker_stripe_api,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_stripe_scretkey', 
			'truebooker_setting_value' => $truebooker_stripe_scretkey,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_payment_select', 
			'truebooker_setting_value' => $truebooker_payment_select,
			'truebooker_setting_type' => $payment_setting,
		),
	    array(
			'truebooker_setting_name' => 'truebooker_paypalid',
			'truebooker_setting_value' => $truebooker_paypalid,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_paypalapi',
			'truebooker_setting_value' => $truebooker_paypalapi,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_payment_email', 
			'truebooker_setting_value' => $truebooker_payment_email,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_api_username', 
			'truebooker_setting_value' => $truebooker_api_username,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_payment_mode', 
			'truebooker_setting_value' => $truebooker_payment_mode,
			'truebooker_setting_type' => $payment_setting,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_name', 
			'truebooker_setting_value' => $truebooker_s_name,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_mail', 
			'truebooker_setting_value' => $truebooker_s_mail,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_phone', 
			'truebooker_setting_value' => $truebooker_s_phone,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_date', 
			'truebooker_setting_value' => $truebooker_s_date,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_time', 
			'truebooker_setting_value' => $truebooker_s_time,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_service', 
			'truebooker_setting_value' => $truebooker_s_service,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_success', 
			'truebooker_setting_value' => $truebooker_s_success,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_error', 
			'truebooker_setting_value' => $truebooker_s_error,
			'truebooker_setting_type' => $messages_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_sendername', 
			'truebooker_setting_value' => $truebooker_s_sendername,
			'truebooker_setting_type' => $email_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_sendermail', 
			'truebooker_setting_value' => $truebooker_s_sendermail,
			'truebooker_setting_type' => $email_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_adminmail', 
			'truebooker_setting_value' => $truebooker_s_adminmail,
			'truebooker_setting_type' => $email_settings,
		),
		array(
			'truebooker_setting_name' => 'truebooker_s_subject', 
			'truebooker_setting_value' => $truebooker_s_subject,
			'truebooker_setting_type' => $email_settings,
		),		
	);


$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 18"), ARRAY_A);

$where = array (
	'truebooker_setting_id' => $result['truebooker_setting_value'],
);
	
  if (!empty($result)) {

	foreach ($data as $value) {


		$post_ttmfoodsystem_setting_name = $value['truebooker_setting_name'];
  		$post_ttmfoodsystem_setting_value = $value['truebooker_setting_value'];

  		$whereclause = "where `truebooker_setting_name` = '$post_ttmfoodsystem_setting_name)'";

  		$settingdata  = $wpdb->get_results( "SELECT * FROM $table_truebooker_setting  $whereclause",  object);

		if(!empty($settingdata))
	  		{
	  			foreach ($settingdata as $setddata)
	  			{
	  			  $ttmfoodsystem_setting_id = $setddata->ttmfoodsystem_setting_id;
	  			  $wpdb->update($table_truebooker_setting, array('ttmfoodsystem_setting_value'=>$post_ttmfoodsystem_setting_value), array('ttmfoodsystem_setting_id'=>$ttmfoodsystem_setting_id));
	  			}

	  		}
	  		else
	  		{

	  			$wpdb->insert( $table_truebooker_setting, $value );

	  		}
		}



	$msg=['success'=>'data updated successfully'];
	echo wp_json_encode($msg);
  }
  else {
	foreach ($data as $value) {	
		$wpdb->insert(
			$table_truebooker_setting,
			$value
		);
	}
	$msg=['success'=>'data inserted successfully'];
	echo wp_json_encode($msg);
  }
?>