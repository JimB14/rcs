<?php
session_start();
//DB configuration Constants
define('_HOST_NAME_', 'localhost');
define('_USER_NAME_', 'jburns14');
define('_DB_PASSWORD', 'hopehope1');
define('_DATABASE_NAME_', 'rcs_1');
//PDO Database Connection
try {
$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
$databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();
}
if(isset($_POST['submit'])){
$errMsg = '';
//username and password sent from Form
$username = trim($_POST['username']);
$password = trim($_POST['password']);
if($username == '')
$errMsg .= 'You must enter your Username<br>';
if($password == '')
$errMsg .= 'You must enter your Password<br>';
if($errMsg == ''){
$records = $databaseConnection->prepare('SELECT id,username,password FROM employee WHERE username = :username');
$records->bindParam(':username', $username);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
if(count($results) > 0 && password_verify($password, $results['password'])){
$_SESSION['username'] = $results['username'];
header('location:forms.php');
exit;
}else{
$errMsg .= 'Username and Password are not found<br>';
}
}
}
 
$title = 'Login' ;        
$description = '';
$menuid = '';
require '../includes/header.php';
require '../includes/menu-connect.php'; 
?> 
 

 <div class="global indent">
        <!--content-->
        <div class="container">
                <h2 class="indent"><span>Employee Login</span><em></em></h2>
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
                                            <div style="background-color:#006D9C; color:#FFFFFF; padding:3px;"><b>Login</b></div>
                                            <div style="margin:30px">
                                                <form action="" method="post">
                                                    <label>Username  :</label><input type="text" name="username" class="box"/><br /><br />
                                                    <label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
                                                    <input type="submit" name='submit' value="Submit" class='submit'/><br />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
        </div>
 </div>

<?php require '../includes/footer.php';?>