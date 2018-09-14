<?php
session_start(); 

// parameters of session
include 'session-time.php';
    
// connect to database
include 'database-connect.php';

if(isset($_POST['login'], $_POST['username'], $_POST['password']));
{
    $errMsg = '';
     
    // get data from login form and pass thru security functions
    $username = trim($_POST['username']);
    $password = trim(strip_tags($_POST['password']));
    
    echo $username . ' ' . $password;
     
    // check for empty fields
    if(empty($username))
        $errMsg .= '* You must enter your username.<br>';
        include 'output.html.php';
    
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
            header('location: ../private/forms.php');
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
            <div class="col-xs-12 col-xs-push-4  pad3Box">
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

<!--    
    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // verify hash of entered password 
    if(password_verify($password, $hash))
    {   
        echo "Password is valid";           
$count = $stmt->rowCount();
        
        

// use fetch since only one row is being returned; no foreach loop required
        $row = $stmt->fetch();
            if($count == 1) 
            
        $_SESSION['username'] = $username;
        header('location: ../private/forms.php');
        exit();                                            