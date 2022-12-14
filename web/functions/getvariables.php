<?php
//read in the variables array, create a global with the name of the array value, and extract those variables from the request scope
function GetVariables($VariableArray)
{
	foreach($VariableArray as $var)
	{
		global $$var;
	}
	extract($_REQUEST,EXTR_IF_EXISTS);
}

//these strip a certain number of characters from the beginning of an array (like POST for example).
function TrimArray(&$value,&$key,$StripCharacters)
{			
	$key = substr_replace($key, '',0,$StripCharacters);
	if(!empty($value))
	{
		global $$key;
		$$key = $value;
	}
	
}

function FixArray($VariableArray,$StripCharacters)
{
	$NewArray = Array();
	foreach($VariableArray as $var)
	{
		if(isset($_REQUEST[$var]))
		{
			$NewArray[$var] = $_REQUEST[$var];
			unset($_REQUEST[$var]);
		}
	}
	array_walk($NewArray, 'TrimArray',$StripCharacters); 
}
?>
