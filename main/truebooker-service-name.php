<?php 

require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../../wp-config.php');
global $truebooker_service_id , $table_truebooker_services, $result , $service_prc, $connection, $sql, $conn, $wpdb, $tba_service_id, $service_name ;
if (isset($_POST['tba_service_id'])) {
    $tba_service_id = $_POST['tba_service_id'];
}

$table_truebooker_services = $wpdb->prefix . 'truebooker_service';

// Run the query

$truebooker_sql = $wpdb->prepare("SELECT truebooker_service_name FROM $table_truebooker_services WHERE truebooker_service_id =%d", array($tba_service_id));


$results = $wpdb->get_results($truebooker_sql);

if ($results) {
    // Display the results
    foreach ($results as $result) {
      echo json_encode( $result->truebooker_service_name);
    }
}
?>
