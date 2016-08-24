<?php
/**
* Plugin Name: Kento Ajax Contact Form
* Plugin URI: http://kentothemes.com
* Description: Ajax Based Conetact Form with Shortcode System to Display Anywhere.
* Version: 1.0
* Author: KentoThemes
* Author URI: http://kentothemes.com
*License: GPLv2 or later
*License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
 
define('KENTO_CONTACT_FORM_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

function kento_contact_form_scripts($hook) {
        /* Register our script. */
		wp_enqueue_style( 'KENTO_CONTACT_FORM_STYLE', KENTO_CONTACT_FORM_PLUGIN_PATH.'css/style.css' );		 
        wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'kento-contact-form', KENTO_CONTACT_FORM_PLUGIN_PATH.'js/kento-contact-form.js', array( 'jquery' ) );
		wp_localize_script( 'kento-contact-form', 'kento_contact_form_ajax', array( 'kento_contact_form_ajaxurl' => admin_url( 'admin-ajax.php')));
	
		
}
add_action('wp_enqueue_scripts', 'kento_contact_form_scripts'); 

add_shortcode('kento_contact_form', 'kento_contact_form');




	function kento_contact_form() {	?>
		<div id="kento-contact-form">
			<form name="myform" id="myform" method="POST">  
            	<!-- The Name form field -->
                <table align="center">
                	<tr>
                    	<td width="25%"> <label for="name" id="name_label">Name:</label></td>
                		<td><input type="text" name="kento_contact_form_name" id="kento-contact-form-name" placeholder="Your Name" value=""/><br>
                			<span class="kento-contact-form-name-valid"></span>
                   		</td>
                	</tr>
                 <!-- The Email form field -->
                 <tr>
                 	<td width="25%"><label for="email" id="email_label">Email:</label></td> 
                    <td><input type="text" name="kento_contact_form_email" id="kento-contact-form-email" placeholder="Your Email" value=""/><br> 
                    <span class="kento-contact-form-email-valid"></span> <span class="kento-contact-form-email-empty"></span></td>
             	</tr>
                                        
                <!-- The mgs form field -->
                <tr>
                	<td width="25%" align="right"><label for="email" id="mgs_label">Your Message:</label></td>
                    <td><textarea type="text" name="kento_contact_form_mgs" id="kento-contact-form-mgs" placeholder="Write your message"  value=""></textarea> <br><span class="kento-contact-form-mgs-valid"></span> </td>
                </tr>
                   
                <!-- The Submit button -->
                <tr>
                	<td class="submit" colspan="2"><div id="kento-contact-form-submit" name="submit"><div class="sending" ></div>SEND</div></td>
                </tr>
            </table> 
                                    </form>
                                    <!-- We will output the results from process.php here -->
                                    <div id="kento-contact-form-submit-success">
                                    
                                    </div>
                                </div>	<!-- end of class="kento-contact-form" -->


<?php 
 }
 
 function kento_contact_form_send(){
	$name = sanitize_text_field($_POST['name']);
	$email = sanitize_email($_POST['email']);
	$mgs = sanitize_text_field($_POST['mgs']);	
	$to = get_option('admin_email');

			if (mail($to, "Name:". $name, $mgs, "From:". $email )){
				
				print "<span style='color:green; font-weight: bold;'>Your message sent successfully.</span><span id='mail-sent-success' success='1'></span>" ;
			} else {
				print "<span style='color:red; font-weight: bold;'>Sorry! Please try again. </span>";	
			}
	
	
	die(); 
	
 }

add_action('wp_ajax_kento_contact_form_send', 'kento_contact_form_send');
add_action('wp_ajax_nopriv_kento_contact_form_send', 'kento_contact_form_send');?>