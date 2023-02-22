<?php
//initialize the variables needed for this page.
$VariableArray = array('UserName','Password');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
GetVariables($VariableArray);

if(isset($UserName) && isset($Password))
{
    //Sanitize($UserName);
    //Sanitize($Password);
    
    $LoginUser = $MainConnection->query("
    SELECT UserID, RoleID, FirstName ||\" \"|| LastName AS Name, Admin
    FROM Users
    WHERE UserName = '$UserName' AND Password = '$Password'
    LIMIT 1");

    $row = $LoginUser->fetchAssociative();
    
    if($row != NULL)
    {
        $_SESSION['UserLoggedIn'] = 'Yes';
        $_SESSION['TheUser'] = $row['UserID'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['UserRole'] = $row['RoleID'];
        $_SESSION['IsAdmin'] = $row['Admin'];
        
        header("location: $ApplicationNonSecureRoot"."$ThisDirectory".'/');
    }
    else
    {
        $_SESSION['UserLoggedIn'] = 'No';
        $Message='<p class="AlertText" style="text-align: center;">* Login Failed. Please try again. *</p>';
    }
}
?>