<?php
/**
* Plugin Name: TrueBooker - Appointment Booking and Scheduler Plugin
* Plugin URI:https://wordpress.org/plugins/truebooker-appointment-booking
* Description: TrueBooker - Appointment Booking plugin for online book anything, anytime, anywhere. A perfect choice for medical centers, beauty salons, hair shops, car services.
 * Version: 1.0.4
 * Author: ThemetechMount
 * Author URI:https://themetechmount.com/
 * Text Domain: truebooker
 * Domain Path: /languages
  * Requires at least: 6.6.1
 * Requires PHP: 7.4
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/


define( 'TRUEBOOKER_VERSION', '1.0.4' );
define( 'TRUEBOOKER_DIR', trailingslashit( dirname( __FILE__ ) ) );
define( 'TRUEBOOKER_URL', plugins_url( '', __FILE__ ) );
define( 'TRUEBOOKER_PATH', plugin_dir_path( __FILE__ ) );
define( 'TRUEBOOKER_HOME_URL', home_url() );
define( 'TRUEBOOKER_MENU_URL', admin_url() . 'admin.php?page=truebooker' );
define( 'TRUEBOOKER_MAIN_FILE', plugin_basename(__FILE__) );
define( 'TRUEBOOKER_PAYPAL_CURRENCY', 'USD'); 

global $truebooker_ajaxurl,$userinsertobj;
$truebooker_ajaxurl = admin_url('admin-ajax.php');

if( file_exists(TRUEBOOKER_DIR . '/main/truebooker-main.php') ){
    require_once TRUEBOOKER_DIR . '/main/truebooker-main.php';
}

register_activation_hook(__FILE__, 'truebooker_install' );
register_uninstall_hook(__FILE__, 'truebooker_uninstall' );

if( !function_exists('truebooker_scripts_styles') ){
function truebooker_scripts_styles() {
	wp_enqueue_script( 'truebooker-custom', TRUEBOOKER_URL . '/assets/js/truebooker_custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'truebooker-bootstrap', TRUEBOOKER_URL . '/assets/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_style ( 'truebooker-css', TRUEBOOKER_URL . '/assets/css/truebooker_css.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style ( 'truebooker-variables', TRUEBOOKER_URL . '/assets/css/truebooker_variables.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style ( 'animate', TRUEBOOKER_URL . '/assets/css/animate.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style ( 'truebooker-bootstrap', TRUEBOOKER_URL . '/assets/css/bootstrap.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_script( 'jquery-ui', TRUEBOOKER_URL . '/assets/js/jquery-ui.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-timepicker', TRUEBOOKER_URL . '/assets/js/jquery.timepicker.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'intlTelInput', TRUEBOOKER_URL . '/assets/js/intlTelInput.js', array( 'jquery' ) );
	wp_enqueue_script( 'intlTelInput-jquery-min', TRUEBOOKER_URL . '/assets/js/intlTelInput-jquery.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'utils', TRUEBOOKER_URL . '/assets/js/utils.js', array( 'jquery' ) );
	wp_enqueue_style ( 'intlTelInput', TRUEBOOKER_URL . '/assets/css/intlTelInput.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style ( 'add_google_fonts ', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap', false );
	// iconset-fontawesome
	wp_enqueue_style( 'font-awesome', TRUEBOOKER_URL .'/assets/font-awesome/css/font-awesome.min.css' );
}
}
add_action( 'admin_enqueue_scripts', 'truebooker_scripts_styles' );

if( !function_exists('truebooker_styles') ){
function truebooker_styles() {
	wp_enqueue_style( 'truebooker-front', TRUEBOOKER_URL . '/assets/css/truebooker_front.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style( 'truebooker-variables', TRUEBOOKER_URL . '/assets/css/truebooker_variables.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_script( 'jquery-front', TRUEBOOKER_URL . '/assets/js/truebooker_front.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-ui', TRUEBOOKER_URL . '/assets/js/jquery-ui.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-timepicker', TRUEBOOKER_URL . '/assets/js/jquery.timepicker.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'intlTelInput', TRUEBOOKER_URL . '/assets/js/intlTelInput.js', array( 'jquery' ) );
	wp_enqueue_script( 'intlTelInput-jquery-min', TRUEBOOKER_URL . '/assets/js/intlTelInput-jquery.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'utils', TRUEBOOKER_URL . '/assets/js/utils.js', array( 'jquery' ) );
	wp_enqueue_style( 'intlTelInput', TRUEBOOKER_URL . '/assets/css/intlTelInput.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style( 'truebooker-bootstrap', TRUEBOOKER_URL . '/assets/css/bootstrap.css', array(), TRUEBOOKER_VERSION );
	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap', false );
	// fontawesome
	wp_enqueue_style( 'font-awesome', TRUEBOOKER_URL .'/assets/font-awesome/css/font-awesome.min.css' );


     wp_localize_script( 'jquery-front', 'truebookerPluginData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'truebooker_appointment_booking_nonce_action' ),
    ) );
}
}
add_action('wp_enqueue_scripts', 'truebooker_styles');

 if( file_exists(TRUEBOOKER_DIR . '/main/views/bookingform-frontend.php') ){
 	require_once TRUEBOOKER_DIR . '/main/views/bookingform-frontend.php';
 }

function truebooker_plugin_body_class($truebooker_classes) {
    $truebooker_classes[] = 'truebooker';
    return $truebooker_classes;
}

if( file_exists(TRUEBOOKER_DIR . '/helper/userin.php') ){
	require_once TRUEBOOKER_DIR . '/helper/userin.php';
	$userinsertobj = new userin();	
}

add_filter('body_class', 'truebooker_plugin_body_class');

?>