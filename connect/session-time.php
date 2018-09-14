<?php
    // set timeout period in seconds
    $inactive = 900;

    // check if $_SESSION['timeout'] is set
    if(isset($_SESSION['timeout']))
    {	
        // calculate the session lifetime
        $session_life = time() - $_SESSION['timeout']; 

        if($session_life > $inactive) 
        {	
            session_destroy(); 
            header("Location: logged-out.php");	
        }
    }
    $_SESSION['timeout'] = time();
?>