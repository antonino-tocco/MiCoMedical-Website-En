<?php
if(ISSET($_GET['quickfix']))
{
$quick_fix = sanitize_text_field($_GET['quickfix']);
} else
{
$quick_fix = "";
}
if(ISSET($_GET['sid']))
{
$sid = sanitize_text_field($_GET['sid']);
} else
{
$sid = "";
}
if (!wp_verify_nonce($sid,'acx_fsmi_qfix'))
{
$sid = "";
}
if(!current_user_can('manage_options'))
{
$sid = "";
}

$fix_applied = 0;
if($sid != "")
{
	if($quick_fix == 1)
	{
		$social_icon_array_order = array(0,1,2,3,4,5,6);  // Number Of Services
		$social_icon_array_order = serialize($social_icon_array_order);
		update_option('social_icon_array_order', $social_icon_array_order);
		$fix_applied = 1;
	}
}
$acx_installation_domain = $_SERVER['HTTP_HOST'];
$acx_installation_domain = str_replace("www.","",$acx_installation_domain);
$acx_installation_domain = str_replace(".","_",$acx_installation_domain);
if($acx_installation_domain == "") { $acx_installation_domain = "not_defined";}

if($_GET['page'] == "Acurax-Social-Icons-Expert-Support")
{
$acx_page_loaded = "_es";
} else
{
$acx_page_loaded = "";
}


echo "<div style='background: none repeat scroll 0% 0% white; height: 100%; display: inline-block; padding: 15px; width: 95%; margin-top: 15px; border-radius: 15px; min-height: 450px;'>";

if($fix_applied == 1)
{
echo "<div style='background: none repeat scroll 0% 0% lightgreen; width: 300px; text-align: center; margin-right: auto; margin-left: auto; padding: 7px 7px 5px; border-top-right-radius: 7px; border-top-left-radius: 7px; border-bottom: 2px solid green;'>Action Completed Successfully</div>";
}
if($_GET['page'] == "Acurax-Social-Icons-Expert-Support")
{
acx_fsmi_quick_form();
} else
{
echo "<h2 class='acx_fsmi_page_h2'>Floating Social Media Icon Troubleshooting</h2>"; ?>
<p style="font-weight:bold;text-align:center;color:darkred;">IMPORTANT NOTE: Please do troubleshooting only if you got instructions from support or know what you are going to do.</p>
<p class="widefat" style="background: none repeat scroll 0% 0% menu; border-bottom: 2px dashed lavender; border-right: 2px dashed lavender; margin-bottom: 15px; margin-top: 8px; padding: 8px; width: 99%;">	<?php _e("1) Icon Selection Display Fix: " ); ?>
<?php _e("If you cant find any icons on the icon theme/style selection section, try this fix" ); ?>
<a href="admin.php?page=Acurax-Social-Icons-Troubleshooter&quickfix=1&sid=<?php echo wp_create_nonce('acx_fsmi_qfix'); ?>" class="acx_trouble_fixit">Click here to try this fix!</a>
</p>
<p style="text-align:center;">We will be adding more troubleshooting quick fix options according to users requests</p>
<?php
acx_fsmi_quick_form();
}
echo "</div>";
?>