<?php 
if(ISSET($_POST['acurax_social_icon_hidden']))
{
	$acurax_social_icon_hidden = $_POST['acurax_social_icon_hidden'];
}
else
{
	$acurax_social_icon_hidden = '';
}
if($acurax_social_icon_hidden == 'Y') 
{	//Form data sent
if (!isset($_POST['acx_fsmi_misc'])) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
if (!wp_verify_nonce($_POST['acx_fsmi_misc'],'acx_fsmi_misc')) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
if(!current_user_can('manage_options')) die("<br><br>Sorry, You have no permission to do this action...</a>");


$acx_si_fsmi_theme_warning_ignore = sanitize_text_field($_POST['acx_si_fsmi_theme_warning_ignore']);
update_option('acx_si_fsmi_theme_warning_ignore', $acx_si_fsmi_theme_warning_ignore);


$acx_si_fsmi_float_fix = sanitize_text_field($_POST['acx_si_fsmi_float_fix']);
update_option('acx_si_fsmi_float_fix', $acx_si_fsmi_float_fix);

$acx_fsmi_acx_service_banners = sanitize_text_field($_POST['acx_fsmi_acx_service_banners']);
update_option('acx_fsmi_acx_service_banners', $acx_fsmi_acx_service_banners);

$acx_si_fsmi_hide_advert = sanitize_text_field($_POST['acx_si_fsmi_hide_advert']);
update_option('acx_si_fsmi_hide_advert', $acx_si_fsmi_hide_advert);

$acx_si_fsmi_disable_mobile = sanitize_text_field($_POST['acx_si_fsmi_disable_mobile']);
update_option('acx_si_fsmi_disable_mobile', $acx_si_fsmi_disable_mobile);


$acx_si_fsmi_no_follow = sanitize_text_field($_POST['acx_si_fsmi_no_follow']);
update_option('acx_si_fsmi_no_follow', $acx_si_fsmi_no_follow);

$acx_si_fsmi_hide_expert_support_menu = sanitize_text_field($_POST['acx_si_fsmi_hide_expert_support_menu']);
update_option('acx_si_fsmi_hide_expert_support_menu', $acx_si_fsmi_hide_expert_support_menu);


?>
<div class="updated"><p><strong><?php _e('Acurax Floating Social Icons Misc Settings Saved!.' ); ?></strong></p></div>
<script type="text/javascript">
		 setTimeout(function(){
				jQuery('.updated').fadeOut('slow');
				
				}, 4000);

		</script>
<?php
}
else
{	//Normal page display
$acx_si_fsmi_theme_warning_ignore = get_option('acx_si_fsmi_theme_warning_ignore');
$acx_si_fsmi_float_fix = get_option('acx_si_fsmi_float_fix');
$acx_fsmi_acx_service_banners = get_option('acx_fsmi_acx_service_banners');
$acx_si_fsmi_hide_advert = get_option('acx_si_fsmi_hide_advert');
$acx_si_fsmi_disable_mobile = get_option('acx_si_fsmi_disable_mobile');
$acx_si_fsmi_no_follow = get_option('acx_si_fsmi_no_follow');
$acx_si_fsmi_hide_expert_support_menu = get_option('acx_si_fsmi_hide_expert_support_menu');

// Setting Defaults
if ($acx_si_fsmi_theme_warning_ignore == "") {	$acx_si_fsmi_theme_warning_ignore = "no"; }
if ($acx_si_fsmi_float_fix == "") {	$acx_si_fsmi_float_fix = "no"; }
if ($acx_fsmi_acx_service_banners == "") {	$acx_fsmi_acx_service_banners = "yes"; }
if ($acx_si_fsmi_hide_advert == "") {	$acx_si_fsmi_hide_advert = "no"; }
if ($acx_si_fsmi_disable_mobile == "") {	$acx_si_fsmi_disable_mobile = "no"; }
if ($acx_si_fsmi_no_follow == "") {	$acx_si_fsmi_no_follow = "no"; }
if ($acx_si_fsmi_hide_expert_support_menu == "") {	$acx_si_fsmi_hide_expert_support_menu = "no"; }
} //Main else
?>
<div class="wrap">
<div style='background: white none repeat scroll 0% 0%; height: 100%; margin-top: 5px; border-radius: 15px; min-height: 450px; box-sizing: border-box; margin-left: auto; margin-right: auto; width: 100%; padding: 1%;display: inline-block;'>
<?php if($acx_si_fsmi_hide_advert == "no")
{ ?>
<div id="acx_fsmi_premium">
<a style="margin: 10px 0px 0px 10px; font-weight: bold; font-size: 14px; display: block;" href="admin.php?page=Acurax-Social-Icons-Premium" target="_blank">Fully Featured - Premium Floating Social Media Icon is Available With Tons of Extra Features! - Click Here</a>
</div> <!-- acx_fsmi_premium -->
<?php } ?>
<h2 style="width: 100%; font-size: 2px; padding: 0px; line-height: 0px; color: white;">.</h2>
<div class="acx_fsmi_admin_left">
<form name="acurax_si_misc_form" id="acurax_si_misc_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="acurax_social_icon_hidden" value="Y">
<h2 class="acx_fsmi_page_h2">Acurax Social Icons Misc Settings</h2>



<div id="acx_fsmi_admin_left_section" style="margin-top:15px;">
<?php echo "<h4>" . "Acurax Theme Conflict/Misc Settings" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<p class="field_label">
<?php _e("Icons Vertical Issue? " ); ?><a style="cursor:pointer;" class="fsmi_info_premium" lb_title="Icon Shows Vertical Instead of Horizontal" lb_content="If your social media icons is displaying vertically instead of horizontal, You can change this settings.">[?]</a>
</p>
<select name="acx_si_fsmi_float_fix">
<option value="yes"<?php if ($acx_si_fsmi_float_fix == "yes") { echo 'selected="selected"'; } ?>>Yes,Make My Vertical Icons Horizontal</option>
<option value="no"<?php if ($acx_si_fsmi_float_fix == "no") { echo 'selected="selected"'; } ?>>No, I Dont Have Any Issues</option>
</select>
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Ignore Theme Warning?" ); ?>
</p>
<select name="acx_si_fsmi_theme_warning_ignore">
<option value="yes"<?php if ($acx_si_fsmi_theme_warning_ignore == "yes") { echo 'selected="selected"'; } ?>>Yes, Everything is working fine and and i still see theme warning - Fix This</option>
<option value="no"<?php if ($acx_si_fsmi_theme_warning_ignore == "no") { echo 'selected="selected"'; } ?>>No, I Have No Issues </option>
</select>
<span class="field_sep"></span>
<?php if($acx_si_fsmi_hide_advert == "no")
{ ?>
<p class="field_label">
<?php _e("Set Icons Vertical " ); ?><a style="cursor:pointer;" class="fsmi_info_premium" lb_title="Display Icons Vertically" lb_content="Its possible to make the social icons align vertical or horizontal, You can set the number of icons to have a in a row, by adjusting the slider, So you can set # of icons in a row to 1 makes it looks vertical.<br><br><i>This feature is only available in our premium version - <a href='admin.php?page=Acurax-Social-Icons-Premium' target='_blank'>Compare Features</a> / <a href='http://clients.acurax.com/floating-socialmedia.php/?utm_source=fsmi&utm_campaign=premium-info' target='_blank'>Order Now</a>">[?]</a></p>
<span name="acx_si_fsmi_theme_demo_vertical" class="fsmi_p_info_icon_h fsmi_info_premium" lb_title="Display Icons Vertically" lb_content="Its possible to make the social icons align vertical or horizontal, You can set the number of icons to have a in a row, by adjusting the slider, So you can set # of icons in a row to 1 makes it looks vertical.<br><br><i>This feature is only available in our premium version - <a href='admin.php?page=Acurax-Social-Icons-Premium' target='_blank'>Compare Features</a> / <a href='http://clients.acurax.com/floating-socialmedia.php/?utm_source=fsmi&utm_campaign=premium-info' target='_blank'>Order Now</a>">
</span>
<span class="field_sep"></span>
<?php } ?>
<p class="field_label">
<?php _e("Disable Floating On Mob Devices? " ); ?><a style="cursor:pointer;" class="fsmi_info_premium" lb_title="Disable Floating Icons on Mobile Devices" lb_content="Depends on some theme design, the floating icons can make visibility issues on mobile devices, if you are experiencing such an issue, you can disable the floating icons on mobile devices.">[?]</a>
</p>
<select name="acx_si_fsmi_disable_mobile">
<option value="yes"<?php if ($acx_si_fsmi_disable_mobile == "yes") { echo 'selected="selected"'; } ?>>Yes, Lets disable it </option>
<option value="no"<?php if ($acx_si_fsmi_disable_mobile == "no") { echo 'selected="selected"'; } ?>>No, Thats fine </option>
</select>
<span class="field_sep"></span>
<p class="field_label">
<?php _e("No follow links? " ); ?><a style="cursor:pointer;" class="fsmi_info_premium" lb_title="Icon Link No Follow Settings" lb_content="Would you like to disable Nofollow on Icon links? You can configure this option to Yes">[?]</a>
</p>
<select name="acx_si_fsmi_no_follow">
<option value="yes"<?php if ($acx_si_fsmi_no_follow == "yes") { echo 'selected="selected"'; } ?>>No,Thats fine </option>
<option value="no"<?php if ($acx_si_fsmi_no_follow == "no") { echo 'selected="selected"'; } ?>>Yes, Enable No Follow </option>
</select>
<span class="field_sep"></span>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->


<div id="acx_fsmi_admin_left_section">	
<?php echo "<h4>" . "Acurax Service/Info Settings" . "</h4>"; ?>
<div class="acx_fsmi_admin_left_section_c">
<p class="field_label">
<?php _e("Acurax Service Info" ); ?>
</p>
<select name="acx_fsmi_acx_service_banners">
<option value="yes"<?php if ($acx_fsmi_acx_service_banners == "yes") { echo 'selected="selected"'; } ?>>Show Acurax Service Banner</option>
<option value="no"<?php if ($acx_fsmi_acx_service_banners == "no") { echo 'selected="selected"'; } ?>>Hide Acurax Service Banner</option>
</select>
<span class="field_sep"></span>

<p class="field_label">
<?php _e("Premium Version Info" ); ?>
</p>
<select name="acx_si_fsmi_hide_advert">
<option value="yes"<?php if ($acx_si_fsmi_hide_advert == "yes") { echo 'selected="selected"'; } ?>>Hide Premium Version Infos</option>
<option value="no"<?php if ($acx_si_fsmi_hide_advert == "no") { echo 'selected="selected"'; } ?>>Show Premium Version Infos</option>
</select>
<span class="field_sep"></span>
<p class="field_label">
<?php _e("Expert Support Menu" ); ?>
</p>
<select name="acx_si_fsmi_hide_expert_support_menu">
<option value="yes"<?php if ($acx_si_fsmi_hide_expert_support_menu == "yes") { echo 'selected="selected"'; } ?>>Hide Expert Support Menu From Acurax</option>
<option value="no"<?php if ($acx_si_fsmi_hide_expert_support_menu == "no") { echo 'selected="selected"'; } ?>>Show Expert Support Menu From Acurax</option>
</select>
<span class="field_sep"></span>
</div> <!-- acx_fsmi_admin_left_section_c -->
</div> <!-- acx_fsmi_admin_left_section -->
<input name="acx_fsmi_misc" type="hidden" value="<?php echo wp_create_nonce('acx_fsmi_misc'); ?>" />
<p class="submit">
<input type="submit" name="Submit" class="button button-primary" value="<?php _e('Save Settings', 'acx_si_config' ) ?>" />
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