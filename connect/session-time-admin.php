<?php

if(isset($_SESSION['username']))
{
	echo "<span style='background-color:#000;color:#fff;font-size:100%;text-align:left;padding-left:13px;'>Username logged in: " . $_SESSION['username'] . "</span>";
	echo "<a href='../connect/logout-admin.php'><span style='background-color:#000;color:#ffff00;'>" . "&nbsp;&nbsp; Logout " . "&nbsp;&nbsp;</a></span> <br>";
	
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
} 
else 
{
    exit("You must be logged in!<br><br><a href='../private/login-admin.php'>Log in</a>");
}
?>