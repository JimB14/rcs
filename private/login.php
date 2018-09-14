<?php
session_start(); 

// parameters of session
include_once '../connect/session-time.php';  

// connect to database
include_once '../connect/database-connect.php';

if(isset($_POST['login']))
{    
    //declare variables
    $errMsg = '';
    $hash = '';

    // to hide inconsequential error notice
    error_reporting(E_ALL ^ E_NOTICE); 

    // get data from login form and pass thru security functions
    $username = addslashes(strip_tags($_POST['username']));
    $password = addslashes(strip_tags($_POST['password']));

    // remove comment lines to display username and password contained in variables
    //echo '<div style="color:#fff;">&nbsp;&nbsp; Username: ' . $username . '</div>'; 
    //echo '<div style="color:#fff;">&nbsp;&nbsp; Entered Password: ' . $password . '</div>';

    // check for empty fields
    if(empty($username) || empty($password))
    {
        $errMsg .= '* You must enter your username & password.<br>';
    }

    // remove comment lines to display content of $errMsg
    //echo '<div style="color:#fff;">&nbsp;&nbsp; errMsg content: ' . $errMsg . '</div>';
    
    // hash password entered by user
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    
    // remove comment lines to display hash of current password
    //echo '<div style="color:#fff;">&nbsp;&nbsp; present $hash of entered password = ' . $hash . '<br></div>';
    
    try 
    {      
        // retrieve hashed password from database; code assistance: http://www.plus2net.com/php_tutorial/pdo-fetch.php
        $sql = $pdo->prepare("SELECT * FROM register WHERE username = :username");
        $sql->bindParam(':username', $username, PDO::PARAM_STR);
        if($sql->execute())
    
        $row = $sql->fetch(PDO::FETCH_OBJ);  // PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set 
        
        // remove comment lines to display stdClass Object array of returned row e.g. ([id]=>value [firstname]=>value [lastname]=>value [username]=>value [original]=>value [password]=>value
        //print_r($row) . "<br>";
               
    /*    foreach($row as $key => $value){
            echo '<div style="color:#fff">&nbsp;&nbsp; Name: ' . $key . '<br>&nbsp;&nbsp; Value: ' . $value . '</div><br>';  
        } */
        
        // take value in "password" column and store into variable ($stored_password); $row->username will store username into variable; replace "username" with column name of needed data
        $stored_password = $row->password;
        
        // remove comment lines to display password stored in password column for $username
        //echo '<div style="color:#fff;">&nbsp;&nbsp; $stored_password = ' . $stored_password . '</div>';
        
        // rename for use below in password_verify()
        $hash = $stored_password;
        
        // remove comment lines to verify content is the same after variable name change from $stored_passoword to $hash
        //echo '<div style="color:#fff;">&nbsp;&nbsp; $hash = ' . $hash . '</div>'; 
        
        // remove comment lines to check entered password against hash stored in database table
        //if($errMsg == '' && password_verify($password, $hash))
            //$errMsg .= '<div style="color:#fff;">&nbsp;&nbsp; Password valid!</div>';
    }
    catch (PDOException $e)
    {
        $errMsg .= "Error. " . $e->getMessage();
    }
    // final check for active error messages and to verify password; if true, verify if username exists, then authenticate login and redirect to new page or exit()
    if($errMsg == '' && password_verify($password, $hash))
    {
        try
        {
            // query database to check if username exists
            $stmt = $pdo->prepare('SELECT * FROM register WHERE username = :username');
            $stmt->bindParam(':username', $username);
            if($stmt->execute())
            {
                $row = $stmt->fetch(PDO::FETCH_OBJ);    // PDOStatement::fetch — Fetches the next row from a result set; 
            }                                           // PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set 
            
            $count = $stmt->rowCount();    // PDOStatement::rowCount — Returns the number of rows affected by the last SQL statement 
            $row = $stmt->fetch();         // PDOStatement::fetch — Fetches the next row from a result set
                if($count == 1)
                {
                    $_SESSION['username'] = $username;
                    header('location:forms.php');
                    exit();
                }
                else 
                {
                    $errMsg = '<span style="color:#ff0000;">Access denied. <br> Username and Password not found.</span><br>';                    
                }
        }
        catch (PDOException $e)
        {
            $errMsg = "Error " . $e->getMessage();
            exit();
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
            <div class="col-xs-12 col-xs-push-4  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">                                             
                        <div class="login p16"> 
                            <?php
                                if(isset($errMsg)){
                                    echo '<div class="margin-left110" style="color:#FF0000;text-align:left;font-size:12px;">'.$errMsg.'</div>';
                                }
                            ?>                           
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