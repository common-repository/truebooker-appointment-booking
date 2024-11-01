<?php 

require_once(ABSPATH . 'wp-config.php');

function truebooker_service_cat_insert_data(){
	global $wpdb, $table_truebooker_categories, $truebooker_category_id, $truebooker_category_name;
?>
<script>
jQuery(document).ready(function() {
	var ajaxurl = '<?php echo esc_attr(TRUEBOOKER_URL."/main/truebooker-category-insert.php"); ?>';
	jQuery('#submit').on('click', function(e){
		e.preventDefault();
		var data = jQuery("#submit").serialize();
		var truebooker_category_name = jQuery('#truebooker_category_name').val();
		var truebooker_meta_box_noncename = jQuery('#truebooker_meta_box_noncename').val();

		jQuery('.tba-loderimg').removeClass('hide');

		jQuery('#category_form #submit').prop('disabled', true);
		
		jQuery.ajax({
		method: 'POST',
		dataType: 'json',
		url: ajaxurl, 
		data: { 
			truebooker_category_name:truebooker_category_name,
			truebooker_meta_box_noncename:truebooker_meta_box_noncename,
		}, 
		success: function(response) {
		jQuery('.tba-loderimg').addClass('hide');

		jQuery('#category_form #submit').prop('disabled', false);	
			if(response.success){				
				jQuery('#result').html(response.success).fadeIn('slow');
				jQuery('#result').delay(8000).fadeOut('slow');
				jQuery('#category_form')[0].reset();
				jQuery('#summary').html(response.success.summary).fadeIn('fast');
			}
			else{
				jQuery('#result').html(response.php_error).fadeIn('slow');
				jQuery('#result').delay(8000).fadeOut('slow');
				jQuery('.name-error').text(response.error.truebooker_category_name);
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
<form method="post" name="categoryForm" id="category_form" class="truebooker-form"> 
<div id="result" style="display:none"></div>
<div class="row">
<div class="tba-form-field col-lg-3 col-md-6 col-sm-12"> 
<label for="catname"><?php echo esc_html__( 'Category Name', 'truebooker' )?><strong class="error">*</strong></label> 
<input type="text" name="truebooker_category_name" id="truebooker_category_name" class="form_data" value="">
<span class="error name-error"></span>
</div> 
 <div class="tba-form-field col-lg-3 col-md-6 col-sm-12">
<input type="submit" name="csubmit" id="submit" value="Register" class="tba-button button-top-sp"/> 
<img src="<?php echo esc_html(TRUEBOOKER_URL).'/assets/images/loader_1.gif';?>" class="tba-loderimg hide" >
</div>
</div>
<?php
	wp_nonce_field( 'truebooker_meta_box_nonce', 'truebooker_meta_box_noncename' );
?>
</form>

<div class="tba-details-tbl-wraper">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 tba-details-tbl" id="mytable">
  <h2 class="tba-page-heading"><?php esc_html_e('Manage Categories', 'truebooker'); ?></h2>
  <?php 
  
    global $wpdb, $table_truebooker_categories, $truebooker_category_id,$result ;

	$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
	
	if (isset($_POST['truebooker_category_id'])) {
		$truebooker_category_id = $_POST['truebooker_category_id'];
	}
			


	$tsd = '';

	$query = $wpdb->prepare(
	    "SELECT * FROM {$table_truebooker_categories}  where truebooker_category_id != %d ORDER BY truebooker_category_id DESC",$tsd  
	    );
$result = $wpdb->get_results($query, ARRAY_A);

	
  if(count($result) == 0) { ?> 
	  <h4><?php esc_html_e('No Record Found!', 'truebooker'); ?></h4> <?php  
  }
  else {?>
	<section class="tba-table-container">
		<div class="tba-table__header-wrapper" id="table-container">
		<form method="post" name="bulk_action_form">
		<input id='search-box' placeholder='Search here..' class="tba_search">
		<table>
				<thead class="has-gutter">
					<tr>
						<th colspan="1" rowspan="1" class="tba-table_1_column_1 tba-table-column is-leaf tba-table__cell">
							<input type="checkbox" aria-hidden="false" class="tba-checkbox__original" name="checked" value="" id="select_all">
						</th>
						<th colspan="1" rowspan="1" class="tba-table_1_column_2 is-leaf is-sortable tba-table__cell" id="name" data-order="desc" >
							<div class="cell"><?php esc_html_e('Category Name', 'truebooker'); ?>
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
				<tbody class="main-details">
				<?php 

				foreach ( $result as $row ){
					$cat_id = $row['truebooker_category_id'];
				?>
				
				<tr>
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_html($row['truebooker_category_id']); ?>"></td>
				<td class="tba_data"><?php echo esc_html($row['truebooker_category_name']); ?></td>

				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button" onSubmit="return delete_confirm();"/><i class="fa fa-sharp fa-light fa-trash"></i></td>
				</tr>
				
				<?php } ?>
				</tbody>
			</table>
			<form>
		</div>
	</section>
 <?php }?>
  </div>
</div>
</div>

</main>

<?php 

function truebooker_service_cat_remove_data() {
    
    global $wpdb, $table_truebooker_categories, $truebooker_category_id, $checkedid;
	
	$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
	if (isset($_POST['truebooker_category_id'])) {
		$truebooker_category_id = $_POST['truebooker_category_id'];
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if(isset($_POST["delete"])){
			
			if(!empty($_POST['checked_id'])){

			$idStr = implode(",", $_POST['checked_id']);

			$delete = $wpdb->delete( $table_truebooker_categories, array( 'truebooker_category_id' => $idStr ) );

				if($delete){
					$s_message = '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_html__( 'Success ', 'truebooker' ) . '</h5><span>' . esc_html__( ' Category has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';

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
					<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload();  
					}, 1000);</script> 
	<?php
				}else{
					$e_message = '<div class="truebooker_error tba-popconfirm"><h5 class="tba_error">' . esc_html__( 'Error', 'truebooker' ) . '</h5><span>' . esc_html__( ' Getting some error.', 'truebooker' ) . '</div>';
					
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
			    "DELETE FROM {$table_truebooker_categories} WHERE truebooker_category_id IN ($placeholders)",
			    $checked_id
			);

			if($wpdb->query($query)){
		
				$s_message = '<div class="truebooker_success tba-popconfirm"><h5 class="tba_success">' . esc_html__( 'Success', 'truebooker' ) . '</h5><span>' . esc_html__( 'Categories has been deleted successfully.', 'truebooker' ) . '</span></div><div class="tba-loading"></div>';
					
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
			<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload();  }, 1000);</script> <?php
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
	}
	 
} ?>

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
    url: '<?php echo esc_html__(TRUEBOOKER_URL); ?>/main/views/truebooker-category.php/#mytable', 
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