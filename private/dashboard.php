<?php
session_start(); 

// parameters of session
include '../connect/session-time-admin.php';
include_once '../connect/database-connect.php';
    
// execute UPDATE password        
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
              WHERE username = '$username'
              ";

    // Prepare statement
    $stmt = $pdo->prepare($query);  

    // Execute query
    $stmt->execute();

    // display message of success
    echo  "<span style=color:#fff;>" . "&nbsp; &nbsp;" . $stmt->rowCount()  .  " Password UPDATED successfully!</span>";
}
$pdo = null;

$title = 'Dashboard' ;        
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
                                <div style="background-color:#006D9C; color:#FFF; padding:3px;"><b> Update Password</b></div>
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