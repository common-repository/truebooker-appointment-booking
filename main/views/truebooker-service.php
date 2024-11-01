<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../../wp-config.php');

global $wpdb, $table_truebooker_services, $truebooker_service_id, $truebooker_service_name, $truebooker_service_category, $truebooker_service_duration_val, $truebooker_service_duration_unit, $truebooker_service_price, $truebooker_service_description, $sname , $category , $dvalue , $price;
	
$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
	
$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_services} ORDER BY truebooker_service_id DESC"), ARRAY_A);
?>
  
  <h2 class="tba-page-heading"><?php esc_html_e('Manage Services', 'truebooker'); ?></h2>
  <?php
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
							<div class="cell"><?php esc_html_e('Service Id', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="name" data-order="desc" >
							<div class="cell"><?php esc_html_e('Service Name', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell"  id="category" data-order="desc">
							<div class="cell"><?php esc_html_e('Category', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="duration" data-order="desc" >
							<div class="cell"><?php esc_html_e('Duration', 'truebooker'); ?>
							  <span class="caret-wrapper"><i class="sort-caret ascending"></i><i class="sort-caret descending"></i></span>
							</div>
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="price" data-order="desc" >
							<div class="cell"><?php esc_html_e('Price', 'truebooker'); ?>
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
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_html__($row['truebooker_service_id']); ?>"></td>
				<td><?php echo esc_html__($row['truebooker_service_id']); ?></td>
				<td><?php echo esc_html__($row['truebooker_service_name']); ?></td>
				<td><?php echo esc_html__($row['truebooker_service_category']); ?></td>
				<td><?php echo esc_html__($row['truebooker_service_duration_val']); ?> <?php echo esc_html__($row['truebooker_service_duration_unit']); ?></td>
				<td><?php echo '$'.esc_html__($row['truebooker_service_price']); ?></td>

				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button" onclick="return delete_confirm();"/><i class="fa fa-sharp fa-light fa-trash"></i></td>
				</tr>
				
				<?php } ?>
				
			</table>
		</form>
		</div>
	</section>
	 <?php }?>