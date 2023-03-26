<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && ($_SESSION['UserRole'] == '1' || $_SESSION['UserRole'] == '3'))
{
  //initialize the variables needed for this page (we name the submit button on the forms 'Operation' and use it for the switch).
    $VariableArray = array('Operation','Message','ThePages');

  //pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
  GetVariables($VariableArray);
}
?>
