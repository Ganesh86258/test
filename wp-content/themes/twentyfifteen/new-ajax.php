<?php
/**
 * Template Name: new Ajax Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<script type="text/javascript" language="javascript">
alert("hi");
       
						        
						        	jQuery('#contact .input-submit').css('display','none');
						        	jQuery('#contact .submit-loading').css('display','block');
						            jQuery.post({
						            	type: "POST",
								       url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                            //url:'http://localhost/index.php/wp-admin/admin-ajax.php',
						                success: function(data) {
						                   	jQuery('#contact :input').attr('disabled', 'disabled');
						                    jQuery('#contact').fadeTo( "slow", 0, function() {
						                    	jQuery('#contact').css('display','none');
						                        jQuery(this).find(':input').attr('disabled', 'disabled');
						                        jQuery(this).find('label').css('cursor','default');
						                        jQuery('#success').fadeIn();
						                    });
						                },
						                error: function(data) {
						                    jQuery('#contact').fadeTo( "slow", 0, function() {
						                        jQuery('#error').fadeIn();
						                    });
						                }
						           
						        });
					 
			 
      </script>
		
<?php $categories = get_categories( $args );
//echo"<pre>";
//print_r($categories);
?>
<form name="contact" id="contact" method="post" action="">
<table>
<tr>
<td>Name :</td>
<td><input type="text"name="ename" id="ename"></td>
</tr>
<tr>
<td>email :</td>
<td><input type="text"name="email" id="email"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit"name="submit" id="submit"></td>
</tr>
</table>
<input type="hidden" name="action" value="wpjobContactForm" />
<?php wp_nonce_field( 'scf_html', 'scf_nonce' ); ?>
</form>
<div style="padding-top:100px;" id="show"></div>
