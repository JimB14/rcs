<?php
session_start();

// parameters of session
include '../connect/session-time-admin.php';
// connect to database
include_once '../connect/database-connect.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data); // added without testing effect
  return $data;
}

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
                echo "<span style=font-weight:bold;color:#ff0000;><br>* Error. First and last name combination not found. Check data accuracy & try again.<br></span>";
                echo "<span style=font-weight:bold;color:#ff0000;>* Search \"Display Table\" from Dashboard to view all database data.</span> <br>";
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
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta lang="en" charset="utf-8">
        <link href="css/style.css" rel="stylesheet">       
        <style>
            body {font-family: Helvetica, Arial, sans-serif;font-size:14px;}    
            .data-table table, th, td{
                border: 1px solid #000; 
                padding: 0.5em;              
            }
            .data-table table{
                border-collapse: collapse;
                width: 95%; 
                overflow:hidden;
            }
            .data-table th{
                background-color: #072C58;
                color:#fff;
                text-align: left;
            }
            .data-table td {             
                vertical-align: bottom;
            }
            .data-table table td{
                 height: 100%;
            }
        </style>
        <script>
            function goBack(){window.history.go(-1);}
        </script>
    </head>
        <body>
            <div class="data-table">
                <h1>User&#39;s Password</h1> 
                <div style="margin-bottom:1em;"><span style="font-size: 125%"></span><button class="btn-default btn2b" onclick="goBack(-1)">Go Back</button> &nbsp;&nbsp;<a href="../" title="Click to return to home page"> Home Page</a></div>
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                     <!--       <th>Username</th>    -->
                            <th>Login Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td><?php echo $firstname; ?></td>
                            <td><?php echo $lastname; ?></td>  <!-- htmlspecialchars — Convert special characters to HTML entities; http://php.net/manual/en/function.htmlspecialchars.php -->
                  <!--          <td><?php echo $username; ?></td> -->
                            <td><?php echo $password; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
</html>
