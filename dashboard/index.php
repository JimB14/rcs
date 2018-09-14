<?php
session_start(); 

// parameters of session
include '../connect/session-time-admin.php';
// connect to database
include_once '../connect/database-connect.php';
// include function library
//include '../functions/index.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}

/********************* ADD NEW USER **************************************/
// execute adding new user 
if(isset($_POST['adduser']))
{
        $errMsg      = '';
        $status      = "OK";
        $firstname   = test_input($_POST['firstname']);
        $lastname    = test_input($_POST['lastname']);
        $username    = test_input($_POST['username']);
        $password    = test_input($_POST['password']);
        $password2   = test_input($_POST['password2']);       
        
        // check that each field is not empty
       if(empty($firstname) || empty($lastname) || empty($username) ||empty($password) || empty($password2))
       {
            $errMsg .= "* All fields are required.<br>";
            $status = "NOTOK"; 
       }
            
         // check username length
        if(strlen($username) < 4 || strlen($username) > 10)
        {
            $errMsg .= "* Username must be 4 - 10 characters long.<br>";
            $status = "NOTOK"; 
        }
   
        try 
        {    
            // check if username already exists
            $stmt = $pdo->prepare("SELECT username FROM register WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $number = $stmt->rowCount();  // rowCount() returns the number of rows affected by the last SQL statement; http://php.net/manual/en/class.pdostatement.php
        }
        catch (PDOException $e)
        {
            $errMsg .= "* Error " . $e->getMessage() . '<br>';
            exit();
        }

        if($number > 0)   // if rowCount() returns 1, it means a row was returned containing $username; 0 means no row was returned. http://php.net/manual/en/class.pdostatement.php        
        {    
            $errMsg .= "* User already exists. Choose a different Username.<br>"; 
            $status = "NOTOK";
        }    
                          
      // check that password fields match
        if($password !== $password2)                            // !== not identical; http://php.net/manual/en/language.operators.comparison.php
        {   
            $errMsg .= "* Passwords do not match.<br>";
            $status = "NOTOK";
        }
            
        // check password and password2 length
        if(strlen($password) < 4 || strlen($password) > 10)
        {
            $errMsg .= "* Password must be  4 - 10 characters long.<br>";
            $status = "NOTOK";
        }
        
        if($status != "OK")          
        {
            $errMsg .= "-- Unable to add user. Try again. -- <br>";
        }
        else 
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);  // hash password

            try
            {          
                // Prepare statement
                $stmt = $pdo->prepare("INSERT INTO register (firstname,lastname,username,original,password) values(:firstname,:lastname,:username,:original,:password)"); 

                // Bind variable values to parameters or placeholders at the time execute() is called
                $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':original', $password, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hash, PDO::PARAM_STR);

                if($stmt->execute())
                    $errMsg .= "<span style=color:#ff0000;> * New user " . $firstname . "&nbsp;" . $lastname . " with username " . '"' . $username . '"' ." ADDED successfully!<br></span>";      

                // Close cursor to free connection to server for other SQL statements
                $stmt->closeCursor();
            }
            catch (PDOExecption $e)
            {
                echo 'Error' . $e->getMessage();
                exit();
            }
        }
   }
   
   ////********************* DELETE USER *********************////

if(isset($_POST['delete_user']))
{
    $errMsg         = '';
    $status         = 'OK';
    $number         = '';
    $delete_count   = '';
    $mem_id         = '';
    $username       = trim($_POST['username']);
    
    if(empty($username))
    {
        $errMsg .= "* Username missing. <br>";
        $status = "NOTOK";
    }
    
    if(strlen($username) < 4 || strlen($username) > 10)
    {
        $errMsg .= "* Username must be 4 - 10 characters long. <br>";
        $status = "NOTOK";
    }      
        if($status != "OK")
        {
            $errMsg .= "-- Unable to delete. Try again. --<br> ";
        } 
        else 
        {
            try
            {
                $sql = $pdo->prepare("SELECT username FROM register WHERE username = :username");
                $sql->bindParam(':username', $username, PDO::PARAM_STR);
                $sql->execute();
                $number = $sql->rowCount();

                if($number === 0)
                {
                    $errMsg .= "* Username does not exist.<br>";
                }
                if($number > 0)
                {                  
                    $sql = $pdo->prepare("DELETE FROM register WHERE username = :username");
                    $sql->bindParam(':username', $username, PDO::PARAM_STR);
                    $delete_count = $sql->execute();   
               
                    $errMsg .= "* " . $delete_count . " User "  . "( " . $username  . " ) found & deleted successfully! <br>";
                    $mem_id=$pdo->lastInsertId(); 

                    // Close cursor to free connection to server for other SQL statements
                    $sql->closeCursor();
                }
            } 
            catch (PDOException $e) 
            {
                $errMsg .= "Error " . $e->getMessage();
                exit();
            }   
        }
}

////********************** UPDATE PASSWORD ********************** ////

// execute inserting new password 
if(isset($_POST['update_password']))
{   
    $errMsg         = '';
    $status         = 'OK';
    $username       = test_input($_POST['username']);
    $password       = test_input($_POST['password']);
    $password2      = test_input($_POST['password2']);
    
    if(empty($username))
    {
        $errMsg .= "* Username required. <br>";
        $status = 'NOTOK';
    }
    if(!empty($username) && strlen($username) < 4 || strlen($username) > 10)
    {
        $errMsg .= "* Username must be 4 - 10 characters. <br>";
        $status = 'NOTOK';
    }
    if(strlen($password) >= 1 && strlen($password) < 4 || strlen($password) > 10)
    {
        $errMsg .= "* Password must be 4 - 10 characters. <br>";
        $status = 'NOTOK';
    } 
    if(strlen($password2) >= 1 && strlen($password2) < 4 || strlen($password2) > 10)
    {
        $errMsg .= "* Password must be 4 - 10 characters. <br>";
        $status = 'NOTOK';
    } 
    if(empty($password) || empty($password2))
    {
        $errMsg .= "* Enter password in both fields. <br>";
        $status = 'NOTOK';
    }  
    if(!empty($password) && !empty($password2) && $password !== $password2)
    {
        $errMsg .= "* Passwords do not match. <br>";
        $status = 'NOTOK'; 
    }
    if($status != 'OK')
    {
        $errMsg .= "-- Unable to update password. Try again. --<br>";
    }  
    else 
    {
        // hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try
        {
            $sql = $pdo->prepare("UPDATE register SET password = :password, original = :original WHERE username = :username");          
            $sql->bindParam(':username', $username, PDO::PARAM_STR);
            $sql->bindParam(':original', $password, PDO::PARAM_STR);
            $sql->bindParam(':password', $hash, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->execute())
                $errMsg .= "* Password for user " . $username . " UPDATED succesfully! <br>"; 
            
            // Close cursor to free connection to server for other SQL statements
            $sql->closeCursor();
        } 
        catch (PDOException $e)
        {
            $errMsg .= "Unable to update password. " . $e->getMessage();
            exit();
        }
    }
}

////********************** Get User's Password ********************** ////

if(isset($_POST['get_password']))   
{
    $errMsg = '';
    $firstname  = test_input($_POST['firstname']);
    $lastname   = test_input($_POST['lastname']);
    $username   = '';
    $password   = '';
    
    if(empty($firstname) || empty($lastname))
    {
        $errMsg .= "<span style=font-weight:bold;color:#ff0000;>* Error. You must enter first name and last name.</span> <br>";
        include '../connect/output.html.php';
        exit();
    }
    else 
    {       
        $stmt = $pdo->prepare("SELECT * FROM register WHERE firstname = :firstname AND lastname = :lastname");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);

        if($stmt->execute())
        {
            $count = $stmt->rowCount();
            if($count == 0)
            {
                echo "<span style=font-weight:bold;color:#ff0000;><br>* Error. First and last name combination not found. Search \"Display Table\" from Dashboard to see all data.</span> <br>";
            }
            else
            {
                $stmt = $pdo->prepare("SELECT * FROM register WHERE firstname = :firstname && lastname = :lastname");
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);

                if($stmt->execute())
                {
                    $row = $stmt->fetch(PDO::FETCH_OBJ);  //PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set 
                    $password = $row->original;
                    $username = $row->username;
                }
                else
                {
                    $errMsg .= "* Record could not be found. Please verify data and try again. <br>";
                    include '../connect/output.html.php';
                    print_r($stmt->errorInfo());
                }
            }
        }
    }
}

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
                                        <div class="dashboard-box margin-right50 p6">
                                                <?php
                                                    if(isset($errMsg) && isset($_POST['adduser'])){
                                                    echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                                    }
                                                ?>
                                                <div style="background-color:#072C58; color:#FFF; padding:4px; text-align:center; font-weight:bold;"> Add User</div>
                                                <div class="db-form">
                                                    <form action="" method="post">
                                                        <label>First name  :</label>
                                                        <input type="text" name="firstname" value="<?php //if(isset($_POST['adduser'])) { echo htmlentities ($_POST['firstname']); }?>" tabindex="1" />
                                                        <label>Last name  :</label>
                                                        <input type="text" name="lastname" value="<?php //if(isset($_POST['adduser'])) { echo htmlentities ($_POST['lastname']); }?>" tabindex="2"/>
                                                        <label>Username  :</label>
                                                        <input type="text" name="username" placeholder="4 - 10 characters" value="<?php //if(isset($_POST['username'])) { echo htmlentities ($_POST['username']); }?>" tabindex="3"/>
                                                        <label>Password  :</label>
                                                        <input type="password" name="password" placeholder="4 - 10 characters" tabindex="4" />
                                                        <label>Password  :</label>
                                                        <input type="password" name="password2" placeholder="re-enter password" tabindex="5" />
                                                        <label>&nbsp;</label>
                                                        <button class="btn-default btn2b" type="submit" name="adduser" tabindex="6">Add</button><br>
                                                    </form>
                                                </div>
                                        </div> <!-- end dashboard-box -->
                                        <div class="dashboard-box margin-right50 p6">
                                            <?php
                                            if(isset($errMsg) && isset($_POST['update_password'])){
                                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                            }
                                            ?>
                                            <div style="background-color:#072C58; color:#FFF; padding:4px; text-align:center; font-weight:bold;"> Update Password</div>
                                            <div class="db-form update-password">
                                                <form action="" method="post">
                                                    <label>Username  :</label>
                                                    <input type="text" name="username" value="<?php //if(isset($_POST['update_password'])) { echo htmlentities ($_POST['username']); }?>" tabindex="6" />
                                                    <label>New Password  :</label>
                                                    <input type="password" name="password" placeholder="4 - 10 characters" tabindex="7" />    
                                                    <label>Retype password  :</label>
                                                    <input type="password" name="password2" placeholder="Re-enter password" tabindex="8" />
                                                    <label>&nbsp;</label>
                                                    <button class="btn-default btn2b" type="submit" name="update_password" tabindex="9">Update</button><br>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dashboard-box dashboard-box-short margin-right50 p6">
                                            <?php
                                            if(isset($errMsg) && isset($_POST['delete_user'])){
                                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                            }
                                            ?>
                                            <div style="background-color:#072C58; color:#FFF; padding:4px; text-align:center; font-weight:bold;"> Delete User</div>
                                            <div class="db-form delete-user">
                                                <form action="" method="post">
                                                    <label>Username  :</label>
                                                    <input type="text" name="username" tabindex="10" />
                                                    <label>&nbsp;</label>    
                                                    <button class="btn-default btn2b" onclick="return confirm('Are you sure? \nClick \'OK\' to delete user.\nClick \'Cancel\' to stop.');" type="submit" name="delete_user" tabindex="11">Delete</button><br>
                                                </form>
                                            </div>
                                        </div>  <!--  -->  
                                        <div class="dashboard-box dashboard-box-short p6">
                                            <?php
                                            if(isset($errMsg) && isset($_POST['display_table'])){
                                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                            }
                                            ?>
                                            <div style="background-color:#072C58; color:#FFF; padding:4px; text-align:center; font-weight:bold;"> Display Table</div>
                                            <div class="db-form">
                                                <form action="display-table-data.php" method="post"> 
                                                    <label>View database:</label>
                                                    <button class="btn-default btn2b left" type="submit" name="display_table" tabindex="12">Display</button><br>
                                                </form>
                                            </div>
                                        </div>  <!--  -->
                                        <div class="dashboard-box dashboard-box-medium p6">
                                            <?php
                                            if(isset($errMsg) && isset($_POST['get_password'])){
                                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                                            }
                                            ?>
                                            <div style="background-color:#072C58; color:#FFF; padding:4px; text-align:center; font-weight:bold;"> Get User&#39;s Password</div>
                                            <div class="db-form">
                                                <form action="get-password.php" method="post"> 
                                                    <label>First name  :</label>
                                                    <input type="text" name="firstname" tabindex="13" value="<?php //if(isset($_POST['get_password'])) { echo htmlentities ($_POST['username']); }?>" />
                                                    <label>Last name  :</label>
                                                    <input type="text" name="lastname" tabindex="14" />
                                                    <label>&nbsp;</label>
                                                    <button class="btn-default btn2b left" type="submit" name="get_password" tabindex="15">Get</button><br>
                                                </form>
                                            </div>
                                        </div>  <!--  -->
                                </div>  <!-- thumbnail  -->  
                        </div>  <!-- thumb-pad3  -->  
                </div>  <!-- col-xs-12 col-xs-push-0  -->  
            <div class="clearfix"></div>
        </div>  <!-- row -->  
    </div>  <!-- container  -->  
</div> <!-- global indent  -->   

<?php 
    require '../includes/footer.php';
?>