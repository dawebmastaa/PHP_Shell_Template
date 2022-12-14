<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
    //initialize the variables needed for this page.
    $VariableArray = array('Operation');
    
    //pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
    GetVariables($VariableArray);
    
    $Message='';
    
    if($Operation && $Operation == 'Edit User')
    {
        $VariableArray = array('UserID');
        GetVariables($VariableArray);
        
        if(isset($UserID))
        {
            $GetUser = mysqli_query($MainConnection,"
            SELECT *
            FROM Users
            WHERE UserID = $UserID
            LIMIT 1");
            
            $RecordCount = mysqli_num_rows($GetUser);
            
            if($RecordCount > 0)
            {
                $Message .= '<span class="AlertText">Update user below and then click \'Update User\'.</span><br />';
                $row1 = mysqli_fetch_object($GetUser);
            }
            else
            {
                $Message .= '<span class="AlertText">Something went wrong - couldn\'t retrieve user information.</span><br />';
            }
        }
    }
    
    if($Operation && $Operation == 'Update User')
    {
        $VariableArray = array('UserID', 'FirstName', 'LastName', 'UserName', 'Password', 'EmailAddress', 'RoleID');
        GetVariables($VariableArray);
        
        if(isset($UserID))
        {
            if(isset($RoleID) && $RoleID == '1'){$Admin = 'Y';}else{$Admin = 'N';}
            
            //first figure out the fields we need to update, and their values
            $UpdateSyntax = 'SET FirstName = \''.$FirstName.'\'';
            $UpdateSyntax = $UpdateSyntax.=', LastName = \''.$LastName.'\'';
            $UpdateSyntax = $UpdateSyntax.=', EmailAddress = \''.$EmailAddress.'\'';
            $UpdateSyntax = $UpdateSyntax.=', UserName = \''.$UserName.'\'';
            
            if($Password)
            {
                $UpdateSyntax = $UpdateSyntax.=', Password = PASSWORD(\''.$Password.'\')';
            }
            
            $UpdateSyntax = $UpdateSyntax.=', RoleID = '.$RoleID;
            $UpdateSyntax = $UpdateSyntax.=', Admin = \''.$Admin.'\'';
            
            $UpdateUser = mysqli_query($MainConnection,"
            UPDATE Users
            $UpdateSyntax
            WHERE UserID = $UserID");
            
            $UserUpdated = mysqli_affected_rows($MainConnection);
            
            if(!empty($UserUpdated))
            {
                $Message = $Message.'<span class="AlertText">User has been updated.</span><br />';
            }
            else
            {
                $Message=$Message.'<span class="AlertText">Something went wrong - user could not be updated.</span><br />';
            }
        }
    }
    
    if($Operation && $Operation == 'Delete User')
    {
        $VariableArray = array('UserID');
        GetVariables($VariableArray);
        
        if(isset($UserID))
        {            
            $DeleteUser = mysqli_query($MainConnection,"
            DELETE FROM Users
            WHERE UserID = $UserID
            LIMIT 1");
            
            $UserDeleted = mysqli_affected_rows($MainConnection);
            
            if(!empty($UserDeleted))
            {
                $Message = $Message.'<span class="AlertText">User has been deleted.</span><br />';
            }
            else
            {
                $Message=$Message.'<span class="AlertText">Something went wrong - user could not be deleted.</span><br />';
            }
        }
    }
    
    $GetUserRoles = mysqli_query($MainConnection,"
    SELECT RoleID, Role
    FROM UserRoles
    ORDER BY RoleID DESC");
    
    $GetUsers = mysqli_query($MainConnection,"
    SELECT UserID, FirstName, LastName
    FROM Users
    ORDER BY LastName");
}
?>