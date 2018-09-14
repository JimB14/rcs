<?php
session_start();

// parameters of session
include '../connect/session-time-admin.php';
// connect to database
include_once '../connect/database-connect.php';

$firstname = 'Christen';
$lastname = 'Burns';

$stmt = $pdo->prepare("SELECT * FROM register WHERE firstname = :firstname AND lastname = :lastname");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);

if($stmt->execute())
{
    $count = $stmt->rowCount();
    if($count == 0)
    {
        echo "Error. User not found. <br>";
    }
    else
    {
        $stmt = $pdo->prepare("SELECT * FROM register WHERE firstname = :firstname AND lastname = :lastname");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);

        if($stmt->execute())
        {
            $row = $stmt->fetch(PDO::FETCH_OBJ);  //PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set 
            $password = $row->original;
            $username = $row->username;

            echo "<br>" . $firstname. " ".$lastname.  "'s password is: " . $password.".<br>Username is: ". $username.".";
        }
        else
        {
            echo "Error. User not found. <br>";
            print_r($stmt->errorInfo());
        }
    }
}
?>