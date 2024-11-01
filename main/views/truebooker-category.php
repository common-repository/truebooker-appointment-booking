<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../../wp-config.php');

?>

  <h2 class="tba-page-heading"><?php esc_html_e('Manage Categories', 'truebooker'); ?></h2>
  <?php 
  
    global $wpdb, $table_truebooker_categories, $truebooker_category_id,$result ;

	$table_truebooker_categories = $wpdb->prefix . 'truebooker_categories';
	
	if (isset($_POST['truebooker_category_id'])) {
		$truebooker_category_id = $_POST['truebooker_category_id'];
	}
	$result  = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_truebooker_categories} ORDER BY truebooker_category_id DESC"), ARRAY_A);				
	
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
				<td><input type="checkbox" aria-hidden="false" class="tba-checkbox__original checkbox" name="checked_id[]" value="<?php echo esc_html__($row['truebooker_category_id']); ?>"></td>
				<td class="tba_data"><?php echo esc_html__($row['truebooker_category_name']); ?></td>

				<td><input type="submit" name="delete" id="delete" value="Delete" class="tba-button" onSubmit="return delete_confirm();"/><i class="fa fa-sharp fa-light fa-trash"></i></td>
				</tr>
				
				<?php } ?>
				</tbody>
			</table>
			<form>
		</div>
	</section>
 <?php }
?>
<?php 
function truebooker_service_cat_remove_data() {
    
    global $wpdb, $table_truebooker_categories, $truebooker_category_id;
	
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
					$s_message = "<div class='truebooker_success tba-popconfirm'><h5 class='tba_success'>Success</h5><span>Category has been deleted successfully.</span></div><div class='tba-loading'></div>";
					
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
		<script type="text/javascript">	jQuery(window).load(function() { jQuery(".tba-loading").fadeOut("slow");});	setTimeout(function(){ location.reload();  }, 1000);</script> 
		<?php
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

			$checkedid = $_POST['checked_id'];

				
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
					<script type="text/javascript"><!--
	jQuery(window).load(function() {		
	  jQuery(".tba-loading").fadeOut("slow");
	});	
	setTimeout(function(){// wait for 1 secs(2)
           location.reload(); // then reload the page.(3)
      }, 1000);
--></script> <?php
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