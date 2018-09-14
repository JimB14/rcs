<?php

if(isset($_SESSION['username']))
{
    echo "<span style='color:#fff;font-size:100%;text-align:left;padding-left:13px;'>Welcome " . $_SESSION['username'] . "</span>";
    echo "<span style='color:#fff;font-size:100%;text-align:left;'><a href='../connect/logout-admin.php'> Logout</a></span>";
}
else
{
    echo 'No username';
}
// set timeout period in seconds
$inactive = 60;

// check if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']))
{
	// calculate the session lifetime
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{
            session_destroy();
            header('Location: logout.php');
	}
}
$_SESSION['timeout'] = time();
?>