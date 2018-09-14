<?php

// execute inserting new password 
if(isset($_POST['update_password']))
{   
    $errMsg         = '';
    $status         = 'OK';
    $username       = trim($_POST['username']);
    $password       = trim($_POST['password']);
    $password2      = trim($_POST['password2']);

    if(!empty($username) && strlen($username) < 6 || strlen($username) > 10)
    {
        $errMsg .= "* Username must be 6 - 10 alphanumeric characters. <br>";
        $status = 'NOTOK';
    }
    // check that password includes alphanumeric characters only
    if(!ctype_alnum($password) || !ctype_alnum($password2)) {                 // ctype_alnum() checks if all of the characters in the provided string, text, are alphanumeric. 
        $errMsg .= "* Password must contain alphanumeric characters only.<br>";
        $status = "NOTOK";
    }    
    if(strlen($password) >= 1 && strlen($password) < 6 || strlen($password) > 10)
    {
        $errMsg .= "* Password must be 6 - 10 alphanumeric characters. <br>";
        $status = 'NOTOK';
    } 
    if(strlen($password2) >= 1 && strlen($password2) < 6 || strlen($password2) > 10)
    {
        $errMsg .= "* Password must be 6 - 10 alphanumeric characters. <br>";
        $status = 'NOTOK';
    } 
    if(empty($password) || empty($password2))
    {
        $errMsg .= "* Enter password in both fields. <br>";
        $status = 'NOTOK';
    }  
    if(!empty($password) && !empty($password2) && $password !== $password2)
    {
        $errMsg .= "* Passwords do not match. <br>";
        $status = 'NOTOK'; 
    }
    if($status != 'OK')
    {
        $errMsg .= "-- Unable to update password. Try again. --<br>";
    }  
    else 
    {
        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        try
        {
            $sql = $pdo->prepare("UPDATE register SET password = :password WHERE username = :username");
            $sql->bindParam(':password', $password, PDO::PARAM_STR);
            $sql->bindParam(':username', $username, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->execute())
                $errMsg .= "* Password for user " . $username . " UPDATED succesfully! <br>";                          
        } 
        catch (PDOException $e)
        {
            $errMsg .= "Unable to update password. " . $e->getMessage();
            exit();
        }
    }
}       
?>
