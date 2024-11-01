<?php 

require_once(ABSPATH . 'wp-config.php');

function truebooker_service_insert_data(){
	?>
	<script>

jQuery(document).ready(function() {
var ajaxurl = '<?php echo esc_html__(TRUEBOOKER_URL)."/main/truebooker-service-insert.php"; ?>';
jQuery('#submit').on('click', function(e){
    e.preventDefault();
	var data = jQuery("#submit").serialize();
  var truebooker_service_name = jQuery('#truebooker_service_name').val();
  var truebooker_service_category = jQuery('#truebooker_service_category').val();
	var truebooker_service_duration_val = jQuery('#truebooker_service_duration_val').val();
	var truebooker_service_duration_unit = jQuery('#truebooker_service_duration_unit').val();
	var truebooker_service_price = jQuery('#truebooker_service_price').val();
	var truebooker_service_description = jQuery('#truebooker_service_description').val();
	var truebooker_meta_box_noncename = jQuery('#truebooker_meta_box_noncename').val();
	jQuery('.tba-loderimg').removeClass('hide');

		jQuery('#category_form #submit').prop('disabled', true);
	
    jQuery.ajax({
    method: 'POST',
    dataType: 'json',
    url: ajaxurl, 
    data: { 
		truebooker_service_name:truebooker_service_name,
		truebooker_service_category:truebooker_service_category,
		truebooker_service_duration_val:truebooker_service_duration_val,
		truebooker_service_duration_unit:truebooker_service_duration_unit,
		truebooker_service_price:truebooker_service_price,
		truebooker_service_description:truebooker_service_description,
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
			jQuery('.sname-error').text(response.error.truebooker_service_name);
			jQuery('.cat-error').text(response.error.truebooker_service_category);
			jQuery('.duration-error').text(response.error.truebooker_service_duration_val);
			jQuery('.price-error').text(response.error.truebooker_service_price);
			jQuery('.error').delay(5000).fadeOut('slow');
		}

    }
  });

});
});
</script>
<?php
	
}

?>	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
<div class="tba-sec-top"><h2 class="tba-page-heading"><?php echo esc_html__( 'Add New', 'truebooker' )?></h2></div>
<form method="post" name="contactForm" id="sample_form" class="truebooker-form"> 
<div id="result" style="display:none"></div>
<div class="row">
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="sname"><?php echo esc_html__( 'Service Name', 'truebooker' )?><strong class="error">*</strong></label> 
<input type="text" name="truebooker_service_name" id="truebooker_service_name" class="form_data" value="">
<span class="error sname-error"></span>
</div> 

	<?php
	
	global $wpdb, $table_truebooker_categories, $cat, $truebooker_cat_desc;

$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
	


$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT truebooker_category_name FROM {$table_truebooker_categories}  where truebooker_category_name != %s",$tsd  
	    );
$cat = $wpdb->get_results($query, ARRAY_A);

foreach ( $cat as $cats ){
	$category = $cats['truebooker_category_name'];
}
	if(!empty($category)) { ?>
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="category"><?php echo esc_html__( 'Category', 'truebooker' )?></label> 
  <select name="truebooker_service_category"  id="truebooker_service_category">
   <option value="" disabled selected><?php echo esc_html__( 'Select Category', 'truebooker' )?></option>
<?php

foreach ( $cat as $cats ){
	?>
    <option value="<?php echo esc_html__($cats['truebooker_category_name']); ?>"><?php echo esc_html__($cats['truebooker_category_name']); ?></option>
<?php } ?>
  </select>
  <span class="error cat-error"></span>
</div> 
<?php } 
else {
?>
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="category"><?php echo esc_html__( 'Category', 'truebooker' )?></label> 
  <select name="truebooker_service_category"  id="truebooker_service_category">
   <option value="" disabled selected><?php echo esc_html__( 'Please add Category', 'truebooker' )?></option>
  </select>
</div> 
<?php
}
?>

<div class="tba-form-field col-lg-3 col-md-6 col-sm-12">
<label for="duration"><?php echo esc_html__( 'Duration', 'truebooker' )?><strong class="error">*</strong></label> 
  <div class="tba-service-duration">
  <input type="text" name="truebooker_service_duration_val" id="truebooker_service_duration_val" class="form_data" value=""> 
  <select name="truebooker_service_duration_unit" id="truebooker_service_duration_unit">
    <option value="mins"><?php echo esc_html__( 'Mins', 'truebooker' )?></option>
    <option value="hrs"><?php echo esc_html__( 'Hrs', 'truebooker' )?></option>
  </select>
  </div>
<span class="error duration-error"></span>
</div> 

<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="price"><?php echo esc_html__( 'Price($)', 'truebooker' )?><strong class="error">*</strong></label> 
<input type="text" name="truebooker_service_price" id="truebooker_service_price" class="form_data" value=""> 
<span class="error price-error"></span>
</div> 

<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="note"><?php echo esc_html__( 'Descriprion', 'truebooker' )?></label> 
<textarea name="truebooker_service_description" id="truebooker_service_description" rows="6"></textarea> 
</div>

<div class="tba-form-field col-lg-3 col-md-6 col-sm-12">
<input type="submit" name="ssubmit" id="submit" value="Register" class="tba-button button-top-sp"/> 
<img src="<?php echo esc_html__(TRUEBOOKER_URL).'/assets/images/loader_1.gif';?>" class="tba-loderimg hide" >
</div>
<?php
	wp_nonce_field( 'truebooker_meta_box_nonce', 'truebooker_meta_box_noncename' );
?>
</div>
</form>

<div class="tba-details-tbl-wraper">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 tba-details-tbl" id="mytable">
  <h2 class="tba-page-heading"><?php esc_html_e('Manage Services', 'truebooker'); ?></h2>
  <?php
  				
				global $wpdb, $table_truebooker_services, $truebooker_service_id,$result ;
				
				$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
				
				if (isset($_POST['truebooker_service_id'])) {
					$truebooker_service_id = $_POST['truebooker_service_id'];
				}
				


				$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_services}  where truebooker_service_id != %d ORDER BY truebooker_service_id DESC",$tsd  
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
function truebooker_service_remove_data() {
    
    global $wpdb, $table_truebooker_services, $truebooker_service_id,$checkedid;
	
	$table_truebooker_services = $wpdb->prefix . 'truebooker_service';
	if (isset($_POST['truebooker_service_id'])) {
		$truebooker_service_id = $_POST['truebooker_service_id'];
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if(isset($_POST["delete"])){
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);

			$delete = $wpdb->delete( $table_truebooker_services, array( 'truebooker_service_id' => $idStr ) );
					
					if($delete){
					$s_message = '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_html__( 'Success', 'truebooker' ) . '</h5><span>' . esc_html__( 'Service has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
				
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
					<script type="text/javascript">	jQuery(window).load(function() {jQuery(".tba-loading").fadeOut("slow");	});	setTimeout(function(){ location.reload(); }, 1000);</script> <?php
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
			
			
			$checked_id = $_POST['checked_id'];
			
			$placeholders = implode(',', array_fill(0, count($checked_id), '%d'));

			$query = $wpdb->prepare(
			    "DELETE FROM {$table_truebooker_services} WHERE truebooker_service_id IN ($placeholders)",
			    $checked_id
			);

			if($wpdb->query($query)){				
					$s_message = '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_html__( 'Success', 'truebooker' ) . '</h5><span>' . esc_html__( 'Services has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
					
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
					$i_message = '<div class="truebooker_error tba-popconfirm"><span>'.esc_html__( 'Select at least 1 record to delete', 'truebooker' ).'</span></div>';
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
<script>
function refreshSection() {
	jQuery.ajax({
    url: '<?php echo esc_html__(TRUEBOOKER_URL); ?>/main/views/truebooker-service.php/#mytable', 
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