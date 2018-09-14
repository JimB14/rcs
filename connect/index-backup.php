<?php
session_start(); 

// parameters of session
include '../connect/session-time.php';
    
// connect to database
include '../connect/database-connect.php';

if(isset($_POST['login']));
{
    $errMsg = '';
   
    if(isset($_POST['username']) && isset($_POST['password']));
    {        
        // get data from login form and pass thru security functions
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        echo $username . ' ' . $password;

        // check for empty fields
        if(empty($username))
            $errMsg .= '* You must enter your username.<br>';
            //include '../connect/output.html.php';

        if(empty($password))
            $errMsg .= '* You must enter your password.<br>';

        // verify username and password against database
        if($errMsg == '')
        {
            $stmt = $pdo->prepare('SELECT id,username,password FROM register WHERE username = :username');
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 

            if(count($results) > 0 && password_verify($password, $results['password']))
            {
                $_SESSION['username'] = $results['username'];
                header('location: forms.php');
                exit();
            }     
        else 
            {
                $errMsg = 'Access denied. <br> Username and Password not found.<br>';
                // close mySQL database connection
                //$pdo = null;
            }
        }
    }
}       

    $title = 'Login' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<script>window.onload=function(){document.getElementById('username').focus();};</script>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Login</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                 <!--       <em><span class="fa fa-group"></span></em> -->
                         <?php
                            if(isset($errMsg)){
                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                            }
                          ?>
                        <div class="login p16 margin-right110">
                            <form action="" method="post">
                                <label>Username:</label>
                                <input type="text" name="username" id="username">
                                <br>
                                <label>Password:</label>
                                <input type="password" name="password" >
                                <br>
                                <label>&nbsp;</label>
                                <button class="btn-default btn2b" type="submit" name="login">Login</button> 
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