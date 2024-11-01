<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../../wp-config.php');

global $wpdb, $table_truebooker_customers, $truebooker_user_id, $truebooker_user_firstname, $truebooker_user_lastname, $truebooker_user_email, $truebooker_user_phone, $truebooker_user_note, $truebooker_user_dt, $truebooker_user_time, $truebooker_time_meridiem, $result;

$table_truebooker_customers = $wpdb->prefix . 'truebooker_user';
	
$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_customers} ORDER BY truebooker_user_id DESC"), ARRAY_A);
?>
  
<h2 class="tba-page-heading"><?php esc_html_e('Manage Customers', 'truebooker'); ?></h2>
<?php 

  if(count($result) == 0) { ?> 
	  <h4><?php esc_html_e('No Record Found!', 'truebooker'); ?></h4>   
<?php }
  else { ?>
  
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
				foreach ( $result as $row ) {
				?>
				
				<tr>
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_attr($row['truebooker_user_id']); ?>"></td>
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
	 <?php } ?>