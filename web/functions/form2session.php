<?php
//read in the variables array, and make session variables out of them so we can remember them.
function Form2Session($VariableArray)
{
	foreach($VariableArray as $Variable)
	{
		global $$Variable;
		//session_register($Variable);
		$_SESSION[$Variable] = $$Variable;
	}
}
?>