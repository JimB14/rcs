<?php
session_start(); 

// parameters of session
include '../connect/session-time.php';
include_once '../connect/database-connect.php';
    
if(isset($_POST['submit']));
{
    if(isset($_POST['username'],$_POST['password']))
    {
        $errMsg = '';
        $hash = '';

        // check for empty fields
        if(empty($username))
            $errMsg .= '* You must enter your username.<br>';

        if(empty($password))
        $errMsg = '* You must enter your password.<br>';
        
        // collect data from form
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // validate password against entry
        if(password_verify('$password', $hash))
        {
            echo 'Password is valid .  <br>';
        }
        else 
       {
            echo 'Invalid password . <br>';
       }          
        // display hashed-password
        echo 'Hashed password: ' . $hash . '<br>';
        echo 'Username: ' . $username;

        // verify username and password against database
        if($errMsg == '')
        {
            $records = $pdo->prepare('SELECT id,username,password FROM register WHERE username = :username AND password = :password');
            $records->bindParam(':username', $username);
            $records->bindParam(':password', $hash);
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
 }
 
 $pdo = null;

    $title = 'Change Password' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<script>window.onload=function(){document.getElementById('username').focus();};</script>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Dashboard</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div align="center">
                            <div style="width:300px; border: solid 1px #006D9C; " align="left">
                                <?php
                                if(isset($errMsg)){
                                echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                }
                                ?>
                                <div style="background-color:#006D9C; color:#FFFFFF; padding:3px;"><b> Update Password</b></div>
                                <div style="margin:30px">
                                    <form action="" method="post">
                                        <label>Username  :</label>
                                        <input type="text" name="username" /><br><br>
                                        <label>New Password  :</label>
                                        <input type="password" name="new_password"  /><br><br>
                                        <input type="submit" name='submit' value="Update" class='submit'/><br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="clearfix"></div>
        </div>
    </div>
</div>    

<?php require '../includes/footer.php';?>