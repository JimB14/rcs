<?php
session_start(); 

// parameters of session
include '../connect/session-time.php';

//error_reporting(E_ALL ^ E_NOTICE);

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

       
    //DB configuration Constants
    define('hostname', 'localhost');
    define('name', 'riverc17_admin');
    define('pass', '$ecurity2015!');
    define('dbname', 'riverc17_db01');
    $errMsg = '';
    
    //PDO Database Connection
    try 
        {  
            $pdo = new PDO('mysql:host='. hostname .';dbname='.dbname,name,pass); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // to check database connection 
            //$errMsg = 'Connection established!';
            //include '../connect/output.html.php';
            //echo $hashed_password . '<br>';
            //echo $username;
                       
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
    catch(PDOException $e) 
        {
            $errMsg = 'Unable to connect to the database server: ' . $e->getMessage();
            //exit();
        }
    //$pdo = null; 
}
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