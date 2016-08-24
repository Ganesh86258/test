<?php
/**
 * Template Name: Ajax Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<script type="text/javascript" language="javascript">
         $(document).ready(function() {
			
            $("#cat").click(function(event){
				
               $.post( 
                  "ajax-result.php",
                  { name: "Zara" },
                  function(data) {
                     $('#show').html(data);
                  }
               );
					
            });
         });
      </script>
		
<?php $categories = get_categories( $args );
//echo"<pre>";
//print_r($categories);
?>
<table>
<tr>
<td>Select Category :</td>
<td>
<select name="cat" id="cat">
<?php
foreach ($categories  as $cat)
{
?>
<option><?php echo  $cat->name; ?></option>
<?php
}
?> 
</select>
</td>
</tr>
</table>
<div style="padding-top:100px;" id="show">sasdsdsad</div>
