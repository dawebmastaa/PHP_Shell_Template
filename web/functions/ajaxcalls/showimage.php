<?php
//initialize the variables (url or submitted parameters) needed for this page.
//$VariableArray = array('ImageName');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
//GetVariables($VariableArray);

echo('<p class="AlertText">Could not locate image file.</p><h2 class="AlertText">No, Really, Can\'t find it<br /> Session Variable: '.$_SESSION['SessionReturn'].'</h2>');
$_SESSION['SessionReturn'] .= '1 and ';

?>