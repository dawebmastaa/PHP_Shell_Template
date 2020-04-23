<?php
//initialize the variables (url or submitted parameters) needed for this page.
$VariableArray = array('ImageName');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
GetVariables($VariableArray);

if (@fopen($ImageURL.'images/'.$ImageName, "r"))
{
    echo('<a href="#"><img src="'.$ImageURL.'images/'.$ImageName.'" class="ResortImage" onclick="document.getElementById(\'ShowBigImage\').innerHTML = \'loading image ... please wait\'; changeStyle(\'ShowBigImage\',\'display\',\'none\'); changeStyle(\'ShowImages\',\'display\',\'block\'); return false;" /></a><br /><span class="AlertText" style="font-weight: bold; padding-left: 50px;">Click the image to go back</span>');
}
else
{
	echo('<p class="AlertText">Could not locate image file.</p><h2 class="AlertText">No, Really, Can\'t find it<br /> Session Variable: '.$_SESSION['SessionReturn'].'</h2>');
	$_SESSION['SessionReturn'] .= '1 and ';
}
?>