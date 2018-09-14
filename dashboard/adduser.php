<?php
// execute adding new user 
if(isset($_POST['adduser']))
{
        $errMsg      = '';
        $status      = "OK";
        $firstname   = trim($_POST['firstname']);
        $lastname    = trim($_POST['lastname']);
        $username    = trim($_POST['username']);
        $password    = trim($_POST['password']);
        $password2   = trim($_POST['password2']);       
        
        // check that each field is not empty
        if(empty($firstname) || empty($lastname) || empty($username) ||empty($password) || empty($password2))
            $errMsg .= "* All fields are required.<br>";
            $status = "NOTOK";
            
        // check username length
        if(strlen($username) < 6 || strlen($username) > 10)
            $errMsg .= "* Username must be 6 - 10 characters long.<br>";
            $status = "NOTOK";
            
        // check that username includes alphanumeric characters only
        if(!ctype_alnum($username))  // ctype_alnum() checks if all of the characters in the provided string, text, are alphanumeric. 
            $errMsg .= "* Username must contain alphanumeric characters only.<br>";
            $status = "NOTOK";
            
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
                          
        // check that password fields are set and match
        if(!isset($password) || !isset($password2) || $password !== $password2)  // !== not identical; http://php.net/manual/en/language.operators.comparison.php
            $errMsg .= "* Passwords do not match.<br>";
            $status = "NOTOK";
            
        // check password and password2 length
        if(strlen($password) < 6 || strlen($password) > 10 || strlen($password2) < 6 || strlen($password2) > 10)
            $errMsg .= "* Password must be  6 - 10 characters long.<br>";
            $status = "NOTOK";
            
        // check that password includes alphanumeric characters only
        if(!ctype_alnum($password))  // ctype_alnum() checks if all of the characters in the provided string, text, are alphanumeric. 
            $errMsg .= "* Password must contain alphanumeric characters only.<br>";
            $status = "NOTOK";    
        
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
                $stmt = $pdo->prepare("INSERT INTO register (firstname,lastname,username,original,password) values(:firstname,:lastname,:username,:password,:hash)"); 

                // Bind variable values to parameters or placeholders at the time execute() is called
                $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':original', $password, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hash, PDO::PARAM_STR);

                if($sql->execute())
                    $errMsg .= "<span style=color:#fff;> New user " . $firstname . "&nbsp;" . $lastname . " with " . " username " . $username . " ADDED successfully!<br></span>";      

                // Close cursor to free connection to server for other SQL statements
                $stmt->closeCursor();
            }
            catch (PDOExecption $e)
            {
                echo 'Error.' . $e->getMessage();
                exit();
            }
        }
   }
?>