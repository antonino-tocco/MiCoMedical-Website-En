<?php
$td_get = "";
if(ISSET($_GET['td']))
{
$td_get = $_GET['td'];
}
if($td_get == 'hide') 
{
update_option('acx_si_td', "hide");
?>
<style type='text/css'>
#acx_td_fsmi
{
display:none;
}
</style>

<div class="error" style="background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
Thanks again for using the plugin.
</div>
<?php
}
?>
<div style='background: none repeat scroll 0% 0% white; height: 100%; display: inline-block; padding: 8px; margin-top: 5px; border-radius: 15px; min-height: 450px; width: 98%;'>
<?php
socialicons_comparison(1);
?>
</div>