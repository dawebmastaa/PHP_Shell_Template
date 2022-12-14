<?php
//read in the variables array, and hack off the specified number of characters from the beginning of the name
function FixVariables($VariableArray)
{
	global $NumCharacters;
	
	foreach($VariableArray as $var)
	{
		$$var = substr($var,$NumCharacters);
		global $$var;
	}
	extract($_REQUEST,EXTR_IF_EXISTS);
	$var = substr($var,$NumCharacters);
}


function TrimArray(&$value)
{	
	global $ReplaceString;
	
	$value = str_replace($value, $ReplaceString, '');
}
?>
