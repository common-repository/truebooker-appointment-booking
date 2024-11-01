<?php 

require_once(ABSPATH . 'wp-config.php');

global $wpdb, $table_truebooker_customers, $truebooker_user_id, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $truebooker_user_time, $truebooker_time_meridiem, $name, $truebooker_user_service, $lname , $email , $phone , $note , $date, $service_err, $time, $option1Selected, $option2Selected, $option3Selected, $option4Selected ;

global $wpdb, $table_truebooker_setting, $result;

$table_truebooker_setting = $wpdb->prefix . 'truebooker_setting';
	


$tsd = '';

$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_setting}  where truebooker_setting_id != %d ORDER BY truebooker_setting_id DESC LIMIT 20",$tsd  
	    );
$result = $wpdb->get_results($query, ARRAY_A);

?>
	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
<div class="tba-details-tbl-wraper truebooker-settingform">
<h2 class="tba-page-heading"><?php echo esc_html__( 'Settings', 'truebooker' )?></h2>

<div class="tba-sec-top">

	<ul id="tba-tab">
		<li class="nav-item active">
          <a class="nav-link" href="#tba_content1"><i class="fa fa-money"></i> <?php echo esc_html__( 'Payments Setting', 'truebooker' )?></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="#tba_content2"><i class="fa fa-comments"></i> <?php echo esc_html__( 'Messages Setting', 'truebooker' )?></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="#tba_content3"><i class="fa fa-envelope-o"></i> <?php echo esc_html__( 'Email Setting', 'truebooker' )?></a>
        </li>
	</ul>
	<div class="tab-content">
	<div class="tba-form-field tba-tab-button"> 
	<input type="submit" name="submit" id="submit" value="Save" class="tba-button button-top-sp"/> 
</div>
	<section id="tba_content1" class="tba_content" name ="payment_settings">
<form method="post" name="contactForm" id="sample_form" class="truebooker-form"> 
<div class="row">

	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'Stripe API Key', 'truebooker' )?></label> 
	<input type="text" name="truebooker_stripe_api" id="truebooker_stripe_api" class="form_data" value="<?php if(!empty($result['19']['truebooker_setting_value'])) echo esc_html__($result['19']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 

	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'Stripe Secret Key', 'truebooker' )?></label> 
	<input type="text" name="truebooker_stripe_scretkey" id="truebooker_stripe_scretkey" class="form_data" value="<?php if(!empty($result['18']['truebooker_setting_value'])) echo esc_html__($result['18']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 

	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12 hidden"> 
	<label for="website"><?php echo esc_html__( 'Select Payment', 'truebooker' )?></label> 
	<div class="tba-form-field-radio">
	    <?php 
		if((!empty($result['17']['truebooker_setting_value']))) {
			$option1Selected = ($result['17']['truebooker_setting_value'] === 'paylater') ? 'checked' : '';
        	$option2Selected = ($result['17']['truebooker_setting_value'] === 'paypal') ? 'checked' : '';
		}
		?>
		<input type="radio" <?php echo esc_html__($option1Selected); ?> name="truebooker_payment_select" id="truebooker_payment_select" value="paylater"/>
		<label for="truebooker_s_local"><?php echo esc_html__( 'Pay Later', 'truebooker' )?></label>
		<input type="radio" <?php echo esc_html__($option2Selected); ?> name="truebooker_payment_select" id="truebooker_payment_select" value="paypal" />
		<label for="truebooker_s_paypal"><?php echo esc_html__( 'Paypal', 'truebooker' )?></label>
		<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	</div> 
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'PaypPal Id', 'truebooker' )?></label> 
	<input type="text" name="truebooker_paypalid" id="truebooker_s_paypalid" class="form_data" value="<?php if(!empty($result['16']['truebooker_setting_value'])) echo esc_html__($result['16']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'PaypPal API', 'truebooker' )?></label> 
	<input type="text" name="truebooker_paypalapi" id="truebooker_s_paypalapi" class="form_data" value="<?php if(!empty($result['15']['truebooker_setting_value'])) echo esc_html__($result['15']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'PayPal Merchant Email', 'truebooker' )?></label> 
	<input type="text" name="truebooker_payment_email" id="truebooker_s_paymentemail" class="form_data" value="<?php if(!empty($result['14']['truebooker_setting_value'])) echo esc_html__($result['14']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'PayPal API Username', 'truebooker' )?></label> 
	<input type="text" name="truebooker_api_username" id="truebooker_s_apiusername" class="form_data" value="<?php if(!empty($result['13']['truebooker_setting_value'])) echo esc_html__($result['13']['truebooker_setting_value']); else echo '';  ?>" disabled>
	<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="website"><?php echo esc_html__( 'PayPal Payment Mode', 'truebooker' )?></label> 
	<?php 
	if((!empty($result['12']['truebooker_setting_value']))) {
		$option3Selected = ($result['12']['truebooker_setting_value'] === 'sandbox') ? 'checked' : '';
        $option4Selected = ($result['12']['truebooker_setting_value'] === 'live') ? 'checked' : '';
	}
		?>
	<div class="tba-form-field-radio">
		<input type="radio" <?php echo esc_html__($option3Selected); ?> name="truebooker_payment_mode" id="truebooker_payment_mode" value="sandbox" disabled/>
		<label for="truebooker_s_sandbox"><?php echo esc_html__( 'Sandbox', 'truebooker' )?></label>
		<input type="radio" <?php echo esc_html__($option4Selected); ?> name="truebooker_payment_mode" id="truebooker_payment_mode" value="live" disabled/>
		<label for="truebooker_s_live"><?php echo esc_html__( 'Live', 'truebooker' )?></label>
		<div class="extensionsValid"><?php echo esc_html__( 'Paid plan subscription required.', 'truebooker' )?></div>
	</div> 
	</div> 
	
</div>
<?php
	wp_nonce_field( 'truebooker_meta_box_nonce', 'truebooker_meta_box_noncename' );
?>
</form>
</section>

<section id="tba_content2" class="tba_content" name ="messages_settings">
<form method="post" name="contactForm" id="sample_form" class="truebooker-form"> 
<div class="row">
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="name"><?php echo esc_html__( 'No name added for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_name" id="truebooker_s_name" class="form_data" value="<?php if(!empty($result['11']['truebooker_setting_value'])) echo esc_html__($result['11']['truebooker_setting_value']); else echo esc_html__( 'Please enter your name', 'truebooker' )?>">
	</div> 
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="email"><?php echo esc_html__( 'No email added for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_mail" id="truebooker_s_mail" class="form_data" value="<?php if(!empty($result['10']['truebooker_setting_value'])) echo esc_html__($result['10']['truebooker_setting_value']); else echo esc_html__( 'Please enter your email', 'truebooker' )?>">
	</div>
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="phone"><?php echo esc_html__( 'No phone added for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_phone" id="truebooker_s_phone" class="form_data" value="<?php if(!empty($result['9']['truebooker_setting_value'])) echo esc_html__($result['9']['truebooker_setting_value']); else echo esc_html__( 'Please enter your phone', 'truebooker' )?>">
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="date"><?php echo esc_html__( 'No date selected for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_date" id="truebooker_s_date" class="form_data" value="<?php if(!empty($result['8']['truebooker_setting_value'])) echo esc_html__($result['8']['truebooker_setting_value']); else echo esc_html__( 'Please select your date', 'truebooker' )?>">
	</div>  
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="time"><?php echo esc_html__( 'No time selected for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_time" id="truebooker_s_time" class="form_data" value="<?php if(!empty($result['7']['truebooker_setting_value'])) echo esc_html__($result['7']['truebooker_setting_value']); else echo esc_html__( 'Please select your time', 'truebooker' )?>">
	</div>
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="service"><?php echo esc_html__( 'No Service selected for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_service" id="truebooker_s_service" class="form_data" value="<?php if(!empty($result['6']['truebooker_setting_value'])) echo esc_html__($result['6']['truebooker_setting_value']); else echo esc_html__( 'Please select your service', 'truebooker' )?>">
	</div>
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="success"><?php echo esc_html__( 'Success message for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_success" id="truebooker_s_success" class="form_data" value="<?php if(!empty($result['5']['truebooker_setting_value'])) echo esc_html__($result['5']['truebooker_setting_value']); else echo esc_html__( 'Appointment has been booked successfully!!', 'truebooker' )?>">
	</div>
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="error"><?php echo esc_html__( 'Error message for the booking', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_error" id="truebooker_s_error" class="form_data" value="<?php if(!empty($result['4']['truebooker_setting_value'])) echo esc_html__($result['4']['truebooker_setting_value']); else echo esc_html__( 'There is some error!!', 'truebooker' )?>">
	</div>
</div>

</form>
</section>

<section id="tba_content3" class="tba_content" name ="email_settings">
<form method="post" name="contactForm" id="sample_form" class="truebooker-form"> 
<div class="row">
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="sendername"><?php echo esc_html__( 'Sender Name', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_sendername" id="truebooker_s_sendername" class="form_data" value="<?php if(!empty($result['3']['truebooker_setting_value'])) echo esc_attr($result['3']['truebooker_setting_value']); else echo '';?>">
	</div> 
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="truebooker_s_sendermail"><?php echo esc_html__( 'Sender email', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_sendermail" id="truebooker_s_sendermail" class="form_data" value="<?php if(!empty($result['2']['truebooker_setting_value'])) echo esc_attr($result['2']['truebooker_setting_value']); else echo '';?>">
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="truebooker_s_adminmail"><?php echo esc_html__( 'Admin email', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_adminmail" id="truebooker_s_adminmail" class="form_data" value="<?php if(!empty($result['1']['truebooker_setting_value'])) echo esc_attr($result['1']['truebooker_setting_value']); else echo '';?>">
	</div> 
	<div class="tba-form-field col-lg-12 col-md-6 col-sm-12"> 
	<label for="subject"><?php echo esc_html__( 'Email Subject', 'truebooker' )?></label> 
	<input type="text" name="truebooker_s_subject" id="truebooker_s_subject" class="form_data" value="<?php if(!empty($result['0']['truebooker_setting_value'])) echo esc_attr($result['0']['truebooker_setting_value']); else echo '';?>">
	</div>  
</div>
</form>
</section>

</div>
</div>
</div>
<div id="result" class="truebooker_success" style="display:none"></div>
</main>

<script>
jQuery(document).ready(function() {
var ajaxurl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/truebooker-setting-insert.php"; ?>';
jQuery('#submit').on('click', function(e){
    e.preventDefault();
	var data = jQuery("#submit").serialize();
	var truebooker_stripe_api = jQuery('#truebooker_stripe_api').val();
	var truebooker_stripe_scretkey = jQuery('#truebooker_stripe_scretkey').val();
	var truebooker_paypalid = jQuery('#truebooker_stripe_api').val();
    var truebooker_payment_select = jQuery('input[name="truebooker_payment_select"]:checked').val();
    var truebooker_paypalid = jQuery('#truebooker_s_paypalid').val();
    var truebooker_paypalapi = jQuery('#truebooker_s_paypalapi').val();
    var truebooker_payment_email = jQuery('#truebooker_s_paymentemail').val();
    var truebooker_api_username = jQuery('#truebooker_s_apiusername').val();
    var truebooker_payment_mode = jQuery('input[name="truebooker_payment_mode"]:checked').val();
	var truebooker_s_name = jQuery('#truebooker_s_name').val();
	var truebooker_s_mail = jQuery('#truebooker_s_mail').val();
	var truebooker_s_phone = jQuery('#truebooker_s_phone').val();
	var truebooker_s_date = jQuery('#truebooker_s_date').val();
	var truebooker_s_time = jQuery('#truebooker_s_time').val();
	var truebooker_s_service = jQuery('#truebooker_s_service').val();
	var truebooker_s_success = jQuery('#truebooker_s_success').val();
	var truebooker_s_error = jQuery('#truebooker_s_error').val();
	var truebooker_s_sendername = jQuery('#truebooker_s_sendername').val();
	var truebooker_s_sendermail = jQuery('#truebooker_s_sendermail').val();
	var truebooker_s_adminmail = jQuery('#truebooker_s_adminmail').val();
	var truebooker_s_subject = jQuery('#truebooker_s_subject').val();
	var truebooker_meta_box_noncename = jQuery('#truebooker_meta_box_noncename').val();
    jQuery.ajax({
    method: 'POST',
    dataType: 'json',
    url: ajaxurl, 
    data: { 
		 truebooker_stripe_api:truebooker_stripe_api,
		 truebooker_stripe_scretkey:truebooker_stripe_scretkey,
         truebooker_payment_select:truebooker_payment_select,
		 truebooker_paypalid:truebooker_paypalid,
         truebooker_paypalapi:truebooker_paypalapi,
         truebooker_payment_email:truebooker_payment_email,
         truebooker_api_username:truebooker_api_username,
         truebooker_payment_mode:truebooker_payment_mode,
         truebooker_s_name:truebooker_s_name,
         truebooker_s_mail:truebooker_s_mail,
         truebooker_s_phone:truebooker_s_phone,
         truebooker_s_date:truebooker_s_date,
         truebooker_s_time:truebooker_s_time,
         truebooker_s_service:truebooker_s_service,
         truebooker_s_success:truebooker_s_success,
         truebooker_s_error:truebooker_s_error,
         truebooker_s_sendername:truebooker_s_sendername,
         truebooker_s_sendermail:truebooker_s_sendermail,
         truebooker_s_adminmail:truebooker_s_adminmail,
         truebooker_s_subject:truebooker_s_subject,
         truebooker_meta_box_noncename:truebooker_meta_box_noncename,
    }, 
    success: function(response) {		
		jQuery('#result').text(response.success).fadeIn('slow');
		jQuery('#result').delay(8000).fadeOut('slow');
    }
  });

});
});
</script>

<script>
(function () {
    var showResults;
    jQuery('#search-box').keyup(function () {
        var searchText;
        searchText = jQuery('#search-box').val();
        return showResults(searchText);
    });
    showResults = function (searchText) {
        jQuery('tbody tr').hide();
        return jQuery('tbody tr:Contains(' + searchText + ')').show();
    };
    jQuery.expr[':'].Contains = jQuery.expr.createPseudo(function (arg) {
        return function (elem) {
            return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
}.call(this));
</script>