<?php
session_start(); 

// parameters of session
include '../connect/session-time.php';
include '../database-connect2.php'; 
        
// execute inserting new password        
if(isset($_POST['submit']))
{

    if(isset($_POST['username']) && isset($_POST['new_password']))
    {
        $username       = trim($_POST['username']);
        $new_password   = trim($_POST['new_password']);

        // hash password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // display hashed-password
        //echo 'Hashed password: ' . $hashed_password . '<br>';
        //echo 'Username: ' . $username;
    }
    
    // Query
    $query = "UPDATE register
              SET password = '$hashed_password'
              WHERE username = '$username'";

    // Prepare statement
    $stmt = $pdo->prepare($query);  

    // Execute query
    $stmt->execute();

    // display message of success
    echo $stmt->rowCount() . " password UPDATED successfully!";
}
$pdo = null;
?>

<html>
    <head><title></title></head>
    <body>
        <div align="center">
            <div style="width:300px; border: solid 1px #006D9C; " align="left">
                <?php
                if(isset($errMsg)){
                echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                }
                ?>
                <div style="background-color:#006D9C; color:#FFFFFF; padding:3px;"><b>Insert New Password</b></div>
                <div style="margin:30px">
                    <form action="" method="post">
                        <label>Username  :</label><br><input type="text" name="username" /><br><br>
                        <label>Current Password  :</label><input type="text" name="current_password" placeholder="not required" /><br><br>
                        <label>New Password  :</label><input type="text" name="new_password"  /><br><br>
                        <input type="submit" name='submit' value="Submit" class='submit'/><br>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>