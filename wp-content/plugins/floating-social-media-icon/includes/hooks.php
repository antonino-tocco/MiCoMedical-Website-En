<?php
function acx_fsmi_hook_function($function_name)
{
	if($function_name!="")
	{
		if(function_exists($function_name))
		{
			$function_name();	
		}
	}
}
function acx_fsmi_hook_sidebar_widget()
{
	do_action('acx_fsmi_hook_sidebar_widget');
}
?>