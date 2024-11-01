<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
require_once(ABSPATH . 'wp-config.php');

function truebooker_user_insert_data() {

?>
<script>
jQuery(document).ready(function() {
var ajaxurl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/truebooker-user-insert.php"; ?>';
jQuery('#submit').on('click', function(e){
    e.preventDefault();
	var data = jQuery("#submit").serialize();
    var truebooker_user_firstname = jQuery('#truebooker_user_firstname').val();
    var truebooker_user_lastname = jQuery('#truebooker_user_lastname').val();
	var truebooker_user_email = jQuery('#truebooker_user_email').val();
	var truebooker_user_phonecode = jQuery('#truebooker_user_phonecode').val();
	var truebooker_user_phone = jQuery('#truebooker_user_phone').val();
	var truebooker_user_note = jQuery('#truebooker_user_note').val();
	var truebooker_user_dt = jQuery('.truebooker_user_dt').val();
	var truebooker_user_time = jQuery('.truebooker_user_time').val();
	var truebooker_time_meridiem = jQuery('#truebooker_time_meridiem').val();
	var truebooker_user_service = jQuery('#s-name').val();
	var truebooker_user_service_p = jQuery('#s-price').val();
	var truebooker_appointment_status = 'pending';
	var truebooker_meta_box_noncename = jQuery('#truebooker_meta_box_noncename').val();

	jQuery('.tba-loderimg').removeClass('hide');

	jQuery('#category_form #submit').prop('disabled', true);
	
    jQuery.ajax({
    method: 'POST',
    dataType: 'json',
    url: ajaxurl, 
    data: { 
		truebooker_user_firstname:truebooker_user_firstname,
		truebooker_user_lastname:truebooker_user_lastname,
		truebooker_user_email:truebooker_user_email,
		truebooker_user_phonecode:truebooker_user_phonecode,
		truebooker_user_phone:truebooker_user_phone,
		truebooker_user_note:truebooker_user_note,
		truebooker_user_dt:truebooker_user_dt,
		truebooker_user_time:truebooker_user_time,
		truebooker_time_meridiem:truebooker_time_meridiem,
		truebooker_user_service:truebooker_user_service,
		truebooker_user_service_p:truebooker_user_service_p,
		truebooker_appointment_status:truebooker_appointment_status,
		truebooker_meta_box_noncename:truebooker_meta_box_noncename,
    }, 
    success: function(response) {	

    	jQuery('.tba-loderimg').addClass('hide');

		jQuery('#category_form #submit').prop('disabled', false);
		if(response.success){
			jQuery('#result').html(response.success).fadeIn('slow');
			jQuery('#result').delay(8000).fadeOut('slow');
			jQuery('#sample_form')[0].reset();
			jQuery('#summary').html(response.success.summary).fadeIn('fast');
		}
		else{
			jQuery('#result').html(response.php_error).fadeIn('slow');
			jQuery('#result').delay(8000).fadeOut('slow');
			jQuery('.fname-error').text(response.error.truebooker_user_firstname);
			jQuery('.lname-error').text(response.error.truebooker_user_lastname);
			jQuery('.email-error').text(response.error.truebooker_user_email);
			jQuery('.phone-error').text(response.error.truebooker_user_phone);
			jQuery('.date-error').text(response.error.truebooker_user_dt);
			jQuery('.time-error').text(response.error.truebooker_user_time);
			jQuery('.service-error').text(response.error.truebooker_user_service);
			jQuery('.error').delay(5000).fadeOut('slow');
		}

    }
  });

});
});
</script>
<?php } ?>	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
<div class="tba-sec-top"><h2 class="tba-page-heading"><?php echo esc_html__( 'Add New', 'truebooker' )?></h2></div>
<form method="post" name="contactForm" id="sample_form" class="truebooker-form"> 
<div id="result" style="display:none"></div>
<div class="row">
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="firstname"><?php echo esc_html__( 'First Name', 'truebooker' )?><strong class="error">*</strong></label> 
	<input type="text" name="truebooker_user_firstname" id="truebooker_user_firstname" class="form_data" value="">
	<span class="error front-er fname-error"></span>
	</div> 

	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="website"><?php echo esc_html__( 'Last Name', 'truebooker' )?><strong class="error">*</strong></label> 
	<input type="text" name="truebooker_user_lastname" id="truebooker_user_lastname" class="form_data" value=""> 
	<span class="error front-er lname-error"></span>
	</div> 

	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="email"><?php echo esc_html__( 'Email', 'truebooker' )?><strong class="error">*</strong></label> 
	<input type="text" name="truebooker_user_email" id="truebooker_user_email" class="form_data" value="">  
	<span class="error front-er email-error"></span><div id="emailStatus"></div>
	</div> 

	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="phone"><?php echo esc_html__( 'Phone', 'truebooker' )?><strong class="error">*</strong></label>	
	<input type="text" name="truebooker_user_phonecode" id="truebooker_user_phonecode" class="form_data hide" ></input>
	<input type="text" name="truebooker_user_phone" id="truebooker_user_phone" class="form_data tbaphonecode" value="">
	<span class="error front-er phone-error"></span>
	</div> 
</div>
<div class="row">
	<div class="tba-form-field col-lg-12 col-md-12 col-sm-12"> 
	<label for="note"><?php echo esc_html__( 'Note', 'truebooker' )?></label> 
	<textarea name="truebooker_user_note" id="truebooker_user_note" rows="6"></textarea> 
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
	<select class="tba-time-meridiem" name="truebooker_time_meridiem"  id="truebooker_time_meridiem">
	<option><?php echo esc_html__( 'AM', 'truebooker' )?></option>
	<option><?php echo esc_html__( 'PM', 'truebooker' )?></option>
	</select>
	</div>
	<span class="error front-er time-error"></span>
	</div>
	
	<?php
global $wpdb, $table_truebooker_customers, $truebooker_user_id, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $truebooker_user_time, $truebooker_time_meridiem, $truebooker_user_service;	
	global $wpdb, $table_truebooker_services, $truebooker_service_id,$result ;
					
	$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
	
	//$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_services}"), ARRAY_A);

$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_services}  where truebooker_service_id != %d",$tsd  
	    );
$result = $wpdb->get_results($query, ARRAY_A);

foreach ( $result as $row ){
	$service = $row['truebooker_service_name'];
	$service_price = $row['truebooker_service_name'];
}
	if(!empty($service)) { ?>
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="service"><?php echo esc_html__( 'Service', 'truebooker' )?><strong class="error">*</strong></label>
	  <select name="truebooker_user_service"  id="truebooker_service_category">
	   <option value="" disabled selected><?php echo esc_html__( 'Select Service', 'truebooker' )?></option>
	<?php
	
	foreach ( $result as $row ){
		?> 
		<option value="<?php echo esc_html__($row['truebooker_service_id']); ?>"><?php echo esc_html__($row['truebooker_service_name']); ?></option>
	<?php } ?>
	  </select>
	<span class="error front-er service-error"></span>
	<input type="hidden" name="s-price" id="s-price" value=""/>
	<input type="hidden" name="s-name" id="s-name" value=""/>
	</div>
	<?php }
	else {
?>
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<label for="service"><?php echo esc_html__( 'Service', 'truebooker' )?><strong class="error">*</strong></label>
	  <select name="truebooker_user_service"  id="truebooker_service_category">
	   <option value="" disabled selected><?php echo esc_html__( 'Please add Service', 'truebooker' )?></option>
	  </select>
	  <span class="error front-er service-error"></span>
	<input type="hidden" name="s-price" id="s-price" value=""/>
	<input type="hidden" name="s-name" id="s-name" value=""/>
	</div>
<?php
	}
	?>
	<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
	<input type="submit" name="submit" id="submit" value="Register" class="tba-button button-top-sp"/> 
	<img src="<?php echo esc_html__(TRUEBOOKER_URL).'/assets/images/loader_1.gif';?>" class="tba-loderimg hide" >
	</div>
<?php
	wp_nonce_field( 'truebooker_meta_box_nonce', 'truebooker_meta_box_noncename' );
?>
</div>
<script>jQuery(document).ready(function(){jQuery(".iti__selected-flag").addClass("tbaphonecode");});jQuery( ".tbaphonecode" ).on( "change", function(){var phone_code = jQuery('.iti__selected-dial-code').text();document.getElementById("truebooker_user_phonecode").value = phone_code;});</script>
</form>
<script>
jQuery(document).ready(function() {
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
                // Handle AJAX request error
                jQuery('#s-price').val('Error fetching price');
            }
        });
    });
	
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
                // Handle AJAX request error
                jQuery('#s-name').val('Error fetching name');
            }
        });
    });
});
</script>

<div class="tba-details-tbl-wraper">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 tba-details-tbl" id="mytable">
  <h2 class="tba-page-heading"><?php esc_html_e('Manage Customers', 'truebooker'); ?></h2>
  
  <?php 
  				
	global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result ;
	
	$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
	
	


	$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_customers}  where truebooker_user_id != %d ORDER BY truebooker_user_id DESC",$tsd  
	    );
$result = $wpdb->get_results($query, ARRAY_A);
	
  if(count($result) == 0) { ?> 
	  <h4><?php esc_html_e('No Record Found!', 'truebooker'); ?></h4> <?php  
  }
  else {?>
  
	<section class="tba-table-container">
		<div class="tba-table__header-wrapper" id="tba_user_table">
		  <form method="post" name="bulk_action_form">
		  <input id='search-box' placeholder='Search here..' class="tba_search">
			<table>
				<thead class="has-gutter">
					<tr>
						<th colspan="1" rowspan="1" class="tba-table_1_column_1 tba-table-column is-leaf tba-table__cell">
							<input type="checkbox" aria-hidden="false" class="tba-checkbox__original" name="checked" value="" id="select_all">
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="name" data-order="desc" >
							<div class="cell"><?php esc_html_e('Full Name', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell"  id="email" data-order="desc">
							<div class="cell"><?php esc_html_e('Email', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="phone" data-order="desc" >
							<div class="cell"><?php esc_html_e('Phone', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="cdate" data-order="desc" >
							<div class="cell"><?php esc_html_e('Created Date', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>

						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell deleteall" id="delete" data-order="desc" >
							<div class="cell">
							  <input type="submit" name="deleteall" id="deleteall" value="Delete" class="tba-button" onclick="return delete_confirm();"/>
							</div>
						</th>
					</tr>
				</thead>
				<?php 
				foreach ( $result as $row ){
				?>
				
				<tr>
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_html__($row['truebooker_user_id']); ?>"></td>
				<td><?php echo esc_html__($row['truebooker_user_firstname']); ?> <?php echo esc_html__($row['truebooker_user_lastname']); ?></td>
				<td><?php echo esc_html__($row['truebooker_user_email']); ?></td>
				<td><?php echo esc_html__($row['truebooker_user_phonecode']); ?> <?php echo esc_html__($row['truebooker_user_phone']); ?></td>
				<td><?php echo esc_html__($row['truebooker_user_created']); ?></td>
				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button" onclick="return delete_confirm();"/><i class="fa fa-sharp fa-light fa-trash"></i></td>
				</tr>
				
				<?php } ?>
				
			</table>
			
		</form>
		</div>
	</section>
	 <?php }?>
  </div>
</div>
</div>

</main>
 <?php 
function truebooker_user_remove_data() {
    
	global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result ;
	

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		
		if(isset($_POST["delete"])){
		
			$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
			
			if (isset($_POST['truebooker_user_id'])) {
				$truebooker_user_id = $_POST['truebooker_user_id'];
			}
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);
			
			$truebooker_sql = "DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($idStr)";
			$delete = $wpdb->query($wpdb->prepare($truebooker_sql, array($idStr)));

				if($delete){
					
					echo '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_attr( 'Success', 'truebooker' ) . '</h5><span>' . esc_attr( 'User has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
					
					header("Refresh: 0");
					?>
					
		     <script type="text/javascript"> jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");}); setTimeout(function(){ location.reload(); }, 1000);</script>
		 <?php
		
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_attr( 'Error', 'truebooker' ) . '</h5><span>' . esc_attr( 'Getting some error.', 'truebooker' ) . '</div>';
					
				}
			}else{
				echo '<div class="truebooker_error tba-popconfirm"><span>'.esc_attr( 'Select at least 1 record to delete', 'truebooker' ).'</span></div>';
					
			}
	
		}
		if(isset($_POST["deleteall"])){
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);

			$truebooker_sql = "DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($idStr)";
			$delete = $wpdb->query($wpdb->prepare($truebooker_sql, array($idStr)));

				if($delete){					
					echo '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_attr( 'Success', 'truebooker' ) . '</h5><span>' . esc_attr( 'Users has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
					
					?>
		<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload(); }, 1000);</script> <?php
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_attr( 'Error', 'truebooker' ) . '</h5><span>' . esc_attr( 'Getting some error.', 'truebooker' ) . '</div>';
					
					
				}
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><span>' . esc_attr( 'Select at least 1 record to delete', 'truebooker' ) . '</span></div>';
					
				}
		}
	}
	 
}
?>

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
<script>
function refreshSection() {
	jQuery.ajax({
    url: '<?php echo esc_html__(TRUEBOOKER_URL); ?>/main/views/truebooker-user.php/#mytable', 
    type: 'GET', 
    dataType: 'html', 
    success: function(data) {
		jQuery('#mytable').html(data); 
    },
    error: function(error) {
      console.error('Error refreshing section: ' + error);
    }
  });
}

jQuery('#submit').click(function() {
  setTimeout(function(){
	refreshSection();
   }, 2000);
});
</script>