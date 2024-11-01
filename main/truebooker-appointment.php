	<script>setTimeout(function tba_user_insert_data() {
      jQuery( ".tba-popconfirm" ).hide();
    }, 4000);
</script>
<?php 
require_once(ABSPATH . 'wp-config.php');

$nameErr = $lnameErr = $emailErr = $phone_err = $date_err = "";    

global $wpdb, $table_truebooker_customers, $truebooker_user_id, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $name, $lname , $email , $phone , $note , $date;
?>	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
<div class="tba-details-tbl-wraper">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 tba-details-tbl">
  <h2 class="tba-page-heading"><?php esc_html_e('Appointments', 'truebooker'); ?></h2>
  
  <?php 
  				
				global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result ;
				
				$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
				$table_truebooker_services = $wpdb->prefix . 'truebooker_service';

				$orderby ='truebooker_user_id';
				$order = 'DESC';

				
				$orderby_sql       = sanitize_sql_orderby( "{$orderby} {$order}" );

				
				/*$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_customers} ORDER BY $orderby_sql"), ARRAY_A);*/

					$tsd = '0';

	$query = $wpdb->prepare(
		    "SELECT *  FROM {$table_truebooker_customers}  where truebooker_user_id  != %d ORDER BY $orderby_sql ",$tsd  
		    );

$result = $wpdb->get_results($query, ARRAY_A);

				
  if(count($result) == 0) { ?> 
	  <h4><?php esc_html_e('No Record Found!', 'truebooker'); ?></h4> <?php  
  }
  else {?>
  
	<section class="tba-table-container">
		<div class="tba-table__header-wrapper tba-dashboard" id="tba_user_table">
		  <form method="post" name="bulk_action_form" onSubmit="return delete_confirm();">
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
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell deleteall" id="delete" data-order="desc" >
							<div class="cell">
							  <input type="submit" name="deleteall" id="deleteall" value="Delete" class="tba-button"  onclick="return delete_confirm();"/>
							</div>
						</th>
					</tr>
				</thead>
				<?php 
				global $service_name;
				foreach ( $result as $row ){
					$tba_user_service = $row['truebooker_user_service'];
					$results = $wpdb->get_results("SELECT truebooker_service_name FROM {$wpdb->prefix}truebooker_service WHERE truebooker_service_id = '{$tba_user_service}'");
				if ($results) {
					// Display the results
					foreach ($results as $res) {
					  $service_name = json_encode( $res->truebooker_service_name);
					}
				}
				?>
				
				<tr>
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_html($row['truebooker_user_id']); ?>"></td>
				<td><?php echo esc_html($row['truebooker_user_firstname']); ?> <?php echo esc_html($row['truebooker_user_lastname']); ?></td>
				<td><?php echo esc_html($row['truebooker_user_email']); ?></td>
				<td><?php echo esc_html($row['truebooker_user_phonecode']); ?> <?php echo esc_html($row['truebooker_user_phone']); ?></td>
				<td><?php echo esc_html($row['truebooker_user_service']); ?></td>
				<td><?php echo esc_html($row['truebooker_user_dt']); ?></td>
				<td><?php echo esc_html($row['truebooker_user_time']); ?> <?php echo esc_html($row['truebooker_time_meridiem']); ?></td>
				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button"  onclick="return delete_confirm();"/><i class="fa fa-sharp fa-light fa-trash"></i></td>
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
function truebooker_appointment_remove_data() {
    
	global $wpdb, $table_truebooker_customers, $truebooker_user_id,$result,$checked_id,$checkedid ;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST["delete"])){
			$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
			if (isset($_POST['truebooker_user_id'])) {
				$truebooker_user_id = $_POST['truebooker_user_id'];
			}
			
			if(!empty($_POST['checked_id'])){
			
			$checked_id = $_POST['checked_id'];
			
			$placeholders = implode(',', array_fill(0, count($checked_id), '%d'));

			// Construct the query using $wpdb->prepare
			$query = $wpdb->prepare(
			    "DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($placeholders)",
			    $checked_id
			);

			if($wpdb->query($query)){
					echo '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_attr( 'Success', 'truebooker' ) . '</h5><span>' . esc_attr( 'User has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
					?>
			<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload(); }, 1000);</script>
				<?php
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_attr( 'Error', 'truebooker' ) . '</h5><span>' . esc_attr( 'Getting some error.', 'truebooker' ) . '</div>';
				}
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><span>' . esc_attr( 'Select at least 1 record to delete', 'truebooker' ) . '</span></div>';
				}
	
		}
		if(isset($_POST["deleteall"])){

			
			if(!empty($_POST['checked_id'])){
				
			$checkedid = $_POST['checked_id'];
			
			$placeholders = implode(',', array_fill(0, count($checked_id), '%d'));

			$query = $wpdb->prepare(
			    "DELETE FROM {$table_truebooker_customers} WHERE truebooker_user_id IN ($placeholders)",
			    $checked_id
			);

			if($wpdb->query($query)){
					echo '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_attr( 'Success', 'truebooker' ) . '</h5><span>' . esc_attr( 'User has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
			
					?>
		<script type="text/javascript">	jQuery(window).load(function() {jQuery(".tba-loading").fadeOut("slow");	});	setTimeout(function(){  location.reload(); }, 1000);</script> 
			<?php
				}else{
					echo '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_attr( 'Getting some error.', 'truebooker' ) . '</h5><span>' . esc_attr( 'Getting some error.', 'truebooker' ) . '</span></div>';
					
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