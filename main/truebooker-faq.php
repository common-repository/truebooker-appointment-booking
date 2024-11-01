<?php 
 if ( ! defined( 'ABSPATH' ) ) exit;
require_once(ABSPATH . 'wp-config.php');

?>
	
<main class="tba-main tba-main-listing-container tba-default-box" id="all-page-main-container">
	<div class="tba-details-tbl-wraper truebooker-settingform">
		<h2 class="tba-page-heading"><?php echo esc_html__( 'Frequently Asked Questions', 'truebooker' )?></h2>
		<div class="row">
			<div class="tba-form-field col-lg-12 col-md-12 col-sm-12 tba_faq"> 
				<h3><?php echo esc_html__( 'Free version & Pro version', 'truebooker' )?></h3>
				<p><?php echo esc_html__('The Truebooker is a free WordPress plugin available for download on wordpress.org. The free version of the plugin includes all the major features and options. Find more information on the', 'truebooker' )?><?php echo esc_html__( 'plugin page.', 'truebooker' )?></p>
				<p><?php echo esc_html__('The Pro version extend the possibilities of the plugin, Allows setting up additional payment options such as Stripe and PayPal.', 'truebooker' )?></p>
				<p><b><?php echo esc_html__( 'Note:', 'truebooker' )?></b> <code>[booking_form]</code> <?php echo esc_html__( '– This shortcode will display the basic booking form for free plugin.', 'truebooker' )?> <p><code>[booking_form style="default"]</code> <?php echo esc_html__( '– This shortcode will display the basic booking form default style for premium plugin and', 'truebooker' )?> <code>[booking_form style="style1"]</code> <?php echo esc_html__( '– This shortcode will display the basic booking form style1 for premium plugin', 'truebooker' )?> </p></p>
				<ol>
					<li>
						<h4><?php echo esc_html__( '1. How easy is it to set up?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'It is ridiculously easy to set up the Truebooker plugin.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Go to your WordPress’ admin page, open Truebooker -> Categories , Truebooker -> Services, and add categories and services.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Add [booking_form] shortcode to one of your posts or pages for free plugin.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Add [booking_form style="default"] shortcode to one of your posts or pages for default style of premium plugin.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Add [booking_form style="style1"] shortcode to one of your posts or pages for style1 of premium plugin.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Save it and Now customers can book appointments from your site’s front-end using Truebooker!', 'truebooker' )?></p>
					</li>

					<li>
						<h4><?php echo esc_html__( '2. Where can I publish a appointment booking form?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'Here are the ways to add a shortcode [booking_form] for booking form.', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- In the WordPress page', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- In the WordPress post', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- In the WordPress custom post', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- In the WordPress custom post', 'truebooker' )?></p>
					</li>

					<li>
						<h4><?php echo esc_html__( '3. Is it possible to pay online?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'Absolutely! Payment with PayPal and Stripe is available along with On-site payment.(Pro Version Only)', 'truebooker' )?></p>
					</li>

					<li>
						<h4><?php echo esc_html__( '4. Which page builders are supported?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'truebooker has dedicated blocks for following Page Builders', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Classic Editor of WordPress', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Elementor Website Builder', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- WPBakery Page Builder', 'truebooker' )?></p>
						<p><?php echo esc_html__( '- Gutenberg page builder of WordPress', 'truebooker' )?></p>
					</li>

					<li>
						<h4><?php echo esc_html__( '5. How to upgrade to Truebooker Pro?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'You can purchase Premium version of Truebooker via our', 'truebooker' )?> <a href="https://themetechmount.com/truebooker"><?php echo esc_html__( 'official website', 'truebooker' )?></a> <?php echo esc_html__( 'or you can also upgrade to premium from free version.', 'truebooker' )?></p>
					</li>
					
					<li>
						<h4><?php echo esc_html__( '6. Can the notifications be customized?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'Yes! you can set the messages you want to show at the frontend booking. You can set error/success and other common messages.', 'truebooker' )?></p>
					</li>
					
					<li>
						<h4><?php echo esc_html__( '7. Do I need to have coding skills to use Truebooker Plugin?', 'truebooker' )?></h4>
						<p><?php echo esc_html__( 'There is no need to learn any coding skills for operating Truebooker Plugin.', 'truebooker' )?></p>
					</li>
				</ol>  
			</div>
		</div>
	</div>
</main>
