<script>setTimeout(function tba_user_insert_data() { jQuery( ".tba-popconfirm" ).hide(); }, 4000);</script>
<?php 
require_once(ABSPATH . 'wp-config.php');

$nameErr = $lnameErr = $emailErr = $phone_err = $date_err = "";    

global $wpdb, $table_truebooker_customers, $truebooker_user_id, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $name, $lname , $email , $phone , $note , $date;
?>	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
<div class="tba-details-tbl-wraper">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 tba-dashboard">
<h2 class="tba-page-heading"><?php esc_html_e('Dashboard', 'truebooker'); ?></h2>
<div class="tba-dashboard-summary">
<div class="tba-dash-summary-item total-appointment">
<?php
$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
$appointment_count = $wpdb->get_var( "SELECT COUNT(*) FROM {$table_truebooker_customers}" );

if ($appointment_count == 0){
	echo "<h3>0</h3>";
}
else {
echo "<h3>".esc_html__($appointment_count)."</h3>"; 
}
?>

<p><?php esc_html_e('Total Appointments', 'truebooker'); ?></p>
</div>
<div class="tba-dash-summary-item pending-appointment">
<?php
$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';


$tsd = 'Pending';

	$query = $wpdb->prepare(
	    "SELECT truebooker_appointment_status FROM {$table_truebooker_customers}  where truebooker_appointment_status = %s",$tsd  
	    );

$appointment_status = $wpdb->get_results($query, ARRAY_A);

$appointment_status_count = count($appointment_status);
if ($appointment_status_count == 0){
	echo "<h3>0</h3>";
}
else {
echo "<h3>".esc_html__($appointment_status_count)."</h3>"; 
}?>

<p><?php esc_html_e('Pending Appointments', 'truebooker'); ?></p>
</div>
<div class="tba-dash-summary-item truebooker-users">
<?php

$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';

if (isset($_POST['truebooker_user_email'])) {
		$truebooker_user_email = $_POST['truebooker_user_email'];
	}
	
/*$user_count_mail  = $wpdb->get_results($wpdb->prepare("SELECT distinct truebooker_user_email FROM {$table_truebooker_customers}"), ARRAY_A);
*/

$tsd = '';

$query = $wpdb->prepare(
	    "SELECT distinct truebooker_user_email FROM {$table_truebooker_customers}  where truebooker_user_email != %d",$tsd  
	    );

$user_count_mail = $wpdb->get_results($query, ARRAY_A);

	foreach( $user_count_mail as $row ){
		
		$email	= esc_html__($row['truebooker_user_email']);
		
	}
$user_count = count($user_count_mail);
		
if ($user_count == 0){
	echo "<h3>0</h3>";
}
else {
echo "<h3>".esc_html__($user_count)."</h3>";	
}?>

<p><?php esc_html_e('Total Customers', 'truebooker'); ?></p>
</div>
</div>

</div>
  <div class="col-lg-12 col-md-12 col-sm-12 tba-details-tbl">
  <h2 class="tba-page-heading"><?php esc_html_e('Pending Appointments', 'truebooker'); ?></h2>
  
  <?php 
  				
				global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result,$truebooker_appointment_status ;
				
				$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
				$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
				if (isset($_POST['truebooker_appointment_status'])) {
				$truebooker_appointment_status = $_POST['truebooker_appointment_status'];
				}
			


				$tsd = 'Pending';

$query = $wpdb->prepare(
	    "SELECT *  FROM {$table_truebooker_customers}  where truebooker_appointment_status = %s ORDER BY truebooker_user_id DESC",$tsd  
	    );

$result = $wpdb->get_results($query, ARRAY_A);
			 
	foreach( $result as $row ){
		
		$truebooker_appointment_status	= $row['truebooker_appointment_status'];
	}
				
  if(count($result) == 0) { ?> 
	  <h4><?php esc_html_e('No Record Found!', 'truebooker'); ?></h4> <?php  
  }
  else { ?>
	 <section class="tba-table-container">
		<div class="tba-table__header-wrapper tba-dashboard" id="tba_user_table">
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
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="phone" data-order="desc" >
							<div class="cell"><?php esc_html_e('Service', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="phone" data-order="desc" >
							<div class="cell"><?php esc_html_e('Appointment Date', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="phone" data-order="desc" >
							<div class="cell"><?php esc_html_e('Appointment Time', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="phone" data-order="desc" >
							<div class="cell"><?php esc_html_e('Status', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell deleteall" id="delete" data-order="desc" >
							<div class="cell">
							  <input type="submit" name="deleteall" id="deleteall" value="Delete" class="tba-button"/>
							</div>
						</th>
					</tr>
				</thead>
				<?php 
				global $service_id, $service_name, $tba_user_id, $tba_user_fname, $tba_user_fname, $tba_user_lname, $tba_user_mail, $tba_user_phcode, $tba_user_ph, $tba_user_dt, $tba_user_tym, $tba_user_meridiem, $tba_user_app_status;
				foreach ( $result as $row ){
					$service_id = $row['truebooker_user_service'];
				}
				
				
				foreach ( $result as $row ){
	              $tba_user_id = $row['truebooker_user_id'];
	              $tba_user_fname = $row['truebooker_user_firstname'];
	              $tba_user_lname = $row['truebooker_user_lastname'];
	              $tba_user_service = $row['truebooker_user_service'];
	              $tba_user_mail = $row['truebooker_user_email'];
	              $tba_user_phcode = $row['truebooker_user_phonecode'];
	              $tba_user_ph = $row['truebooker_user_phone'];
	              $tba_user_dt = $row['truebooker_user_dt'];
	              $tba_user_tym = $row['truebooker_user_time'];
	              $tba_user_meridiem = $row['truebooker_time_meridiem'];
	              $tba_user_app_status = $row['truebooker_appointment_status'];
				
				
				  $results = $wpdb->get_results("SELECT truebooker_service_name FROM {$wpdb->prefix}truebooker_service WHERE truebooker_service_id = '{$tba_user_service}'");
				if ($results) {
					// Display the results
					foreach ($results as $res) {
					  $service_name = json_encode( $res->truebooker_service_name);
					}
				}
			

				?>
				
				<tr>
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_attr($tba_user_id); ?>"></td>
				<td><?php echo esc_html__($tba_user_fname); ?> <?php echo esc_html__($tba_user_lname); ?></td>
				<td><?php echo esc_html__($tba_user_mail); ?></td>
				<td><?php echo esc_html__($tba_user_phcode); ?> <?php echo esc_html__($tba_user_ph); ?></td>
				<td><?php echo esc_html__($tba_user_service); ?></td>
				<td><?php echo esc_html__($tba_user_dt); ?></td>
				<td><?php echo esc_html__($tba_user_tym); ?> <?php echo esc_html__($tba_user_meridiem); ?></td>
				<td><input type="submit" name="truebooker_appointment_status" id="truebooker_appointment_status" value="<?php echo esc_html__($tba_user_app_status); ?>" onclick="return status_confirm();"/>
				</td>
				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button"/><i class="fa fa-sharp fa-light fa-trash" onclick="return delete_confirm();"></i></td>
				</tr>
				
			<?php }
  ?>
				
			</table>
		</form>
		</div>
	</section> 
  <?php }
  ?>
  </div>
</div>
</div>

</main>
 <?php 
function truebooker_appointment_remove_data() {
    
	global $wpdb, $table_truebooker_customers, $truebooker_user_id, $result;
	

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		
		if(isset($_POST["delete"])){
		
			$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
			
			if (isset($_POST['truebooker_user_id'])) {
				$truebooker_user_id = $_POST['truebooker_user_id'];
			}
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);
			
			$delete = $wpdb->query($wpdb->prepare("DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($idStr)"));

				if($delete){
					$s_message = "<div class='truebooker_success tba-popconfirm'><h5 class='tba_success'>Success</h5><span>User has been deleted successfully.</span></div><div class='tba-loading'></div>";
					

					echo wp_kses(
					    $s_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					        'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);


					?>
		<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload(); }, 1000);</script> <?php
				}else{
					$e_message = '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_html__( 'Error', 'truebooker' ) . '</h5><span>' . esc_html__( 'Getting some error.', 'truebooker' ) . '</div>';
					
					echo wp_kses(
					    $e_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					        'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
				}
			}else{
					$i_message = '<div class="truebooker_error tba-popconfirm"><span>' . esc_html__( 'Select at least 1 record to delete', 'truebooker' ) . '</span></div>';
					

					echo wp_kses(
					    $i_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					        'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
					
			}
	
		}
		if(isset($_POST["deleteall"])){
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);

			$delete = $wpdb->query($wpdb->prepare("DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($idStr)"));

				if($delete){
					$s_message = '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_html__( 'Success', 'truebooker' ) . '</h5><span>' . esc_html__( 'Users has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
				
					echo wp_kses(
					    $s_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					        'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
					
					?>
		<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload(); }, 1000);</script> <?php
				}else{
					$e_message = "<div class='truebooker_error tba-popconfirm'><h5 class='tba_error'>Error</h5><span>Getting some error.</span></div>";
					echo wp_kses(
					    $e_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					        'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
				}
			}else{
					$i_message = "<div class='truebooker_error tba-popconfirm'><span>Select at least 1 record to delete</span></div>";
					echo wp_kses(
					    $i_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					       		 'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
			}
	
		}
	}
	 
}

function truebooker_status_update_data() {
    
	global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result,$tba_user_email,$tba_user_firstname,$tba_user_lastname,$tba_user_date,$tba_user_time,$tba_time_meridiem ,$user_email,$idStr1;
	
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['truebooker_user_email'])) {
				$truebooker_user_email = $_POST['truebooker_user_email'];
			}

		if(isset($_POST["truebooker_appointment_status"])){
		
			$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
			
			if (isset($_POST['truebooker_user_id'])) {
				$truebooker_user_id = $_POST['truebooker_user_id'];
			}

			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);
			$data = array(
					'truebooker_appointment_status'=> 'Approved'
				);
			$where = array(
			'truebooker_user_id' => ''.$idStr.''
			);	
			
			
			$updated = $wpdb->update( $table_truebooker_customers, $data, $where );
			$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_customers} WHERE truebooker_user_id='{$idStr}'"), ARRAY_A);
			 foreach ( $result as $row ){
				 $tba_user_email = $row['truebooker_user_email'];
				 $tba_user_firstname = $row['truebooker_user_firstname'];
				 $tba_user_lastname = $row['truebooker_user_lastname'];
				 $tba_user_time = $row['truebooker_user_time'];
				 $tba_user_meridiem = $row['truebooker_time_meridiem'];
				 $tba_user_date = $row['truebooker_user_dt'];
			 }
				if($updated){
					
	$to      = $tba_user_email;
	$from      = get_option('admin_email');
    $subject = 'Truebooker Booking';
    $details = 'Hi '.esc_html__($tba_user_firstname).' '.esc_html__($tba_user_lastname).',
	
This message is to confirm your appointment at '.esc_html__($tba_user_time).' '.esc_html__($tba_user_meridiem).' on '.esc_html__($tba_user_date).'.

Thank you,';
  
    $headers = 'From: '.get_option('admin_email').'';

    wp_mail($to, $subject, $details, $headers);

   
		$s_message = "<div class='truebooker_success tba-popconfirm'><h5 class='tba_success'>Success</h5><span>User has been update successfully.</span></div><div class='tba-loading'></div>";
				
					echo wp_kses(
					    $s_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					       		 'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
					?>
			<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){location.reload(); }, 1000);</script> <?php
				}else{
					$e_message = "<div class='truebooker_error tba-popconfirm'><h5 class='tba_error'>Error</h5><span>Getting some error.</div>";
				
					echo wp_kses(
					    $e_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					       		 'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
				}
			}else{
				    $i_message = "<div class='truebooker_error tba-popconfirm'><span>Select at least 1 record to update</span></div>";
					

					echo wp_kses(
					    $i_message,
					    array(
					        'a'      => array(
					            'href'  => array(),
					            'title' => array(),
					        ),
					        'div'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'h5'     => array(
					        	'class'  => array(),
					        	'id'  => array(),
					        ),
					        'span'     => array(
					       		 'class'  => array(),
					        	'id'  => array(),
					        ),
					        'br'     => array(),
					        'em'     => array(),
					        'strong' => array(),
					    )
					);
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