<?php
session_start(); 

// parameters of session
include '../connect/session-time.php';
    
// connect to database
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
            $errMsg = 'Connection established!';
            include '../connect/output.html.php';
        } 
    catch(PDOException $e) 
        {
            $errMsg = 'Unable to connect to the database server: ' . $e->getMessage();
            include '../connect/output.html.php';
            exit();
        }
      

if(isset($_POST['submit']));
// hide inconsequential error notice:  Notice: Undefined variable: username in C:\xampp\htdocs\RiverCitySecurity.com\connect\index.php on line 31
//error_reporting(E_ALL ^ E_NOTICE);
$errMsg = '';
{       
    // get data from login form and pass thru security functions
    //if(isset($_POST['username']) && isset($_POST['password']))
    if(!empty($_POST['username']) || !empty($_POST['password']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // hash password
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // display hashed-password
        //echo 'Hashed password: ' . $hashed_password . '<br>';
        //echo 'Username: ' . $username;
    }
    // check for empty fields
    if(empty($username))
        $errMsg .= '* You must enter your username.<br>';
    
    if(empty($password))
        $errMsg = '* You must enter your password.<br>';

    // verify username and password against database
    if($errMsg == '')
    {
        $records = $pdo->prepare('SELECT id,username,password FROM register WHERE username = :username AND password = :password');
        $records->bindParam(':username', $username);
        $records->bindParam(':password', $password);
        $records->execute();
        
        $count = $records->rowCount();
        $row = $records->fetch();
            if($count == 1)
            {
                $_SESSION['username'] = $username;
                header('location: insert-password.php');
                exit();
            }
            else 
            {
                $errMsg = 'Access denied. <br> Username and Password not found.<br>';
            }    
     }     
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
                <div style="background-color:#006D9C; color:#FFFFFF; padding:3px;"><b>Login to Database</b></div>
                <div style="margin:30px">
                    <form action="" method="post">
                        <label>Username  :</label><input type="text" name="username" /><br /><br />
                        <label>Password  :</label><input type="password" name="password"  /><br/><br />
                        <input type="submit" name='submit' value="Submit" class='submit'/><br />
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
