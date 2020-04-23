<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] === '1')
{
    //initialize the variables needed for this page.
    $VariableArray = array('Operation');
    
    //pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
    GetVariables($VariableArray);
    
    $Message='';
    
    if($Operation && $Operation == 'Add User')
    {
        $VariableArray = array('FirstName', 'LastName', 'UserName', 'Password', 'EmailAddress', 'RoleID');
        GetVariables($VariableArray);
        
        if(isset($RoleID) && $RoleID == '1'){$Admin = 'Y';}else{$Admin = 'N';}
        
        if(!empty($FirstName) && !empty($LastName) && !empty($UserName) && !empty($Password) && !empty($EmailAddress) && !empty($RoleID))
        {
            $AddUser = mysqli_query($MainConnection,"
            INSERT INTO Users (FirstName, LastName, UserName, Password, EmailAddress, Admin, RoleID)
            VALUES ('$FirstName', '$LastName', '$UserName', PASSWORD('$Password'), '$EmailAddress', '$Admin', '$RoleID')");
            
            $NewUserID = mysqli_insert_id($MainConnection);
            
            if(!empty($NewUserID))
            {
                $Message=$Message.'<p class="AlertText">New user has been added.</p>';
            }
            else
            {
                $Message=$Message.'<p class="AlertText">An error occurred, user could not be added.</p>';
            }
        }
        else
        {
            $Message=$Message.'<p class="AlertText">An error occurred, be sure you have filled in all the fields.</p>';
        }
    }
    
    $GetUserRoles = mysqli_query($MainConnection,"
  	SELECT RoleID, Role
  	FROM UserRoles
  	ORDER BY RoleID DESC");
}
?>