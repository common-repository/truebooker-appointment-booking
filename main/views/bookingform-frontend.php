<?php 
function truebooker_bookingform_view() {

ob_start();

	global $wpdb, $table_truebooker_services, $truebooker_service_id, $result, $service_price, $select_payment ;
					
	$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
	

	$tsd = '';

		$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_services} where truebooker_service_id != %d",$tsd  
	 );

// Execute the query
$result = $wpdb->get_results($query, ARRAY_A);

	foreach ( $result as $row ){
		$service_price = $row['truebooker_service_price'];
	}


global $wpdb, $table_truebooker_customers, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_phonecode, $truebooker_user_note, $truebooker_created_at, $truebooker_user_dt, $truebooker_user_service, $message, $nameErr, $lnameErr, $emailErr, $phone_err, $date_err, $service_err, $headers, $headers2, $message1, $subject, $to, $truebooker_time_meridiem, $truebooker_appointment_status, $details2, $details, $summary;


global $wpdb, $table_truebooker_setting, $result, $paysandbox;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
	


$tsd = '';

		$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_setting}  where truebooker_setting_id != %d ORDER BY truebooker_setting_id",$tsd  
	 );
$result = $wpdb->get_results($query, ARRAY_A);
if(!empty($result['19']['truebooker_setting_value'])) {
	$truebooker_stripe_api = $result['19']['truebooker_setting_value']; 
}
else {
	$truebooker_stripe_api = '';
}

if(!empty($result['18']['truebooker_setting_value'])) {
	$truebooker_stripe_scretkey = $result['18']['truebooker_setting_value']; 
}
else {
	$truebooker_stripe_scretkey = '';
}
define('TRUEBOOKER_STRIPE_SECRET_KEY', $truebooker_stripe_scretkey); 
define('TRUEBOOKER_STRIPE_API_KEY', $truebooker_stripe_api);

?>	

<form method="post" name="contactForm" id="sample_form" class="truebooker-form">
	<div id="result" style="display:none"></div>
	<div class="row">
		<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
		<label for="firstname"><?php echo esc_html__( 'First Name', 'truebooker' )?><strong class="error">*</strong></label> 
		<input type="text" name="truebooker_user_firstname" id="truebooker_user_firstname" class="form_data" placeholder="Enter first name" value= "">
		<span class="error front-er fname-error"></span>
		</div> 

		<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
		<label for="website"><?php echo esc_html__( 'Last Name', 'truebooker' )?><strong class="error">*</strong></label> 
		<input type="text" name="truebooker_user_lastname" id="truebooker_user_lastname" class="form_data" placeholder="Enter last name" value= ""> 
		<span class="error front-er lname-error"></span>
		</div> 

		<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
		<label for="email"><?php echo esc_html__( 'Email', 'truebooker' )?><strong class="error">*</strong></label> 
		<input type="text" name="truebooker_user_email" id="truebooker_user_email" class="form_data" placeholder="Enter your email" value= "">  
		<span class="error front-er email-error"></span><div id="emailStatus"></div>
		</div> 

		<div class="tba-form-field col-lg-3 col-md-6 col-sm-12 truebooker__phone"> 
		<label for="phone"><?php echo esc_html__( 'Phone', 'truebooker' )?><strong class="error">*</strong></label> 
		<input type="text" name="truebooker_user_phonecode" id="truebooker_user_phonecode" class="form_data hide"></input>
		<input type="tel" name="truebooker_user_phone" id="truebooker_user_phone" class="form_data" value=""> 
		<span class="error front-er phone-error"></span>
		</div> 
	</div>
	<div class="row">
		<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
		<label for="note"><?php echo esc_html__( 'Note', 'truebooker' )?></label> 
		<textarea name="truebooker_user_note" id="truebooker_user_note" rows="6" placeholder="Enter description"></textarea> 
		</div>
	</div>
<div class="row">	
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
		<label for="datetime"><?php echo esc_html__( 'Booking Date', 'truebooker' )?><strong class="error">*</strong></label>
		<input placeholder="yyyy-mm-dd" type="text" name="truebooker_user_dt" id="datepicker" value="" class="calendar form_data truebooker_user_dt">
		<span class="error front-er date-error"></span>
	</div>
	
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12 tba-time"> 
		<label for="datetime"><?php echo esc_html__( 'Booking Time', 'truebooker' )?><strong class="error">*</strong></label>
		<div class="tba-time-duration">
		<input placeholder="Select your time" type="text" name="truebooker_user_time" id="timepicker" value="" class="calendar form_data truebooker_user_time">
			<div class="tba_select_icon">
			<select class="tba-time-meridiem" name="truebooker_time_meridiem"  id="truebooker_time_meridiem">
				<option value="AM"><?php echo esc_html__( 'AM', 'truebooker' )?></option>
				<option value="PM"><?php echo esc_html__( 'PM', 'truebooker' )?></option>
			</select>
			</div>
		</div>
		<span class="error front-er time-error"></span>
	</div>
	
	<?php
	global $wpdb, $table_truebooker_services, $truebooker_service_id,$result ;
					
	$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
	
	

	$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_services}  where truebooker_service_id != %d",$tsd  
	    );
$result = $wpdb->get_results($query, ARRAY_A);

foreach ( $result as $row ){
	$service = $row['truebooker_service_name'];
}
	if(!empty($service)) { ?>
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="service"><?php echo esc_html__( 'Service', 'truebooker' )?><strong class="error">*</strong></label>
	<div class="tba_select_icon">
	  <select name="truebooker_user_service"  id="truebooker_service_category">
	   <option value="" disabled selected><?php echo esc_html__( 'Select service', 'truebooker' )?></option>
	<?php
	foreach ( $result as $row ) {
		?> 
		<option value="<?php echo esc_html__($row['truebooker_service_id']); ?>"><?php echo esc_html__($row['truebooker_service_name']); ?></option>
	<?php } ?>
	  </select>
	</div>
    <span class="error front-er service-error"></span>
	<input type="hidden" name="s-price" id="s-price" value=""/>
	<input type="hidden" name="s-name" id="s-name" value=""/>
	</div>
	<?php }
	else {
?>
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="service"><?php echo esc_html__( 'Service', 'truebooker' )?><strong class="error">*</strong></label>
	<div class="tba_select_icon">
	  <select name="truebooker_user_service"  id="truebooker_service_category">
	   <option value="" disabled selected><?php echo esc_html__( 'Please add service', 'truebooker' )?></option>
	  </select>
	</div>
	  <span class="error front-er service-error"></span>
	<input type="hidden" name="s-price" id="s-price" value=""/>
	<input type="hidden" name="s-name" id="s-name" value=""/>
	</div>
<?php
	}
	?>
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
		<input type="submit" name="submit" id="submit" value="Book Appointment" class="tba-button button-top-sp"/>
	</div>
</div>
<?php
	// Noncename needed to verify where the data originated
	wp_nonce_field( 'truebooker_meta_box_nonce', 'truebooker_meta_box_noncename' );
?>
</form>
	<div id="summary"></div>

<script>

jQuery(document).ready(function() {
//var ajaxurl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/views/truebooker-user-insert.php"; ?>';
jQuery('#submit').on('click', function(e){
    e.preventDefault();
	var sample_form = jQuery("#sample_form").serialize();
    var truebooker_user_firstname = jQuery('#truebooker_user_firstname').val();
    var truebooker_user_lastname = jQuery('#truebooker_user_lastname').val();
	var truebooker_user_email = jQuery('#truebooker_user_email').val();
	var truebooker_user_phonecode = jQuery('#truebooker_user_phonecode').val();
	var truebooker_user_phone = jQuery('#truebooker_user_phone').val();
	var truebooker_user_note = jQuery('#truebooker_user_note').val();
	var truebooker_user_dt = jQuery('.truebooker_user_dt').val();
	var truebooker_user_time = jQuery('.truebooker_user_time').val();
	var truebooker_meta_box_noncename = jQuery('#truebooker_meta_box_noncename').val();
	var truebooker_time_meridiem = jQuery('#truebooker_time_meridiem').val();
	var truebooker_user_service = jQuery('#s-name').val();
	var truebooker_user_service_p = jQuery('#s-price').val();
	var truebooker_appointment_status = 'pending';
	
	jQuery.ajax({
    method: 'POST',
    dataType: 'json',
    url: truebookerPluginData.ajax_url, 
    data: { 
		security: truebookerPluginData.nonce,
		action:'truebooker_appointment_booking_action',
		alldata: sample_form
    }, 
    success: function(response) {	
		if(response.success){
			jQuery('#result').html(response.success).fadeIn('slow');
			jQuery('#result').delay(5000).fadeOut('slow');
			jQuery('#sample_form')[0].reset();
			jQuery('#summary').html(response.success.summary).fadeIn('fast');
		}
		else{
			jQuery('#result').html(response.php_error).fadeIn('slow');
			jQuery('#result').delay(5000).fadeOut('slow');
			jQuery('.fname-error').text(response.error.truebooker_user_firstname);
			jQuery('.lname-error').text(response.error.truebooker_user_lastname);
			jQuery('.email-error').text(response.error.truebooker_user_email);
			jQuery('.phone-error').text(response.error.truebooker_user_phone);
			jQuery('.date-error').text(response.error.truebooker_user_dt);
			jQuery('.time-error').text(response.error.truebooker_user_time);
			jQuery('.service-error').text(response.error.truebooker_user_service);
			jQuery('.error').fadeIn('fast');
			jQuery('.error').delay(5000).fadeOut('slow');
		}

    }
  });

});
});
</script>

<script>
jQuery(document).ready(function() {
    // Attach an event listener to the name select field
    jQuery('#truebooker_service_category').on('change', function() {
        const selectedName = jQuery(this).val();
		var AjaxUrl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/truebooker-service-price.php"; ?>';
        jQuery.ajax({
			url: AjaxUrl,
            method: 'POST', 
            data: { tba_service_id: selectedName }, 
            dataType: 'json', 
            success: function(response) {
                if (response) {
                    jQuery('#s-price').val(response);
                } else {
                    jQuery('#s-price').val('Price not found');
                }
            },
            error: function() {
                jQuery('#s-price').val('Error fetching price');
            }
        });
    });
	
	// Attach an event listener to the name select field
    jQuery('#truebooker_service_category').on('change', function() {
        const selectedName = jQuery(this).val(); 
		var AjaxUrl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/truebooker-service-name.php"; ?>';
        jQuery.ajax({
			url: AjaxUrl,
            method: 'POST', 
            data: { tba_service_id: selectedName }, 
            dataType: 'json', 
            success: function(response) {
                if (response) {
                    jQuery('#s-name').val(response);
                } else {
                    jQuery('#s-name').val('Name not found');
                }
            },
            error: function() {
                jQuery('#s-name').val('Error fetching name');
            }
        });
    });
});
</script>
<?php
	return ob_get_clean();
}
add_shortcode('booking_form','truebooker_bookingform_view');
