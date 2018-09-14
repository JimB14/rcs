<?php

    // Production - DB configuration Constants
    // define('hostname', 'localhost');
    // define('name', 'riverc17_admin');
    // define('pass', '$ecurity2015!');
    // define('dbname', 'riverc17_db01');
    // $errMsg = '';

    // Development - DB configuration Constants
    define('hostname', 'localhost');
    define('name', 'root');
    define('pass', '');
    define('dbname', 'riverc17_db01');
    $errMsg = '';

    // PDO Database Connection
    try
    {
        $pdo = new PDO('mysql:host='. hostname .';dbname='.dbname,name,pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // remove comment lines to display database connection
        //echo '<div style="color:#fff;">&nbsp;&nbsp;* Database connection established! <br></div>';
    }
    catch(PDOException $e)
    {
        $errMsg .= "Unable to connect to the database server: " . $e->getMessage();
        include 'output.html.php';
        exit();
    }
?>
