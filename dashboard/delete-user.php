<?php

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
    
    if(strlen($username) < 6 || strlen($username) > 10)
    {
        $errMsg .= "* Username must be 6 - 10 characters long. <br>";
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
?>
