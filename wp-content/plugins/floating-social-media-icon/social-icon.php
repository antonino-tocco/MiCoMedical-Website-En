<?php 
/**********************************************/
$total_themes = ACX_SOCIALMEDIA_TOTAL_THEMES; // DEFINE NUMBER OF THEMES HERE
$total_themes = ($total_themes+1); // DO NOT EDIT THIS
/**********************************************/
$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
if ($acx_si_fsmi_hide_advert == "") {	$acx_si_fsmi_hide_advert = "no"; }
if(ISSET($_GET["backlink"]))
{
$get_backlink = sanitize_text_field($_GET["backlink"]);
} else
{
$get_backlink = "";
}
if($get_backlink == "enable") {
$acx_si_credit = "yes";
update_option('acx_si_credit', $acx_si_credit);
?>
<style type='text/css'>
#acx_backlink
{
display:none;
}
</style>
<?php }
if(ISSET($_POST['acurax_social_icon_hidden']))
{
	$acurax_social_icon_hidden = $_POST['acurax_social_icon_hidden'];
}
else
{
	$acurax_social_icon_hidden = '';
}
if($acurax_social_icon_hidden == 'Y') 
{
	if (!isset($_POST['acx_fsmi_save_config'])) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
	if (!wp_verify_nonce($_POST['acx_fsmi_save_config'],'acx_fsmi_save_config')) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
	if(!current_user_can('manage_options')) die("<br><br>Sorry, You have no permission to do this action...</a>");

	//Form data sent
	$acx_si_theme = sanitize_text_field($_POST['acx_si_theme']);
	if(!is_numeric($acx_si_theme))
	{
	$acx_si_theme = 1;
	}
	update_option('acx_si_theme', $acx_si_theme);
	
	$acx_si_twitter = sanitize_text_field($_POST['acx_si_twitter']);
	update_option('acx_si_twitter', $acx_si_twitter);
	$acx_si_facebook = $_POST['acx_si_facebook'];
	if($acx_si_facebook != "")
	{
		if (substr($acx_si_facebook, 0, 4) != 'http') {
		$acx_si_facebook = 'http://' . $acx_si_facebook;
		} if($acx_si_facebook == "http://#") { $acx_si_facebook = "#"; }
	}	update_option('acx_si_facebook', $acx_si_facebook);
	$acx_si_youtube = esc_url_raw($_POST['acx_si_youtube']);
	update_option('acx_si_youtube', $acx_si_youtube);
	$acx_si_linkedin = esc_url_raw($_POST['acx_si_linkedin']);
	update_option('acx_si_linkedin', $acx_si_linkedin);
	$acx_si_gplus = esc_url_raw($_POST['acx_si_gplus']);
	update_option('acx_si_gplus', $acx_si_gplus);
	$acx_si_credit = ISSET($_POST['acx_si_credit']);
	update_option('acx_si_credit', $acx_si_credit);
	$acx_si_icon_size = $_POST['acx_si_icon_size'];
	update_option('acx_si_icon_size', $acx_si_icon_size);
	$acx_si_display = $_POST['acx_si_display'];
	update_option('acx_si_display', $acx_si_display);
	$acx_si_pinterest = esc_url_raw($_POST['acx_si_pinterest']);
	update_option('acx_si_pinterest', $acx_si_pinterest);
	
	$acx_si_feed = esc_url_raw($_POST['acx_si_feed']);
	update_option('acx_si_feed', $acx_si_feed);
	$social_icon_array_order = get_option('social_icon_array_order');
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
		?>
		<div class="updated"><p><strong><?php _e('Acurax Floating Social Icons Settings Saved!.' ); ?></strong></p></div>
		<script type="text/javascript">
		 setTimeout(function(){
				jQuery('.updated').fadeOut('slow');
				
				}, 4000);

		</script>
		<?php
}
	else
{	//Normal page display
$acx_si_installed_date = get_option('acx_si_installed_date');
if ($acx_si_installed_date=="") { $acx_si_installed_date = time();
update_option('acx_si_installed_date', $acx_si_installed_date);
								}
	$acx_si_theme = get_option('acx_si_theme');
	$acx_si_twitter = get_option('acx_si_twitter');
	$acx_si_facebook = get_option('acx_si_facebook');
	$acx_si_youtube = get_option('acx_si_youtube');
	$acx_si_linkedin = get_option('acx_si_linkedin');
	$acx_si_pinterest = get_option('acx_si_pinterest');
	$acx_si_feed = get_option('acx_si_feed');
	$acx_si_gplus = get_option('acx_si_gplus');
	$acx_si_credit = get_option('acx_si_credit');
	$acx_si_icon_size = get_option('acx_si_icon_size');
	$acx_si_display = get_option('acx_si_display');
	acx_fsmi_orderarray_refresh();
	$social_icon_array_order = get_option('social_icon_array_order');
	$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
	// Setting Defaults
	if ($acx_si_credit == "") {	$acx_si_credit = "no"; }
	if ($acx_si_icon_size == "") { $acx_si_icon_size = "32"; }
	if ($acx_si_display == "") { $acx_si_display = "both"; }
	if ($acx_si_theme == "") { $acx_si_theme = "1"; }
	if ($acx_si_fsmi_hide_advert == "") { $acx_si_fsmi_hide_advert = "no"; }
} //Main else
?>
	<!--  To Update Drag and Drop -->
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery(function() 
		{
			jQuery("#contentLeft ul").sortable(
			{ 
				opacity: 0.5, cursor: 'move', update: function() 
				{
					var order = jQuery(this).sortable("serialize") + '&action=acx_fsmi_saveorder'; 
					jQuery.post(ajaxurl, order, function(theResponse)
					{
						jQuery("#contentRight").html(theResponse);
					}); 															 
				}								  
			});
		});
	});	
	</script>
	
	
<div class="wrap" >
<div style='background: white none repeat scroll 0% 0%; height: 100%; margin-top: 5px; border-radius: 15px; min-height: 450px; box-sizing: border-box; margin-left: auto; margin-right: auto; width: 100%; padding: 1%;display: inline-block;'>
<?php
if($acx_si_fsmi_hide_advert == "no")
{
?>
<div id="acx_fsmi_premium">
<a style="margin: 10px 0px 0px 10px; font-weight: bold; font-size: 14px; display: block;" href="admin.php?page=Acurax-Social-Icons-Premium" target="_blank">Fully Featured - Premium Floating Social Media Icon is Available With Tons of Extra Features! - Click Here</a>
</div> <!-- acx_fsmi_premium -->
<?php } ?>
<h2 style="width: 100%; font-size: 2px; padding: 0px; line-height: 0px; color: white;">.</h2>
<?php
if($acx_si_credit != "yes")
{	?>
<div id='acx_backlink' align='center'>
Please do a favour by enabling back-link to our site. <a href="admin.php?page=Acurax-Social-Icons-Settings&backlink=enable">Okay, Enable.</a> 
</div>
<?php 
}	?>
<div class="acx_fsmi_admin_left">
<form name="acurax_si_form" id="acurax_si_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="acurax_social_icon_hidden" value="Y">

<h2 class="acx_fsmi_page_h2">Acurax Social Icons Options</h2>

		
<div id="acx_fsmi_admin_left_section">	
<?php    echo "<h4>" . "Your Current Theme is <b>Theme" . $acx_si_theme."</b>" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
		<div class="image_div" style="margin-top:8px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/twitter.png', __FILE__);?>" style="height:<?php 
			echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/facebook.png', __FILE__);?>" style="height:
			<?php echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/googleplus.png', __FILE__);?>" style="height:
			<?php echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/pinterest.png', __FILE__);?>" style="height:
			<?php echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/youtube.png', __FILE__);?>" style="height:<?php
			echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/linkedin.png', __FILE__);?>" style="height:
			<?php echo $acx_si_icon_size;?>px;">
			<img src="<?php echo plugins_url('images/themes/'.$acx_si_theme.'/feed.png', __FILE__);?>" style="height:
			<?php echo $acx_si_icon_size;?>px;">
		</div>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
	<?php
	$social_icon_array_order = unserialize($social_icon_array_order);
	// Starting The Theme List
?>
<div id="acx_fsmi_admin_left_section">	
<?php    echo "<h4>Icon Theme Settings</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<div id="acx_si_theme_display">
<?php
	for ($i=1; $i < $total_themes; $i++)
	{ ?>
		<label class="acx_si_single_theme_display <?php if ($acx_si_theme == $i) { echo "selected"; } ?>" id="icon_selection">
		<div class="acx_si_single_label">Theme <?php echo $i; ?><br><input type="radio" name="acx_si_theme" value="<?php echo $i; ?>"<?php if ($acx_si_theme == $i) { echo " checked"; } ?>></div>
		<div class="image_div">
			<?php
				foreach ($social_icon_array_order as $key => $value)
				{
					if ($value == 0) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/twitter.png', __FILE__) . ">"; 
					} 	else 
					if ($value == 1) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/facebook.png', __FILE__) . ">"; 
					}	else 
					if ($value == 2) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/googleplus.png', __FILE__) . ">"; 
					}	else
	 
					if ($value == 3) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/pinterest.png', __FILE__) . ">"; 
					}	else
					if ($value == 4) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/youtube.png', __FILE__) . ">"; 
					}	else 
					if ($value == 5) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/linkedin.png', __FILE__) . ">"; 
					}
					
					if ($value == 6) 
					{
						echo "<img src=" . plugins_url('images/themes/'. $i .'/feed.png', __FILE__) . ">"; 
					}
				}
			?>			
		</div>
		</label>
	<?php
	}
	?>
</div> <!-- acx_si_theme_display -->
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<div id="acx_fsmi_admin_left_section">	
<?php    echo "<h4>Icon Size Settings</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
		<select name="acx_si_icon_size" style="width: 99.7%">
			<option value="16"<?php if ($acx_si_icon_size == "16") { echo 'selected="selected"'; } ?>>16px X 16px </option>
			<option value="25"<?php if ($acx_si_icon_size == "25") { echo 'selected="selected"'; } ?>>25px X 25px </option>
			<option value="32"<?php if ($acx_si_icon_size == "32") { echo 'selected="selected"'; } ?>>32px X 32px </option>
			<option value="40"<?php if ($acx_si_icon_size == "40") { echo 'selected="selected"'; } ?>>40px X 40px </option>
			<option value="48"<?php if ($acx_si_icon_size == "48") { echo 'selected="selected"'; } ?>>48px X 48px </option>
			<option value="55"<?php if ($acx_si_icon_size == "55") { echo 'selected="selected"'; } ?>>55px X 55px </option>
		</select>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Social Media Icon Display Order - Drag and Drop to Reorder" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
		<div id="contentLeft">
			<ul>
			<?php
			foreach ($social_icon_array_order as $key => $value)
			{
				?>
				<li id="recordsArray_<?php echo $value; ?>">
				<?php 
				if ($value == 0) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/twitter.png', __FILE__) . " 
					border='0'><br> Twitter"; 
				} 	else 
				if ($value == 1) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/facebook.png', __FILE__) . " 
					border='0'><br> Facebook"; 
				}	else 
				if ($value == 2) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/googleplus.png', __FILE__) . " 
					border='0'><br> Google Plus"; 
				}	else
				 
				if ($value == 3) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/pinterest.png', __FILE__) . " 
					border='0'><br> Pinterest"; 
				}	else
				if ($value == 4) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/youtube.png', __FILE__) . " 
					border='0'><br> Youtube"; 
				}	else 
				if ($value == 5) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/linkedin.png', __FILE__) . " 
					border='0'><br> Linkedin"; 
				}
				
				if ($value == 6) 
				{
					echo "<img src=" . plugins_url('images/themes/'. $acx_si_theme .'/feed.png', __FILE__) . " 
					border='0'><br> Rss Feed"; 
				}
					?>
					</li>	<?php
			}	?>
			</ul>
		</div>
		<div id="contentRight"></div> <!-- contentRight -->
<?php _e("Drag and Reorder Icons (It will automatically save on reorder)" ); ?>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->

<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Social Media Configuration" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<p class="field_label">
<?php _e("Twitter Username: " ); ?>
</p>
<input type="text" name="acx_si_twitter" value="<?php echo $acx_si_twitter; ?>" size="50" placeholder="eg: acuraxdotcom">
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Facebook Profile URL: " ); ?>
</p>
<input type="text" name="acx_si_facebook" value="<?php echo $acx_si_facebook; ?>" size="50" placeholder="eg: http://www.facebook.com/AcuraxInternational">
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Google Plus URL: " ); ?>
</p>
<input type="text" name="acx_si_gplus" value="<?php echo esc_url($acx_si_gplus); ?>" size="50" placeholder="Enter Your Complete Google Plus Url Starting With http://">
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Pinterest URL: " ); ?>
</p>
<input type="text" name="acx_si_pinterest" value="<?php echo esc_url($acx_si_pinterest); ?>" size="50" placeholder="Enter Your Complete Pinterest Url Starting With http://">
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Youtube URL: " ); ?>
</p>
<input type="text" name="acx_si_youtube" value="<?php echo esc_url($acx_si_youtube); ?>" size="50" placeholder="http://www.youtube.com/user/acuraxdotcom">
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Linkedin URL: " ); ?>
</p>
<input type="text" name="acx_si_linkedin" value="<?php echo esc_url($acx_si_linkedin); ?>" size="50" placeholder="http://www.linkedin.com/company/acurax-international">
<span class="field_sep"></span>	
<p class="field_label">
<?php _e("Feed URL: " ); ?>
</p>
<input type="text" name="acx_si_feed" value="<?php echo esc_url($acx_si_feed); ?>" size="50" placeholder="http://www.yourwebsite.com/feed">
<span class="field_sep"></span>	
<span class="button fsmi_info_premium" lb_title="Adding Extra Icons Feature" lb_content="Its possible to add any number of extra icons by uploading them and you can link them to anywhere you need.<br><br>Lets say, you needs to have an icon which links to your contact page or services page, you can do that.<br><br><i>This feature is only available in our premium version - <a href='admin.php?page=Acurax-Social-Icons-Premium' target='_blank'>Compare Features</a> / <a href='http://clients.acurax.com/floating-socialmedia.php?utm_source=fsmi&utm_campaign=premium-info' target='_blank'>Order Now</a>">Add Custom Icon</span>
<span class="field_sep"></span>	
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->

<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Social Media Integration Settings" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<select name="acx_si_display" style="width: 99.7%">
<option value="auto"<?php if ($acx_si_display == "auto") { echo 'selected="selected"'; } ?>>Automatic Only (Will 
Float) - Shortcode and PHP code will not show icons</option>
<option value="manual"<?php if ($acx_si_display == "manual") { echo 'selected="selected"'; } ?>>Manual Only 
(Using Shortcode or PHP Code - Will not float)</option>
<option value="both"<?php if ($acx_si_display == "both") { echo 'selected="selected"'; } ?>>Automatic and Manual
(Shortcode/PHP will not float but Automatic will Float)</option>
</select>
<span class="field_sep"></span>
		<?php
			$code = ' <?php if (function_exists("DISPLAY_ACURAX_ICONS")) { DISPLAY_ACURAX_ICONS(); } ?>';
		?>
<p style="float: left; font-family: arial; font-size: 12px; line-height: 23px; text-align: left;">If you select display mode as "Automatic Only" , it will show automatically but will not show anything for shortcode or php code, If you select as "Manual Only", It will not automatically show floating icons but you can place</p>
<?php highlight_string($code); ?>
<p>in your theme file or use the shortcode <span style="color: #000000;background:rgba(0, 0, 0, 0.07) none repeat scroll 0 0;" class="code">&nbsp;[DISPLAY_ACURAX_ICONS]</span>, to display the Social Icons where ever you want, If you select "Automatic and Manual", It will automatically show floating icons and will also show icons for shortcode and php code.</p>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<?php if($acx_si_fsmi_hide_advert == "no")
{ ?>
<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Define Fly Animation Start and End Position" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<span class="fsmi_p_info_start_end fsmi_info_premium" lb_title="Configure Fly Animation Start and End Position" lb_content="You can configure the floating social media icons fly animation start and end position, By default it fly from top left to bottom right.<br><br><i>This feature is only available in our premium version - <a href='admin.php?page=Acurax-Social-Icons-Premium' target='_blank'>Compare Features</a> / <a href='http://clients.acurax.com/floating-socialmedia.php?utm_source=fsmi&utm_campaign=premium-info' target='_blank'>Order Now</a>"></span>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<?php } ?>
<?php if($acx_si_credit == "yes") 
{ ?>
<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Credit Link Settings" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<select name="acx_si_credit">
<option value="yes"<?php if ($acx_si_credit == "yes") { echo 'selected="selected"'; } ?>>Yes, Its Okay to Show Credit Link </option>
<option value="no"<?php if ($acx_si_credit == "no") { echo 'selected="selected"'; } ?>>No, I dont Like to Show Credit Link</option>
</select>
<span class="field_sep"></span>
<p style="width:100%;float:left;"><?php _e("We Appreciate You Link Back to Our Website, Its just a small font size link :)" ); ?></p>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<?php  
} ?>
	<input name="acx_fsmi_save_config" type="hidden" value="<?php echo wp_create_nonce('acx_fsmi_save_config'); ?>" />
	<p class="submit">
		<input type="submit" name="Submit" class="button button-primary" value="<?php _e('Save Configuration', 'acx_si_config' ) ?>" />
		<a name="updated">.</a>
	</p>
</form>
<div id="acx_fsmi_sidebar">
<?php acx_fsmi_hook_function('acx_fsmi_hook_sidebar_widget'); ?>
</div> <!-- acx_fsmi_sidebar -->
</div> <!-- acx_fsmi_admin_left -->
<?php
if($acx_si_fsmi_hide_advert == "no")
{
 socialicons_comparison(1); 
} ?>
<br>
	<p class="widefat" style="padding:8px;width:99%;">
		Something Not Working Well? Have a Doubt? Have a Suggestion? - <a href="http://www.acurax.com/contact.php" target="_blank">Contact us now</a> | Need a Custom Designed Theme For your Blog or Website? Need a Custom Header Image? - <a href="http://www.acurax.com/contact.php" target="_blank">Contact us now</a>
	</p>

</div>
</div>
<script type="text/javascript">
jQuery( ".fsmi_info_premium" ).click(function() {
var lb_title = jQuery(this).attr('lb_title');
var lb_content = jQuery(this).attr('lb_content');
var html= '<div id="acx_fsmi_c_icon_p_info_lb_h" style="display:none;"><div class="acx_fsmi_c_icon_p_info_c"><span class="acx_fsmi_c_icon_p_info_close" onclick="remove_info()"></span><h4>'+lb_title+'</h4><div class="acx_fsmi_c_icon_p_info_content">'+lb_content+'</div></div></div> <!-- acx_fsmi_c_icon_p_info_lb_h -->';
jQuery( "body" ).append(html)
jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).fadeIn();
});

function remove_info()
{
jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).fadeOut()
jQuery( "#acx_fsmi_c_icon_p_info_lb_h" ).remove();
};
</script>