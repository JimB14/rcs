<?php

function update_password()
{       
    global $pdo;
    try
        {
        // SQL query
        $query = "UPDATE register
                  SET password = '$hash'
                  WHERE username = '$username'
                  ";

        // Prepare statement
        $stmt = $pdo->prepare($query);  

        // Execute query
        $stmt->execute();

        // display message of success
        echo $stmt->rowCount() . " password UPDATED successfully!";
        }
    catch (PDOExecption $e)
        {
            echo 'Error' . $e->getMessage();
        }
}

function adduser()
{
    global $pdo;
     try
        {
        // SQL query
        $query = "INSERT INTO register SET
                  firstname = :firstname,
                  lastname  = :lastname,
                  username  = :username,
                  password  = :password;
                  ";

        // Prepare statement
        $stmt = $pdo->prepare($query); 
        
        // Bind specified value to specified parameter
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);

        // Execute query of stmt pdo object
        $stmt->execute();
        
        // Close cursor to free connection to server for other SQL statements
        $stmt->closeCursor();

        // display message of success
        echo "<span style=color:#000;> &nbsp;&nbsp;&nbsp;  New user " . $firstname . "&nbsp;" . $lastname . " ADDED successfully!</span>";
        }
    catch (PDOExecption $e)
        {
            echo 'Error' . $e->getMessage();
        }
}

function user_login()
{
    global $pdo;
    
    if(isset($_POST['login']))
    {
        if(isset($_POST['username'], $_POST['password']))
        {
            // get data from form
            $username   = trim($_POST['username']);
            $password   = trim($_POST['password']);

            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            try
            {
                // SQL query
                $stmt = $pdo->prepare("SELECT id,username,password FROM register WHERE username = :username AND password = :password");
               
                // Bind values to parameters
                $stmt->bindParam(':username', $username, PDO::PARAM_INT);
                $stmt->bindParam(':password', $hash, PDO::PARAM_INT);

                // Execute query
                $stmt->execute();

                if($stmt->execute())
                    $count = $stmt->rowCount();
                echo $count;
                        
                if($count == 1)
                {
                    // login successful
                    $_SESSION['username'] = $username;
                    header('Location: ../private/forms/');
                    exit();
                }
                else
                {
                    echo 'Login failed ' . $e->getMessage();
                    exit();
                }
                }
             catch (PDOException $e)
                {
                    echo 'Error ' . $e->getMessage();
            }
        }
    }
}
?>

<!--  // Sanitize data
                $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_NUMBER_INT);
                $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_NUMBER_INT);
