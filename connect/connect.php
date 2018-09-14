<?php
session_start();

//include('log_header.php'); 

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
		header('Location: ../private/login.php');
	}
}

$_SESSION['timeout'] = time();

//echo '<link rel="stylesheet" href="../css/register.css">';

if($_POST['login'])
{
		// get data from form and pass thru security functions
	$username = addslashes(strip_tags($_POST['username']));
	$password = addslashes(strip_tags($_POST['password']));
	
		// database access parameters
	$dsn = 'localhost';
	$un = 'jburns14';
	$pw = 'mypassword';
		
		// check if either field is empty		
	if(!$username || !$password)
	{
		echo "<span class='error_message'>*Please enter username and password!</span><br><br>&lt;&lt;<a href='login.php'>back</a>";
	}
	else 
	{
		// connect to database
		$connect = mysql_connect($dsn, $un, $pw);
		// select database name
		$ready = mysql_select_db('rcs_1');
			
		// query
		$result = mysql_query("SELECT * FROM users WHERE username = '$username'");	
		$numrows = mysql_num_rows($result);	// returns the number of rows in the result set
		
		if($numrows==0)
		{
			echo "<span class='error_message'>*Username does not exist!</span><br><br>&lt;&lt;<a href='login.php'>back</a>";
		}
		else 
		{	
			while($row = mysql_fetch_assoc($result))
			{
				$dbpassword = $row['password']; 	// $dbpassword = encrypted password in db; e.g.83ab9f32a3zz66d3c54ecb0a07bcb139		
	
				// encrypt password provided by user and assign value to $password
				$password = md5($password);
				
				// check if encrypted $password from user matches encrypted $dbpassword in database
				if($dbpassword != $password)
				{
				 	echo "<span class='error_message'>*Incorrect password.</span><br><br>&lt;&lt;<a href='login.php'>back</a>";		
				}
				else 
				{
					// check if account is active (active = 1; not active = 0)
					$active = $row['active'];	// 0 or 1
					$email = $row['email'];		// email address in db
					
					if($active==0)
					{
						echo "<span class='error_message'>*Your account has not been activated.<br>Please check your email ($email).";	
					}
					else 
					{
						echo "<span class='success'>Welcome " . $username . "!</span><br><br>";
						echo "<a href='member.php'>Click</a> to go to Member page.";	
						$_SESSION['username'] = $username;
					}	
				}
			}			
		}
	}								
}	
?>

