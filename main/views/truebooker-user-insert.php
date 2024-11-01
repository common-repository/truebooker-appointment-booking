<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../../wp-config.php');

global $wpdb, $table_truebooker_customers, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phonecode, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $truebooker_user_time, $truebooker_time_meridiem, $truebooker_user_service, $truebooker_appointment_status;

   if ( ! isset( $_POST[ 'truebooker_meta_box_noncename' ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash($_POST['truebooker_meta_box_noncename'] ) ), 'truebooker_meta_box_nonce' ) ) {
	   $er_msg =  esc_html__('Sorry, Your request can not be processed due to security reason.', 'truebooker');
	  $message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';
		echo wp_json_encode($message);
		exit;
   }

if (isset($_POST['truebooker_user_firstname'])) {
    $truebooker_user_firstname = $_POST['truebooker_user_firstname'];
}
if (isset($_POST['truebooker_user_lastname'])) {
    $truebooker_user_lastname = sanitize_text_field($_POST['truebooker_user_lastname']);
}
if (isset($_POST['truebooker_user_email'])) {
    $truebooker_user_email = $_POST['truebooker_user_email'];
}
if (isset($_POST['truebooker_user_phonecode'])) {
    $truebooker_user_phonecode = $_POST['truebooker_user_phonecode'];
}
if (isset($_POST['truebooker_user_phone'])) {
    $truebooker_user_phone = $_POST['truebooker_user_phone'];
}
if (isset($_POST['truebooker_user_note'])) {
    $truebooker_user_note = sanitize_text_field($_POST['truebooker_user_note']);
}
if (isset($_POST['truebooker_user_dt'])) {
    $truebooker_user_dt = $_POST['truebooker_user_dt'];
}	
if (isset($_POST['truebooker_user_time'])) {
    $truebooker_user_time = $_POST['truebooker_user_time'];
}
if (isset($_POST['truebooker_time_meridiem'])) {
    $truebooker_time_meridiem = $_POST['truebooker_time_meridiem'];
}
if (isset($_POST['truebooker_user_service'])) {
    $truebooker_user_service = $_POST['truebooker_user_service'];
}
if (isset($_POST['truebooker_user_service_p'])) {
    $truebooker_user_service_p = $_POST['truebooker_user_service_p'];
}
if (isset($_POST['truebooker_appointment_status'])) {
    $truebooker_appointment_status = $_POST['truebooker_appointment_status'];
}	

global $wpdb, $table_truebooker_setting, $result, $paysandbox;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
$message = $summary = array();	

$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 20"), ARRAY_A);

	
	global $wpdb, $table_truebooker_setting, $result;

	$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';

	$truebooker_user_firstname = sanitize_text_field($_POST['truebooker_user_firstname']);
	$truebooker_user_lastname = sanitize_text_field($_POST['truebooker_user_lastname']);
	$truebooker_user_email = sanitize_text_field($_POST['truebooker_user_email']);
	$truebooker_user_phone = sanitize_text_field($_POST['truebooker_user_phone']);
	$truebooker_user_phonecode = sanitize_text_field($_POST['truebooker_user_phonecode']);
	$truebooker_user_note = sanitize_text_field($_POST['truebooker_user_note']);
	$truebooker_user_service = sanitize_text_field($_POST['truebooker_user_service']);
	$truebooker_user_dt = sanitize_text_field($_POST['truebooker_user_dt']);
	$truebooker_user_time = sanitize_text_field($_POST['truebooker_user_time']);
	$truebooker_time_meridiem = sanitize_text_field($_POST['truebooker_time_meridiem']);
	$truebooker_appointment_status = sanitize_text_field($_POST['truebooker_appointment_status']);
	
	
	$data = array(
		'truebooker_user_firstname'=> $truebooker_user_firstname,
		'truebooker_user_lastname'=> $truebooker_user_lastname,
		'truebooker_user_email'=> $truebooker_user_email,
		'truebooker_user_phone'=> $truebooker_user_phone,
		'truebooker_user_phonecode'=> $truebooker_user_phonecode,
		'truebooker_user_note'=> $truebooker_user_note,
		'truebooker_user_service'=> $truebooker_user_service,
		'truebooker_user_dt'=> $truebooker_user_dt,
		'truebooker_user_time'=> $truebooker_user_time,
		'truebooker_time_meridiem'=> $truebooker_time_meridiem,
		'truebooker_appointment_status'=> $truebooker_appointment_status
	);


		if(!empty($truebooker_user_firstname) && !empty($truebooker_user_lastname) && !empty($truebooker_user_email) && !empty($truebooker_user_phone) && !empty($truebooker_user_dt) && !empty($truebooker_user_time) && !empty($truebooker_user_service) ) {
	  
		$wpdb->insert($table_truebooker_customers,
						  $data
						  );
	
		global $wpdb, $table_truebooker_setting, $result, $paysandbox, $suc_msg;
	
		$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
			
		$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_truebooker_setting ORDER BY truebooker_setting_id DESC LIMIT 20"), ARRAY_A);
						 
		$to       = sanitize_text_field($_POST['truebooker_user_email']);
		$from     = $result['2']['truebooker_setting_value'];
		$subject  = $result['0']['truebooker_setting_value'];
		$details  = ''. esc_html__( 'Your Appointment Booked successfully!', 'truebooker' ).'

'.esc_html__( 'Customer Name:', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_firstname']).' '.sanitize_text_field($_POST['truebooker_user_lastname']).'
'.esc_html__( 'Service:', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_service']).'
'.esc_html__( 'Date & Time:', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_dt']).' '.sanitize_text_field($_POST['truebooker_user_time']).' '.sanitize_text_field($_POST['truebooker_time_meridiem']).'
	
'.esc_html__( 'Thank you,', 'truebooker' ).'';
		$details2 = ''.esc_html__( 'Hi administrator,', 'truebooker' ).'

'.esc_html__( 'You have one confirmed', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_service']).' '.esc_html__( 'appointment of', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_firstname']).' '.sanitize_text_field($_POST['truebooker_user_lastname']).'. '.esc_html__( 'The appointment is added to your schedule.', 'truebooker' ).'

'.esc_html__( 'Thank you,', 'truebooker' ).'';
		$headers = ''.esc_html__( 'From:', 'truebooker' ).' '.get_option('admin_email').'';
		$headers2 = ''.esc_html__( 'From:', 'truebooker' ).' '.sanitize_text_field($_POST['truebooker_user_email']).'';
	
		wp_mail($to, $subject, $details, $headers);
		wp_mail($from, $subject, $details2, $headers2);

		if(!empty($result['5']['truebooker_setting_value']) ){
			$suc_msg = $result['5']['truebooker_setting_value'];
		} else {
			$suc_msg ='Appointment has been booked successfully!!';
		}
		$message ['success'] = '<div class="truebooker_success tba-popconfirm"><span>'.$suc_msg.'</span></div>'; 

		}
		 else {
			if(!empty($result['4']['truebooker_setting_value']) ){
				$er_msg = $result['4']['truebooker_setting_value'];
			} else {
				$er_msg ='There is some error!!';
		    }
			$message ['php_error']= '<div class="truebooker_error tba-popconfirm"><span>'.$er_msg.'</span></div>';

			if(!empty($result['11']['truebooker_setting_value']) ){
				$er_msg = $result['11']['truebooker_setting_value'];
			} else {
				$er_msg ='Please enter your name';
		    }
			if(empty($truebooker_user_firstname)) {
				$error_msg['truebooker_user_firstname'] = $er_msg;
			}
			if(empty($truebooker_user_lastname)) {
				$error_msg['truebooker_user_lastname'] = $er_msg;
			}

			if(!empty($result['10']['truebooker_setting_value']) ){
				$er_msg = $result['10']['truebooker_setting_value'];
			} else {
				$er_msg ='Please enter your email';
		    }
			if(empty($truebooker_user_email)) {
				$error_msg['truebooker_user_email'] = $er_msg;
			}
			else {
				if (!filter_var($truebooker_user_email, FILTER_VALIDATE_EMAIL)) {
					$error_msg['truebooker_user_email'] = "Please enter valid email address";
				}
			}

			if(!empty($result['9']['truebooker_setting_value']) ){
				$er_msg = $result['9']['truebooker_setting_value'];
			} else {
				$er_msg ='Please enter your phone';
		    }
			if(empty($truebooker_user_phone)) {
				$error_msg['truebooker_user_phone'] = $er_msg;
			}
			else {
				if (!preg_match("/^[0-9]*$/", $truebooker_user_phone)) {
					$error_msg['truebooker_user_phone'] = "Only numeric value is allowed";
				}
			}

			if(!empty($result['8']['truebooker_setting_value']) ){
				$er_msg = $result['8']['truebooker_setting_value'];
			} else {
				$er_msg ='Please select date';
		    }
			if(empty($truebooker_user_dt)) {
				$error_msg['truebooker_user_dt'] = $er_msg;
			}

			if(!empty($result['7']['truebooker_setting_value']) ){
				$er_msg = $result['7']['truebooker_setting_value'];
			} else {
				$er_msg ='Please select time';
		    }
			if(empty($truebooker_user_time)) {
				$error_msg['truebooker_user_time'] = $er_msg;
			}

			if(!empty($result['6']['truebooker_setting_value']) ){
				$er_msg = $result['6']['truebooker_setting_value'];
			} else {
				$er_msg ='Please select service';
		    }
			if(empty($truebooker_user_service)) {
				$error_msg['truebooker_user_service'] = $er_msg;
			}
			$message['error']=$error_msg;
		 }

	echo json_encode($message);
?>