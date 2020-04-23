<?php
//initialize the variables needed for this page.
$VariableArray = array('UserName','Password');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
GetVariables($VariableArray);

if(isset($UserName) && isset($Password))
{
    $UserName = mysqli_real_escape_string($MainConnection,$UserName);
    $Password = mysqli_real_escape_string($MainConnection,$Password);
    
    $LoginUser=mysqli_query($MainConnection,"
    SELECT UserID, RoleID, concat(FirstName,' ',LastName) AS Name, Admin
    FROM Users
    WHERE UserName = '$UserName' AND Password = password('$Password')
    LIMIT 1");
    
    if(mysqli_num_rows($LoginUser) === 1)
    {
        $row = mysqli_fetch_object($LoginUser);
        $_SESSION['UserLoggedIn'] = 'Yes';
        $_SESSION['TheUser'] = $row->UserID;
        $_SESSION['Name'] = $row->Name;
        $_SESSION['UserRole'] = $row->RoleID;
        $_SESSION['IsAdmin'] = $row->Admin;
        
        header("location: $ApplicationNonSecureRoot"."$ThisDirectory".'/');
    }
    else
    {
        $_SESSION['UserLoggedIn'] = 'No';
        $Message='<p class="AlertText" style="text-align: center;">* Login Failed. Please try again. *</p>';
    }
}
?>