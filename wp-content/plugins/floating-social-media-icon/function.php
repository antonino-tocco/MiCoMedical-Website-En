<?php
//*************** Include style.css in Header ********
// Getting Option From DB *****************************	
$acx_si_theme = get_option('acx_si_theme');
$acx_si_credit = get_option('acx_si_credit');
$acx_si_display = get_option('acx_si_display');
$acx_si_twitter = get_option('acx_si_twitter');
$acx_si_facebook = get_option('acx_si_facebook');
$acx_si_youtube = get_option('acx_si_youtube');
$acx_si_linkedin = get_option('acx_si_linkedin');
$acx_si_gplus = get_option('acx_si_gplus');
$acx_si_pinterest = get_option('acx_si_pinterest');
$acx_si_feed = get_option('acx_si_feed');
$acx_si_icon_size = get_option('acx_si_icon_size');
$acx_si_fsmi_float_fix = get_option('acx_si_fsmi_float_fix');
$acx_si_fsmi_theme_warning_ignore = get_option('acx_si_fsmi_theme_warning_ignore');
$acx_si_fsmi_disable_mobile = get_option('acx_si_fsmi_disable_mobile');
// *****************************************************
$social_icon_array_order = get_option('social_icon_array_order');
if(is_serialized($social_icon_array_order))
{
$social_icon_array_order = unserialize($social_icon_array_order);
}
function acx_fsmi_orderarray_refresh()
{
global $social_icon_array_order;
/* Starting The Logic Count and Re Configuring Order Array */	
	$total_arrays = ACX_FSMI_TOTAL_STATIC_SERVICES; // Number Of Static Services ,<< Earlier its 10
	if(is_serialized($social_icon_array_order))
	{
		$social_icon_array_order = unserialize($social_icon_array_order);
	}
	if($social_icon_array_order == "")
	{
	$social_icon_array_order = array();
	}	
	if (empty($social_icon_array_order)) 
	{
		for( $i = 0; $i < $total_arrays; $i++ )
		{
			array_push($social_icon_array_order,$i);
		}
		
		if(!is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = serialize($social_icon_array_order);
		}
		update_option('social_icon_array_order', $social_icon_array_order);
	} else 
	{
		// Counting and Adding New Keys (UPGRADE PURPOSE)
		$social_icon_array_order = get_option('social_icon_array_order');
		if(is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = unserialize($social_icon_array_order);
		}
		$social_icon_array_count = count($social_icon_array_order); 
		if ($social_icon_array_count < $total_arrays) 
		{
			for( $i = $social_icon_array_count; $i < $total_arrays; $i++ )
			{
				array_push($social_icon_array_order,$i);
			} // for
		} else
		{
		//	$acx_diff = ($social_icon_array_count - $total_arrays);
			$acx_temp_array = $social_icon_array_order;
			foreach ($social_icon_array_order as $key => $value)
			{
				if($social_icon_array_order[$key]>=$total_arrays)
				{
					unset($acx_temp_array[$key]);
				}
			}
			$acx_temp_array = array_values($acx_temp_array);
			$social_icon_array_order = $acx_temp_array;
		}
		if(!is_serialized($social_icon_array_order))
		{
		$social_icon_array_order = serialize($social_icon_array_order);
		}
		update_option('social_icon_array_order', $social_icon_array_order);
	} // else closing of if array null
/* Ending The Logic Count and Re Configuring Order Array */	
}
// Check Credit Link
function enqueue_acx_si_style()
{
	wp_enqueue_style ( 'acx-si-style', plugins_url('style.css', __FILE__) );
}	add_action( 'wp_print_styles', 'enqueue_acx_si_style' );
// Options Value Checker
function check_acx_credit($yes,$no)
{ 	$acx_si_credit = get_option('acx_si_credit');
	if($acx_si_credit != "no") { echo $yes; } else { echo $no; } 
}
function acurax_si_simple($theme = "",$size = "") // Added Default "" // Updated << and V (alt added to Images Title Added to Links)
{

	// Getting Globals *****************************	
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed, $acx_si_icon_size;
	// *****************************************************
	
	if($size == "")
	{
	$size = $acx_si_icon_size;
	}
	if($size != "")
	{
	$size = $size."px";
	$acx_si_icon_height_width_attribute = "height='".$size."' width='".$size."'";
	} else
	{
	$acx_si_icon_height_width_attribute = "";
	}
	if ($theme == "") { $acx_si_touse_theme = $acx_si_theme; } else { $acx_si_touse_theme = $theme; }
		//******** MAKING EACH BUTTON LINKS ********************
		$acx_si_fsmi_no_follow = get_option('acx_si_fsmi_no_follow');
		if($acx_si_fsmi_no_follow == 'yes')
		{
			$acx_si_fsmi_rel = "rel='nofollow'";
		}
		else{
			$acx_si_fsmi_rel = "";
		}
		
		if	($acx_si_twitter == "") { $twitter_link = ""; } else 
		{
			$twitter_link = "<a href='http://www.twitter.com/". $acx_si_twitter ."' target='_blank' ".$acx_si_fsmi_rel."  title='Visit Us On Twitter'>" . "<img src=" . plugins_url('images/themes/'. $acx_si_touse_theme .'/twitter.png', __FILE__) . " style='border:0px;' alt='Visit Us On Twitter' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_facebook == "") { $facebook_link = ""; } else 
		{
			$facebook_link = "<a href='". $acx_si_facebook ."' target='_blank' ".$acx_si_fsmi_rel." title='Visit Us On Facebook'>" . "<img src=" . plugins_url('images/themes/' . $acx_si_touse_theme .'/facebook.png', __FILE__) . " style='border:0px;' alt='Visit Us On Facebook' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_gplus == "") { $gplus_link = ""; } else 
		{
			$gplus_link = "<a href='". $acx_si_gplus ."' target='_blank' ".$acx_si_fsmi_rel."  title='Visit Us On Google Plus'>" . "<img src=" . plugins_url('images/themes/'. $acx_si_touse_theme .'/googleplus.png', __FILE__) . " style='border:0px;' alt='Visit Us On Google Plus' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_pinterest == "") { $pinterest_link = ""; } else 
		{
			$pinterest_link = "<a href='". $acx_si_pinterest ."' target='_blank'  ".$acx_si_fsmi_rel." title='Visit Us On Pinterest'>" . "<img src=" . plugins_url('images/themes/' . $acx_si_touse_theme .'/pinterest.png', __FILE__) . " style='border:0px;' alt='Visit Us On Pinterest' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_youtube == "") { $youtube_link = ""; } else 
		{
			$youtube_link = "<a href='". $acx_si_youtube ."' target='_blank' ".$acx_si_fsmi_rel."  title='Visit Us On Youtube'>" . "<img src=" . plugins_url('images/themes/' . $acx_si_touse_theme .'/youtube.png', __FILE__) . " style='border:0px;' alt='Visit Us On Youtube' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_linkedin == "") { $linkedin_link = ""; } else 
		{
			$linkedin_link = "<a href='". $acx_si_linkedin ."' target='_blank' ".$acx_si_fsmi_rel."  title='Visit Us On Linkedin'>" . "<img src=" . plugins_url('images/themes/' . $acx_si_touse_theme .'/linkedin.png', __FILE__) . " style='border:0px;' alt='Visit Us On Linkedin' ".$acx_si_icon_height_width_attribute." /></a>";
		}
		if	($acx_si_feed == "") { $feed_link = ""; } else 
		{
			$feed_link = "<a href='". $acx_si_feed ."' target='_blank' ".$acx_si_fsmi_rel." title='Check Our Feed'>" . "<img src=" . plugins_url('images/themes/' . $acx_si_touse_theme .'/feed.png', __FILE__) . " style='border:0px;' alt='Check Our Feed' ".$acx_si_icon_height_width_attribute." /></a>";
		}
	$social_icon_array_order = get_option('social_icon_array_order');
	if(is_serialized($social_icon_array_order))
	{
	$social_icon_array_order = unserialize($social_icon_array_order);
	}
	if($social_icon_array_order == "")
	{
	$social_icon_array_order = array();
	}
	foreach ($social_icon_array_order as $key => $value)
	{
		if ($value == 0) { echo $twitter_link; } 
		else if ($value == 1) { echo $facebook_link; } 
		else if ($value == 2) { echo $gplus_link; } 
		else if ($value == 3) { echo $pinterest_link; } 
		else if ($value == 4) { echo $youtube_link; } 
		else if ($value == 5) { echo $linkedin_link; } 
		
		else if ($value == 6) { echo $feed_link; }
	}
} //acurax_si_simple()
function acx_theme_check_wp_head() {
	$template_directory = get_template_directory();
	// If header.php exists in the current theme, scan for "wp_head"
	$file = $template_directory . '/header.php';
	if (is_file($file)) {
		$search_string = "wp_head";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_head() not found:
		echo "<div class=\"highlight\" style=\"margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred; padding: 1%; width: 97%; border-radius: 7px;\">" . "Your theme needs to be fixed for plugins to work (Especially Floating Social Media Icon). To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>".htmlspecialchars("<?php wp_head(); ?>")."</code> just before the <code>".htmlspecialchars("</head>")."</code> line of your theme's <code>header.php</code> file. - [If everything is working properly, you can disable this warning at <a href=\"admin.php?page=Acurax-Social-Icons-Misc\">misc page</a>]" . "</div>";
	}
} // theme check 
if($acx_si_fsmi_theme_warning_ignore != "yes")
{
add_action('admin_notices', 'acx_theme_check_wp_head');
}
function acx_theme_check_wp_footer() {
	$template_directory = get_template_directory();
	
	// If footer.php exists in the current theme, scan for "wp_footer"
	$file = $template_directory . '/footer.php';
	if (is_file($file)) {
		$search_string = "wp_footer";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_footer() not found:
		echo "<div class=\"highlight\" style=\"margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred; padding: 1%; width: 97%; border-radius: 7px;\">" . "Your theme needs to be fixed for plugins to work (Especially Floating Social Media Icon). To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>".htmlspecialchars("<?php wp_footer(); ?>")."</code> just before the <code>".htmlspecialchars("</body>")."</code> line of your theme's <code>footer.php</code> file. - [If everything is working properly, you can disable this warning at <a href=\"admin.php?page=Acurax-Social-Icons-Misc\">misc page</a>]" . "</div>";
	}
}
if($acx_si_fsmi_theme_warning_ignore != "yes")
{
add_action('admin_notices', 'acx_theme_check_wp_footer');
}
function acurax_icons()
{
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed, $acx_si_icon_size;
			
	if($acx_si_twitter != "" || $acx_si_facebook != "" || $acx_si_youtube != "" || $acx_si_linkedin != ""  || 
	$acx_si_pinterest != "" || $acx_si_gplus != "" || $acx_si_feed != "")
	{
	//*********************** STARTED DISPLAYING THE ICONS ***********************
		echo "\n\n\n<!-- Starting Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n";
		echo "<div id='divBottomRight' style='text-align:center;'>";
		acurax_si_simple($acx_si_theme,$acx_si_icon_size);		
		echo "</div>\n";
		echo "<!-- Ending Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
	//*****************************************************************************
	} // Chking null fields
	
} // Ending acurax_icons();
// Setting X Y values for javascript
$x = -170;
$y = -60;
function acx_load_floating_js()
{ 
	global $x;
	global $y;
	//*************** STARTING PUMBING JAVASCIRPT *******************************
	echo "\n\n\n<!-- Starting Javascript For Social Media Icon From Acurax International www.acurax.com -->\n";	
	$acx_si_icon_size = get_option('acx_si_icon_size');
	////////////////////////////////////////////////////////////////////////////
	//STARTING CROSS CHECK			    $count,$icon_size,$set_value  
	function acx_si_check_loaded_count($count,$icon_size,$set_x_value,$set_y_value)
	{
		// Defining Values To Use
		$acx_si_icon_size = get_option('acx_si_icon_size'); // Getting Value From DB :)
		$acx_si_twitter = get_option('acx_si_twitter');
		$acx_si_facebook = get_option('acx_si_facebook');
		$acx_si_youtube = get_option('acx_si_youtube');
		$acx_si_linkedin = get_option('acx_si_linkedin');
		$acx_si_feed = get_option('acx_si_feed');
		$acx_si_gplus = get_option('acx_si_gplus');
		$acx_si_pinterest = get_option('acx_si_pinterest');
		$count_check = 0;
		$l1 = 0;
		$l2 = 0;
		$l3 = 0;
		$l4 = 0;
		$l5 = 0;
		$l6 = 0;
		$l7 = 0;
		if ($acx_si_twitter != "") { $l1 = 1; }
		if ($acx_si_facebook != "") { $l2 = 1; }
		if ($acx_si_youtube != "") { $l3 = 1; }
		if ($acx_si_linkedin != "") { $l4 = 1; }
		if ($acx_si_gplus != "") { $l5 = 1; }
		if ($acx_si_pinterest != "") { $l6 = 1; }
		if ($acx_si_feed != "") { $l7 = 1; }
		$count_check = $l1 + $l2 + $l3 + $l4 + $l5 + $l6 + $l7;
		if ($acx_si_icon_size == $icon_size && $count_check == $count)
		{
			global $x;
			global $y;
			$x = $set_x_value;
			$y = $set_y_value;
		}
	} // ENDING THE FUNCTION TO CROS CHECK
	/**************************************************************************
	CONDITIONS STARTING HERE  
	if X Decreases then move to Right
	If Y Decreases then Move to Down
	***************************************************************************/
	// Icon Size 16 Starts Here
	acx_si_check_loaded_count(1,16,-170,-35);
	acx_si_check_loaded_count(2,16,-170,-35);
	acx_si_check_loaded_count(3,16,-170,-35);
	acx_si_check_loaded_count(4,16,-170,-35);
	acx_si_check_loaded_count(5,16,-170,-35);
	acx_si_check_loaded_count(6,16,-170,-35);
	acx_si_check_loaded_count(7,16,-170,-35);
	// *********************************
	// Icon Size 25 Starts Here
	acx_si_check_loaded_count(1,25,-160,-50);
	acx_si_check_loaded_count(2,25,-160,-50);
	acx_si_check_loaded_count(3,25,-160,-50);
	acx_si_check_loaded_count(4,25,-160,-50);
	acx_si_check_loaded_count(5,25,-160,-50);
	acx_si_check_loaded_count(6,25,-180,-50);
	acx_si_check_loaded_count(7,25,-180,-50);
	// *********************************
	// Icon Size 32 Starts Here
	acx_si_check_loaded_count(1,32,-170,-55);
	acx_si_check_loaded_count(2,32,-170,-55);
	acx_si_check_loaded_count(3,32,-170,-55);
	acx_si_check_loaded_count(4,32,-170,-55);
	acx_si_check_loaded_count(5,32,-190,-70);
	acx_si_check_loaded_count(6,32,-160,-80);
	acx_si_check_loaded_count(7,32,-160,-80);
	// *********************************
	// Icon Size 40 Starts Here
	acx_si_check_loaded_count(1,40,-170,-65);
	acx_si_check_loaded_count(2,40,-170,-65);
	acx_si_check_loaded_count(3,40,-170,-65);
	acx_si_check_loaded_count(4,40,-170,-105);
	acx_si_check_loaded_count(5,40,-170,-105);
	acx_si_check_loaded_count(6,40,-170,-105);
	acx_si_check_loaded_count(7,40,-170,-145);
	// *********************************
	// Icon Size 48 Starts Here
	acx_si_check_loaded_count(1,48,-170,-75);
	acx_si_check_loaded_count(2,48,-170,-75);
	acx_si_check_loaded_count(3,48,-170,-75);
	acx_si_check_loaded_count(4,48,-170,-120);
	acx_si_check_loaded_count(5,48,-170,-120);
	acx_si_check_loaded_count(6,48,-170,-120);
	acx_si_check_loaded_count(7,48,-170,-175);
	// *********************************
	// Icon Size 55 Starts Here
	acx_si_check_loaded_count(1,55,-170,-80);
	acx_si_check_loaded_count(2,55,-170,-80);
	acx_si_check_loaded_count(3,55,-170,-135);
	acx_si_check_loaded_count(4,55,-170,-135);
	acx_si_check_loaded_count(5,55,-190,-135);
	acx_si_check_loaded_count(6,55,-190,-135);
	acx_si_check_loaded_count(7,55,-190,-200);
	// *********************************
	/**************************************************************************
	CONDITIONS ENDING HERE
	***************************************************************************/
	?>
	<script type="text/javascript">
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	var px = document.layers ? "" : "px";
	function JSFX_FloatDiv(id, sx, sy)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		window[id + "_obj"] = el;
		if(d.layers)el.style=el;
		el.cx = el.sx = sx;el.cy = el.sy = sy;
		el.sP=function(x,y){this.style.left=x+px;this.style.top=y+px;};
		el.flt=function()
		{
			var pX, pY;
			pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
			document.documentElement && document.documentElement.clientWidth ? 
			document.documentElement.clientWidth : document.body.clientWidth;
			pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
			document.documentElement.scrollTop : document.body.scrollTop;
			if(this.sy<0) 
			pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
			document.documentElement.clientHeight : document.body.clientHeight;
			this.cx += (pX + this.sx - this.cx)/8;this.cy += (pY + this.sy - this.cy)/8;
			this.sP(this.cx, this.cy);
			setTimeout(this.id + "_obj.flt()", 40);
		}
		return el;
	}
	jQuery( document ).ready(function() {
	JSFX_FloatDiv("divBottomRight", <?php echo $x; ?>, <?php echo $y; ?>).flt();
	});
	</script>
	<?php echo "<!-- Ending Javascript Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
} 	if ($acx_si_display == "auto" || $acx_si_display == "both") 
	{
		add_action('wp_footer', 'acx_load_floating_js',101);
	}
// Starting Footer PBL
function pbl_footer() 
{
	global $acx_si_theme, $acx_si_credit, $acx_si_display , $acx_si_twitter, $acx_si_facebook, $acx_si_youtube, 		
	$acx_si_linkedin, $acx_si_gplus, $acx_si_pinterest, $acx_si_feed;
	//********** CHECKING CREDIT LINK STATUS ******************
	if($acx_si_twitter != "" || $acx_si_facebook != "" || $acx_si_youtube != "" || $acx_si_linkedin != ""  || $acx_si_pinterest != "" || $acx_si_gplus != "" || $acx_si_feed != "")
	{
		if($acx_si_credit == "yes") 
		{ 
			$acx_fsmi_bl_style="text-align:center;color:gray;font-family:arial;font-size:12px;text-decoration:none;";
			echo "<div style='".$acx_fsmi_bl_style."'>";
			$acx_get_url = "http://";
			$acx_get_url .= $_SERVER['HTTP_HOST'];
			$acx_get_url .= $_SERVER['REQUEST_URI'];
			$acx_installation_domain = $_SERVER['HTTP_HOST'];
			$acx_installation_domain = str_replace("www.","",$acx_installation_domain);
			$acx_installation_domain = str_replace(".","_",$acx_installation_domain);
			if($acx_installation_domain == "") { $acx_installation_domain = "not_defined";}
			$x = strlen($acx_get_url);
			if(($x % 10) == 0)
			{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Popular Social Media Wordpress Plugin' style='".$acx_fsmi_bl_style."'>Animated Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Popular Wordpress Development Company' style='".$acx_fsmi_bl_style."'>Acurax Wordpress Development Company</a>";
} else if(($x % 9) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Floating Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Floating Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Blog Design Company' style='".$acx_fsmi_bl_style."'>Acurax Blog Designing Company</a>";
} else if(($x % 8) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Plugin' style='".$acx_fsmi_bl_style."'>Social Media Integration</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Acurax Web Design Company' style='".$acx_fsmi_bl_style."'>Acurax Wordpress Theme Designers</a>";
} else if(($x % 7) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Affordable Website Designer' style='".$acx_fsmi_bl_style."'>Acurax Website Designing Company</a>";
} else if(($x % 6) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='SocialMedia Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Web Development Company' style='".$acx_fsmi_bl_style."'>Acurax Web Development Company</a>";} else if(($x % 5) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Website Redesign Experts' style='".$acx_fsmi_bl_style."'>Acurax Website Redesign Experts</a>";} else if(($x % 4) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Social Profile Design Experts' style='".$acx_fsmi_bl_style."'>Acurax Social Profile Design Experts</a>";
} else if(($x % 3) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Wordpress Development Company' style='".$acx_fsmi_bl_style."'>Acurax Wordpress Development Company</a>";
} else if(($x % 2) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Web Design Company' style='".$acx_fsmi_bl_style."'>Acurax Web Design Company</a>";
} else if(($x % 1) == 0)
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Animated Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Wordpress Development Company' style='".$acx_fsmi_bl_style."'>Acurax Wordpress Development Company</a>";
} else 
{
echo "<a href='http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/' target='_blank' title='Social Media Wordpress plugin' style='".$acx_fsmi_bl_style."'>Social Media Icons</a> Powered by <a href='http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=blink' target='_blank' title='Ecommerce Design Expert' style='".$acx_fsmi_bl_style."'>Acurax E-Commerce Website Design Company</a>";
}
			// Ending Crediting
			echo "</div>";
		} 
	}
} add_action('wp_footer', 'pbl_footer'); // pbl_footer
function extra_style_acx_icon() // updated added class acx_fsmi_float_fix support
{
	global $acx_si_icon_size, $acx_si_fsmi_float_fix, $acx_si_display, $acx_si_fsmi_disable_mobile;
	if($acx_si_fsmi_disable_mobile == "") { $acx_si_fsmi_disable_mobile = "no"; }
		echo "\n\n\n<!-- Starting Styles For Social Media Icon From Acurax International www.acurax.com -->\n<style type='text/css'>\n";
		echo "#divBottomRight img \n{\n";
		echo "width: " . $acx_si_icon_size . "px; \n}\n";
		
			if ($acx_si_display == "manual") 
			{
				echo "#divBottomRight \n{\n";
				echo "min-width:0px; \n";
				echo "position: static; \n}\n";
			}
			if ($acx_si_fsmi_float_fix == "yes") 
			{
				echo ".acx_fsmi_float_fix a \n{\n";
				echo "display:inline-block; \n}\n";
			}
			if($acx_si_fsmi_disable_mobile == "yes")
			{
				echo "@media only screen and (max-width:650px) \n{\n#divBottomRight \n{\n";
				echo "display:none !important; \n}\n}\n";
			}
			
		echo "</style>\n<!-- Ending Styles For Social Media Icon From Acurax International www.acurax.com -->\n\n\n\n";
}	add_action('admin_head', 'extra_style_acx_icon'); // ADMIN
	add_action('wp_head', 'extra_style_acx_icon'); // PUBLIC 
function acx_si_admin_style()  // Adding Style For Admin
{
	echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('style_for_admin.css', __FILE__). '">';
}	add_action('admin_head', 'acx_si_admin_style'); // ADMIN
	$acx_si_display = get_option('acx_si_display');
if	($acx_si_display == "auto" || $acx_si_display == "both") 
{
	add_action('wp_footer', 'acurax_icons',100);
}
$acx_si_sc_id = 0; // Defined to assign shortcode unique id
function DISPLAY_ACURAX_ICONS_SC($atts)
{
	global $acx_si_display, $acx_si_icon_size, $acx_si_sc_id;
	extract(shortcode_atts(array(
	"theme" => '',
	"size" => $acx_si_icon_size,
	"align" => 'center'
	), $atts));
	if($align == "center")
	{
	$align = "center";
	} else if($align == "left")
	{
	$align = "left";
	} else if($align == "right")
	{
	$align = "right";
	} else
	{
	$align = "center";
	}
	if (!is_numeric($theme)) { $theme = ""; } else {
	if ($theme > ACX_SOCIALMEDIA_TOTAL_THEMES) { $theme = ""; }
	}
	if (!is_numeric($size)) { $size = $acx_si_icon_size; } else {
	if ($size > 55) { $size = $acx_si_icon_size; }
	}
	if ($acx_si_display != "auto" || $acx_si_display == "both") 
	{
		$acx_si_sc_id = $acx_si_sc_id + 1;
		ob_start();
		echo "<style>\n";
		echo "#short_code_si_icon img \n {";
		echo "width:" . $size . "px; \n}\n";
		echo ".scid-" . $acx_si_sc_id . " img \n{\n";
		echo "width:" . $size . "px !important; \n}\n";
		echo "</style>";
		echo "<div id='short_code_si_icon' style='text-align:".$align.";' class='acx_fsmi_float_fix scid-" . $acx_si_sc_id . "'>"; // updated
		acurax_si_simple($theme,$size);
		echo "</div>";
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	} 
	else echo "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
} // DISPLAY_ACURAX_ICONS_SC
function DISPLAY_ACURAX_ICONS($theme="",$size="",$align="")
{
		global $acx_si_display, $acx_si_icon_size;
				
	if($align == "center")
	{
	$align = "center";
	} else if($align == "left")
	{
	$align = "left";
	} else if($align == "right")
	{
	$align = "right";
	} else
	{
	$align = "center";
	}
	if (!is_numeric($theme)) { $theme = ""; } else {
	if ($theme > ACX_SOCIALMEDIA_TOTAL_THEMES) { $theme = ""; }
	}
	if (!is_numeric($size)) { $size = $acx_si_icon_size; } else {
	if ($size > 55) { $size = $acx_si_icon_size; }
	}
		
		
	if ($acx_si_display != "auto" || $acx_si_display == "both") 
	{
		echo "\n\n\n<!-- Starting Styles For Social Media Icon (PHP CODE) From Acurax International www.acurax.com 
		-->\n<style 
		type='text/css'>\n";
		echo "#short_code_si_icon img \n{\n";
		echo "width: " . $size . "px; \n}\n";
		echo "</style>\n<!-- Ending Styles For Social Media Icon (PHP CODE) From Acurax International www.acurax.com 
		-->\n\n\n\n";
		echo "<div id='short_code_si_icon' style='text-align:".$align.";'>";
		acurax_si_simple($theme,$size);
		echo "</div>";
	} 
	else echo "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
} // DISPLAY_ACURAX_ICONS
			
function acx_not_auto()
{
	echo "<!-- Select Display Mode as Manual To Show The Acurax Social Media Icons -->";
}
if	($acx_si_display != "auto" || $acx_si_display == "both") 
{
	add_shortcode( 'DISPLAY_ACURAX_ICONS', 'DISPLAY_ACURAX_ICONS_SC' ); // Defining Shortcode to show Social Media Icon
}
else
{
	add_shortcode( 'DISPLAY_ACURAX_ICONS', 'acx_not_auto' ); // Defining Shortcode to show Select Manual
}
function acx_si_custom_admin_js()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
}	add_action( 'admin_enqueue_scripts', 'acx_si_custom_admin_js' );
// wp-admin Notices >> Finish Upgrade
//-- **************** CODE TO FIND PAGE STARTS HERE ********************************
if(ISSET($_GET['page']))
{
$acx_si_current_page = $_GET['page'];
} else
{
$acx_si_current_page = "";
}
//-- **************** CODE TO FIND PAGE ENDS HERE***********************************
$total_arrays = ACX_FSMI_TOTAL_STATIC_SERVICES; // Number Of Services
$social_icon_array_order = get_option('social_icon_array_order');
$social_icon_array_order = unserialize($social_icon_array_order);
$social_icon_array_count = count($social_icon_array_order); 
if ($social_icon_array_count < $total_arrays) 
{
	acx_fsmi_orderarray_refresh();
}
$acx_fsmi_si_current_version = get_option('acx_fsmi_si_current_version');
if($acx_fsmi_si_current_version != ACX_FSMI_C_VERSION) // Current Version
{
	$acx_fsmi_si_current_version = ACX_FSMI_C_VERSION;  // Current Version
	update_option('acx_fsmi_si_current_version', $acx_fsmi_si_current_version);
}
// wp-admin Notices >> Plugin not configured
function acx_si_pluign_not_configured()
{
    echo '<div class="updated">
	<p><b>Congratulations!, You Have Successfully Installed Floating Social Media Icon, The Plugin Is Not Configured - <a href="admin.php?page=Acurax-Social-Icons-Settings">Click Here to Configure</a></b></p></div>';
}
if ($social_icon_array_count == $total_arrays) 
{
if ($acx_si_twitter == "" && $acx_si_facebook == "" && $acx_si_youtube == "" && $acx_si_linkedin == ""  && $acx_si_pinterest == "" && $acx_si_gplus == "" && $acx_si_feed == "")
{
	if($acx_si_current_page != "Acurax-Social-Icons-Settings")
	{
	add_action('admin_notices', 'acx_si_pluign_not_configured',1);
	}
} // Chking If Plugin Not Configured
} // Chking $social_icon_array_count == $total_arrays
// wp-admin Notices >> Plugin not configured
function acx_si_pluign_promotion()
{
$acx_tweet_text_array = array
						(
						"I Use Floating SocialMedia wordpress plugin from @acuraxdotcom and you should too",
						"Floating Social Media wordpress Plugin from @acuraxdotcom is Awesome",
						"Thanks @acuraxdotcom for developing such a wonderful social media wordpress plugin",
						"Actually i am looking for a social media Plugin like this. Thanks @acuraxdotcom",
						"Its very nice to use Floating Social media wordpress Plugin from @acuraxdotcom",
						"I installed Floating Social Media.. from @acuraxdotcom,  It works wonderful",
						"The floating social media icon wordpress plugin looks soo nice.. thanks @acuraxdotcom", 
						"It awesome to use Floating Social Media wordpress plugin from @acuraxdotcom",
						"Floating Social Media wordpress Plugin that i use Looks awesome and works terrific",
						"I am using Floating Social Media Icon wordpress Plugin from @acuraxdotcom I like it!",
						"The socialmedia plugin from @acuraxdotcom Its simple looks good and works fine",
						"Ive been using this social media plugin for a while now and it is attractive",
						"Floating Social Media Icon wordpress plugin is Fantastic Plugin",
						"Floating Social Media Icon wordpress plugin was easy to use and works great. thank you!",
						"Good and flexible wp socialmedia plugin especially for beginners.",
						"Easily the best socialmedia wordpress plugin of the type I have used ! THANKS! @acuraxdotcom",
						);
$acx_tweet_text = array_rand($acx_tweet_text_array, 1);
$acx_tweet_text = $acx_tweet_text_array[$acx_tweet_text];

$acx_si_installed_date = get_option('acx_si_installed_date');
if ($acx_si_installed_date=="") { $acx_si_installed_date = time();}
$acx_fsmi_next_date = get_option('acx_fsmi_next_date');
$acx_fsmi_days_till_today_from_install = time()-$acx_si_installed_date;
$acx_fsmi_days_till_today_from_install = round(($acx_fsmi_days_till_today_from_install/60/60/24))." Days";

global $current_user;
get_currentuserinfo();
$acx_fsmi_current_user = $current_user->display_name;
if($acx_fsmi_current_user == "")
{
$acx_fsmi_current_user = "Webmaster";
}

    echo '<div id="acx_td_fsmi" class="notice">Hey <b>'.$acx_fsmi_current_user.'</b>, Do you know? You were using Floating Social Media Icon Wordpress Plugin for the last <b>'.$acx_fsmi_days_till_today_from_install.'</b>, We are sure, your visitors loved the flying icons.<br>From the bottom of our heart, we the team @ <a href="http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=days" style="font-weight: normal; margin-left: 0px; color: rgb(68, 68, 68);" target="_blank">Acurax Technologies</a> thank you for being with us, and we appreciate your feedback,reviews and support.<br><a href="https://wordpress.org/support/view/plugin-reviews/floating-social-media-icon?filter=5" target="_blank">Rate 5★\'s on wordpress</a><a href="https://twitter.com/share?url=http://www.acurax.com/products/floating-social-media-icon-plugin-wordpress/&text='.$acx_tweet_text.' -" target="_blank">Tell Your Followers</a><a href="admin.php?page=Acurax-Social-Icons-Premium">Premium Version Benefits</a><a href="admin.php?page=Acurax-Social-Icons-Premium&td=hide">Hide for Now</a></div>';
}
$acx_si_installed_date = get_option('acx_si_installed_date');
if ($acx_si_installed_date=="") { $acx_si_installed_date = time();}
$acx_fsmi_d = 30;
$acx_fsmi_d_n = 100;
$acx_fsmi_prom = false;

if(get_option('acx_si_td') == "")
{
	$acx_fsmi_next_date = $acx_si_installed_date+((60*60*24)*$acx_fsmi_d);
	update_option('acx_fsmi_next_date', $acx_fsmi_next_date);
	update_option('acx_si_td', "show");
} else if(get_option('acx_si_td') == "hide")
{
	$acx_fsmi_next_date = time()+((60*60*24)*$acx_fsmi_d_n);
	update_option('acx_fsmi_next_date', $acx_fsmi_next_date);
	update_option('acx_si_td', "show");
}
$acx_fsmi_next_date = get_option('acx_fsmi_next_date');

if(time() > $acx_fsmi_next_date)
{
$acx_fsmi_prom = true;
}
if ($acx_fsmi_prom == true && get_option('acx_si_td') == "show")
{
add_action('admin_notices', 'acx_si_pluign_promotion',1);
}

// Starting Widget Code
class Acx_Social_Icons_Widget extends WP_Widget
{
    // Register the widget
    function Acx_Social_Icons_Widget() 
	{
        // Set some widget options
        $widget_options = array( 'description' => 'Allow users to show Social Media Icons From Floating Social Media Icon 
		Plugin', 'classname' => 'acx-social-icons-desc' );
        // Set some control options (width, height etc)
        $control_options = array( 'width' => 300 );
        // Actually create the widget (widget id, widget name, options...)
         parent::__construct( 'acx-social-icons-widget', 'Acx Social Icons', $widget_options, $control_options );
    }
    // Output the content of the widget
    function widget($args, $instance) 
	{
        extract( $args ); // Don't worry about this
        // Get our variables
        $title = apply_filters( 'widget_title', $instance['title'] );
		$icon_size = $instance['icon_size'];
		$icon_theme = $instance['icon_theme'];
		$icon_align = $instance['icon_align'];
        // This is defined when you register a sidebar
        echo $before_widget;
        // If our title isn't empty then show it
        if ( $title ) 
		{
            echo $before_title . $title . $after_title;
        }
		echo "<style>\n";
		echo "." . $this->get_field_id('widget') . " img \n{\n";
		echo "width:" . $icon_size . "px; \n } \n";
		echo "</style>";
		echo "<div id='acurax_si_simple' class='acx_fsmi_float_fix " . $this->get_field_id('widget') . "'"; // updated
		if($icon_align != "") { echo " style='text-align:" . $icon_align . ";'>"; } else { echo " style='text-align:center;'>"; }
		acurax_si_simple($icon_theme,$icon_size);
		echo "</div>";
        // This is defined when you register a sidebar
        echo $after_widget;
    }
	// Output the admin options form
	function form($instance) 
	{
		$total_themes = ACX_SOCIALMEDIA_TOTAL_THEMES;
		$total_themes = $total_themes + 1;
		// These are our default values
		$defaults = array( 'title' => 'Social Media Icons','icon_size' => '32' );
		// This overwrites any default values with saved values
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
				value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Size:'); ?></label>
<select class="widefat" name="<?php echo $this->get_field_name('icon_size'); ?>" id="<?php echo $this->get_field_id('icon_size'); ?>">
<option value="16" <?php if ($instance['icon_size'] == "16") { echo 'selected="selected"'; } ?>>16px X 16px </option>
<option value="25" <?php if ($instance['icon_size'] == "25") { echo 'selected="selected"'; } ?>>25px X 25px </option>
<option value="32" <?php if ($instance['icon_size'] == "32") { echo 'selected="selected"'; } ?>>32px X 32px </option>
<option value="40" <?php if ($instance['icon_size'] == "40") { echo 'selected="selected"'; } ?>>40px X 40px </option>
<option value="48" <?php if ($instance['icon_size'] == "48") { echo 'selected="selected"'; } ?>>48px X 48px </option>
<option value="55" <?php if ($instance['icon_size'] == "55") { echo 'selected="selected"'; } ?>>55px X 55px </option>
</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_theme'); ?>"><?php _e('Icon Theme:'); ?></label>
<select class="widefat" name="<?php echo $this->get_field_name('icon_theme'); ?>" id="<?php echo $this->get_field_id('icon_theme'); ?>">
<option value="" <?php if(!ISSET($instance['icon_theme'])) { echo 'selected="selected"'; } ?>>Default Theme Design</option>
<?php
for ($i=1; $i < $total_themes; $i++)
{
?>
<option value="<?php echo $i; ?>" <?php if(ISSET($instance['icon_theme'])){if($instance['icon_theme'] == $i) { echo 'selected="selected"'; } }?>>Theme Design <?php echo $i; ?> </option>
<?php
}	?>
</select>
			</p>
<p>
	<label for="<?php echo $this->get_field_id('icon_align'); ?>"><?php _e('Icon Align:'); ?></label>
	<select class="widefat" name="<?php echo $this->get_field_name('icon_align'); ?>" id="<?php echo $this->get_field_id('icon_align'); ?>">
	<option value="" <?php if(!ISSET($instance['icon_align'])) { echo 'selected="selected"'; } ?>>Default </option>
	<option value="left" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "left") { echo 'selected="selected"'; }} ?>>Left </option>
	<option value="center" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "center") { echo 'selected="selected"'; }} ?>>Center </option>
	<option value="right" <?php if(ISSET($instance['icon_align'])){ if($instance['icon_align'] == "right") { echo 'selected="selected"';} } ?>>Right </option>
	</select>
</p>
		<?php
	}
	// Processes the admin options form when saved
	function update($new_instance, $old_instance) 
	{
		// Get the old values
		$instance = $old_instance;
		// Update with any new values (and sanitise input)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_theme'] = strip_tags( $new_instance['icon_theme'] );
		$instance['icon_align'] = strip_tags( $new_instance['icon_align'] );
		return $instance;
	}
} add_action('widgets_init', create_function('', 'return register_widget("Acx_Social_Icons_Widget");'));
// Ending Widget Codes 
function socialicons_comparison($ad=2)
{
$ad_1 = '
</hr>
<a name="compare"></a><div id="ss_middle_wrapper"> 
		<div id="ss_middle_center"> 
			<div id="ss_middle_inline_block"> 
			
				<div class="middle_h2_1"> 
					<h2>Limited on Features ?</h2>
					<h3>Compare and Decide</h3>
				</div><!-- middle_h2_1 -->
				
<div id="ss_features_table"> 
				
					<div id="ss_table_header"> 
						<div class="tb_h1"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
							<div class="tb_h2"> <h3>Features</h3> </div><!-- tb_h2 -->
							<div class="tb_h3"> <div class="ss_download"> </div><!-- ss_download --> </div><!-- tb_h3 -->
						<div class="tb_h4 fsmi_tb_h4"> <a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_fsmi_settings_table&utm_medium=link&utm_campaign=compare_buynow" target="_blank"><div class="ss_buy_now"> </div><!-- ss_buy_now --></a> </div><!-- tb_h4 -->
					</div><!-- ss_table_header -->
						
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 197px;"> Display </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>More Sharp Quality Icons</li>
									<li>20+ Icon Theme/Style</li>
										<li>Can Choose Icon Theme/Style</li>
											<li>Can Choose Icon Size</li>
												<li>Automatic/Manual Integration</li>
													<li>Set MouseOver text for each icon in Share Mode</li>
												<li>Set MouseOver text for each icon in Profile Link Mode</li>
											<li>Option to HIDE Invididual Share Icon</li>
											<li>Option to hide icon on mobile devices</li>
											<li>Option to hide icon on specific pages/post</li>
											<li>Option to set icon size for mobile devices</li>
											<li>Align icons on phpcode or shortcode</li>
										<li><strong>Set Floating Icons in Vertical</strong></li>
									<li><strong>Define how many icons in 1 row</strong></li>
									<li><strong><strong>Add Unlimited # of Custom Icons</strong></strong></li>
								<li class="ss_last_one"><strong>Custom Icons Can Link to Your Website Pages</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_no"> </div><!-- ss_no -->
											<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_yes"> </div><!-- ss_yes -->										
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->
					
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Icon Function </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Link to Social Media Profile</li>
								<li><strong>Share On Social Media</strong></li>
								<li>Option to add twitter username and hashtags to tweets</li>
								<li class="ss_last_one">Option to Define Tweet Prefix and Suffix</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Animation </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Fly Animation</li>
								<li class="ss_last_one"><strong>Mouse Over Effects</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 84px;"> Fly Animation Repeat Interval</div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Based On Time in Seconds</li>
									<li><strong>Based On Time in Minutes</strong></li>
										<li>Based On Time in Hours</li>
									<li>Based on Page Views</li>
								<li class="ss_last_one">Based On Page Views and Time</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Multiple Fly Animation<br/></div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Can Choose Fly Start Position</li>
								<li class="ss_last_one">Can Choose Fly End Position</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->				

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 52px;">Easy to Configure</div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Ajax Based Settings Page</li>
									<li>Drag & Drop Reorder Icons</li>
								<li class="ss_last_one">Easy to Configure</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">Widget Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Widgets</li>
									<li>Separate Icon Style/Theme For Each</li>
										<li>Separate Icon Size For Each</li>
										<li>Set whether the icons to Link Profiles/SHARE</li>
									<li><strong>Separate Mouse Over Multiple Animation for Each</strong></li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">Shortcode Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Instances</li>
									<li>Separate Icon Style/Theme For Each</li>
										<li><strong>Separate Icon Size For Each</strong></li>
										<li>Set whether the icons to Link Profiles/SHARE</li>
									<li>Separate Mouse Over Multiple Animation for Each</li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 126px;">PHP Code Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Instances</li>
									<li>Use Outside Loop</li>
										<li>Separate Icon Style/Theme For Each</li>
											<li>Separate Icon Size For Each</li>
										<li><strong>Set whether the icons to Link Profiles/SHARE</strong></li>
									<li>Separate Mouse Over Multiple Animation for Each</li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->						
					
				
					
				</div><!-- ss_features_table -->		

			<div id="ad_fsmi_2_button_order" style="float: left; width: 100%;">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --></div></div></div>';
$ad_2='<div id="ad_fsmi_2"> <a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_enjoy" target="_blank"><div id="ad_fsmi_2_button"></div></a> </div> <!-- ad_fsmi_2 --><br>
<div id="ad_fsmi_2_button_order">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_fsmi_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --> ';
if($ad=="" || $ad == 2) { echo $ad_2; } else if ($ad == 1) { echo $ad_1; } else { echo $ad_2; } 
} // Updated
function acx_fsmi_saveorder_callback()
{
	global $wpdb;
$social_icon_array_order = $_POST['recordsArray'];
if (current_user_can('manage_options')) {
	$social_icon_array_order = serialize($social_icon_array_order);
	update_option('social_icon_array_order', $social_icon_array_order);
	echo "<div id='acurax_notice' align='center' style='width: 420px; font-family: arial; font-weight: normal; font-size: 22px;'>";
	echo "Social Media Icon's Order Saved";
	echo "</div><script type='text/javascript'>
		 setTimeout(function(){
				jQuery('#acurax_notice').fadeOut('slow');
				
				}, 4000);

		</script><br>";
}
	die(); // this is required to return a proper result
} add_action('wp_ajax_acx_fsmi_saveorder', 'acx_fsmi_saveorder_callback');
function acx_fsmi_quick_form()
{

if(ISSET($_SERVER['HTTP_HOST']))
{
$acx_installation_url = $_SERVER['HTTP_HOST'];
} else
{
$acx_installation_url = "";
}
?>
<div class="acx_fsmi_es_common_raw acx_fsmi_es_common_bg">
	<div class="acx_fsmi_es_middle_section">
    
    <div class="acx_fsmi_es_acx_content_area">
    	<div class="acx_fsmi_es_wp_left_area">
        <div class="acx_fsmi_es_wp_left_content_inner">
        	<div class="acx_fsmi_es_wp_main_head">Do you Need Technical Support Services to Get the Best Out of Your Wordpress Site ?</div> <!-- wp_main_head -->
            <div class="acx_fsmi_es_wp_sub_para_des">Acurax offer a number of WordPress related services: Form installing WordPress on your domain to offering support for existing WordPress sites.</div> <!-- acx_fsmi_es_wp_sub_para_des -->
            <div class="acx_fsmi_es_wp_acx_service_list">
            	<ul>
                <li>Troubleshoot WordPress Site Issues</li>
                    <li>Recommend & Install Plugins For Improved WordPress Performance</li>
                    <li>Create, Modify, Or Customise, Themes</li>
                    <li>Explain Errors And Recommend Solutions</li>
                    <li>Custom Plugin Development According To Your Needs</li>
                    <li>Plugin Integration Support</li>
                    <li>Many <a href="http://wordpress.acurax.com/?utm_source=fsmi&utm_campaign=expert_support" target="_blank">More...</a></li>
               </ul>
            </div> <!-- acx_fsmi_es_wp_acx_service_list -->
            
   <div class="acx_fsmi_es_wp_send_ylw_para">We Have Extensive Experience in WordPress Troubleshooting,Theme Design & Plugin Development.</div> <!-- acx_fsmi_es_wp_secnd_ylw_para-->
   
        </div> <!-- acx_fsmi_es_wp_left_content_inner -->
        </div> <!-- acx_fsmi_es_wp_left_area -->
        
        <div class="acx_fsmi_es_wp_right_area">
        	<div class="acx_fsmi_es_wp_right_inner_form_wrap">
            	<div class="acx_fsmi_es_wp_inner_wp_form">
                <div class="acx_fsmi_es_wp_form_head">WE ARE DEDICATED TO HELP YOU. SUBMIT YOUR REQUEST NOW..!</div> <!-- acx_fsmi_es_wp_form_head -->
                <form class="acx_fsmi_es_wp_support_acx">
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_right"><input type="text" placeholder="Name*" id="acx_name"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_left"><input type="email" placeholder="Email*" id="acx_email"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_right"><input type="text" placeholder="Phone Number*" id="acx_phone"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input acx_fsmi_es_half_width_sec acx_fsmi_es_haif_marg_left"><input type="text" placeholder="Website URL*" value="<?php echo $acx_installation_url; ?>" id="acx_weburl"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><input type="text" placeholder="Subject*" id="acx_subject"></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><textarea placeholder="Question*" id="acx_question"></textarea></span> <!-- acx_fsmi_es_cnvas_input -->
                <span class="acx_fsmi_es_cnvas_input"><input class="acx_fsmi_es_wp_acx_submit" type="button" value="SUBMIT REQUEST" onclick="acx_quick_fsmi_request_submit();"></span> <!-- acx_fsmi_es_cnvas_input -->
                </form>
                </div> <!-- acx_fsmi_es_wp_inner_wp_form -->
            </div> <!-- acx_fsmi_es_wp_right_inner_form_wrap -->
        </div> <!-- acx_fsmi_es_wp_left_area -->
    </div> <!-- acx_fsmi_es_acx_content_area -->
    
    <div class="acx_fsmi_es_footer_content_cvr">
    <div class="acx_fsmi_es_wp_footer_area_desc">Its our pleasure to thank you for using our plugin and being with us. We always do our best to help you on your needs. If you like to hide this menu, you can do so at <a href="admin.php?page=Acurax-Social-Icons-Misc">Misc</a> page which is under our plugin options.</div> <!--acx_fsmi_es_wp_footer_area_desc -->
    </div> <!-- acx_fsmi_es_footer_content_cvr -->
    
    </div> <!-- acx_fsmi_es_middle_section -->
</div> <!--acx_fsmi_es_common_raw -->
<script type="text/javascript">
var request_acx_form_status = 0;
function acx_quick_form_reset()
{
jQuery("#acx_subject").val('');
jQuery("#acx_question").val('');
}
acx_quick_form_reset();
function acx_quick_fsmi_request_submit()
{
var acx_name = jQuery("#acx_name").val();
var acx_email = jQuery("#acx_email").val();
var acx_phone = jQuery("#acx_phone").val();
var acx_weburl = jQuery("#acx_weburl").val();
var acx_subject = jQuery("#acx_subject").val();
var acx_question = jQuery("#acx_question").val();
var order = '&action=acx_quick_fsmi_request_submit&acx_name='+acx_name+'&acx_email='+acx_email+'&acx_phone='+acx_phone+'&acx_weburl='+acx_weburl+'&acx_subject='+acx_subject+'&acx_question='+acx_question+'&acx_fsmi_es=<?php echo wp_create_nonce("acx_fsmi_es"); ?>'; 
if(request_acx_form_status == 0)
{
request_acx_form_status = 1;
jQuery.post(ajaxurl, order, function(quick_request_acx_response)
{
if(quick_request_acx_response == 1)
{
alert('Your Request Submitted Successfully!');
acx_quick_form_reset();
request_acx_form_status = 0;
} else if(quick_request_acx_response == 2)
{
alert('Please Fill Mandatory Fields.');
request_acx_form_status = 0;
} else
{
alert('There was an error processing the request, Please try again.');
acx_quick_form_reset();
request_acx_form_status = 0;
}
});
} else
{
alert('A request is already in progress.');
}
}
</script>
<?php 
}
function acx_quick_fsmi_request_submit_callback()
{
	
	$acx_name =  $_POST['acx_name'];
	$acx_email =  $_POST['acx_email'];
	$acx_phone =  $_POST['acx_phone'];
	$acx_weburl =  $_POST['acx_weburl'];
	$acx_subject =  $_POST['acx_subject'];
	$acx_question =  $_POST['acx_question'];
	$acx_fsmi_es = $_POST['acx_fsmi_es'];
	if (!wp_verify_nonce($acx_fsmi_es,'acx_fsmi_es'))
	{
	$acx_fsmi_es == "";
	}
	if(!current_user_can('manage_options'))
	{
	$acx_fsmi_es == "";
	}
if($acx_fsmi_es == "" || $acx_name == "" || $acx_email == "" || $acx_phone == "" || $acx_weburl == "" || $acx_subject == "" || $acx_question == "")
{
echo 2;
} else
{
$current_user_acx = wp_get_current_user();
$current_user_acx = $current_user->user_email;
if($current_user_acx == "")
{
$current_user_acx = $acx_email;
}
$headers[] = 'From: ' . $acx_name . ' <' . $current_user_acx . '>';
$headers[] = 'Content-Type: text/html; charset=UTF-8'; 
$message = "Name: ".$acx_name . "\r\n <br>";
$message = $message . "Email: ".$acx_email . "\r\n <br>";
if($acx_phone != "")
{
$message = $message . "Phone: ".$acx_phone . "\r\n <br>";
}
// In case any of our lines are larger than 70 characters, we should use wordwrap()
$acx_question = wordwrap($acx_question, 70, "\r\n <br>");
$message = $message . "Request From: FSMI - Expert Help Request Form \r\n <br>"; 
$message = $message . "Website: ".$acx_weburl . "\r\n <br>";
$message = $message . "Question: ".$acx_question . "\r\n <br>";
$message = stripslashes($message);
$acx_subject = "Quick Support - " . $acx_subject;
$emailed = wp_mail( 'info@acurax.com', $acx_subject, $message, $headers );
if($emailed)
{
echo 1;
} else
{
echo 0;
}
}
	die(); // this is required to return a proper result
}add_action('wp_ajax_acx_quick_fsmi_request_submit','acx_quick_fsmi_request_submit_callback');
?>