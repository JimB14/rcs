<?php
session_start();
 
// execute upon submission
if(isset($_POST['submit']));
{ 
    // declare variables
    $errMsg = '';
    $dsn = 'localhost';
    $username = '';
    $password = '';
    $db = 'riverc17_db01';
    
    // get data from login form and pass thru security functions
    if(isset($_POST['username']) && isset($_POST['password']))
    {  
        // check for empty fields
        if(empty($username))
            $errMsg .= '* You must enter your username.<br>';
        
        if(empty($password))
            $errMsg .= '* You must enter your password.<br>';
        
        // pass data through security filters
        $username = addslashes(strip_tags($_POST['username']));
        $password = addslashes(strip_tags($_POST['password']));
        
        // to check username & password after security functions
        // if connection fails, otherwise changing URL
        //echo $username . '<br>'; 
        //echo $password . '<br>';
        
        try
        {
            $pdo = new PDO("mysql:host=$dsn;dbname=$db", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $_SESSION['username'] = $username;
            header('location: ../dashboard/');
            exit();
        }
        catch (PDOException $e)
        {
            $errMsg = 'Connection failed.<br>';   // $errMsg = 'Connection failed: ' . $e->getMessage() . '<br>';
        }        
    }
}
    
$title = 'Login-Admin' ;        
$description = '';
$menuid = '';
require '../includes/header.php';
require '../includes/menu.php';   
?>

<script>window.onload=function(){document.getElementById('username').focus();};</script>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Login Admin</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-4  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div class="">                           
                               <div class="login p16">                                  
                                   <?php
                                        if(isset($errMsg)){
                                        echo '<div class="margin-left150" style="color:#FF0000;text-align:left;font-size:12px;">'.$errMsg.'</div>';
                                        }
                                      ?>
                                   <form action="" method="post">
                                       <label>Username:</label>
                                       <input type="text" name="username" id="username"><br>

                                       <label>Password:</label>
                                       <input type="password" name="password" ><br>

                                       <label>&nbsp;</label>
                                       <button class="btn-default btn2b margin-right50" type="submit" name="login">Login</button>
                                   </form>
                               </div>
                        </div>
                    </div>
                </div>
            </div>
 <div class="clearfix"></div>
   </div>
    </div>
</div>    

<?php require '../includes/footer.php'; ?>