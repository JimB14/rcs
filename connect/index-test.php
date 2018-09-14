<?php

session_start(); 

// parameters of session
include 'session-time.php';
    
// connect to database
include 'database-connect.php';

if(isset($_POST['login']));
// hide inconsequential error notice:  Notice: Undefined variable: username in C:\xampp\htdocs\RiverCitySecurity.com\connect\index.php on line 31
error_reporting(E_ALL ^ E_NOTICE);
$errMsg = '';
{       
    // get data from login form and pass thru security functions
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = addslashes(strip_tags($_POST['username']));
        $password = addslashes(strip_tags($_POST['password']));
        
        // hash password
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    
    // to check username & password after security functions
    //echo $username . '<br>'; 
    //echo $password . '<br>';
    
    // check for empty fields
    if(empty($username))
        $errMsg .= '* You must enter your username.<br>';
      //  include 'output.html.php';
    
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
                header('location: ../private/forms.php');
                exit();
            }
            else 
            {
                $errMsg = 'Access denied. <br> Username and Password not found.<br>';
              //  include 'output.html.php';
                
                // close mySQL database connection
                //$pdo = null;
            }    
     }     
 }



$title = 'Login' ;        
$description = '';
$menuid = '';
require '../includes/header.php';
require '../includes/menu.php';  
?>


<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Login</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                         <?php
                            if(isset($errMsg)){
                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                            }
                          ?>
                        <div class="login p16">
                            <form action="" method="post">
                                <label>Username:</label>
                                <input type="text" name="username" id="username">
                                <br>
                                <label>Password:</label>
                                <input type="password" name="password" >
                                <br>
                                <label>&nbsp;</label>
                                <button type="submit" name="login">Log in</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
 <div class="clearfix"></div>
   </div>
    </div>
</div>    

<?php
    require '../includes/footer.php';
?>