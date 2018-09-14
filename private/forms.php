<?php
session_start();

if($_SESSION['username'])
{
	echo "<span style='color:#fff;font-size:100%;text-align:left;padding-left:13px;'>Welcome " . $_SESSION['username'] . "! </span>";
	echo "<a href='../connect/logout.php'> <span style='background-color:#000;color:#ffff00;'>" . "&nbsp;&nbsp; Logout " . "&nbsp;&nbsp;</a></span> <br>";
	
	// set life in seconds
	$inactive = 1800;
	
	$session_life = time() - $_SESSION['timeout']; 
	if($session_life > $inactive) 
	{	
		session_destroy(); 
		header("Location: ../connect/logged-out.php");	
	}
	
	$_SESSION['timeout'] = time();
} 
else 
{
    exit("You must be logged in!<br><br><a href='login.php'>Log in</a>");
}
?>

<?php
    $title = 'Forms' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Forms</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div class="history">
                                <p class="txt120">Access form by clicking name</p>
                                <ul class="form-page">
                                    <li><a href="../private/incident-report.php" rel="nofollow">Incident Report</a></li>
                                    <li><a href="../private/officer-daily-shift-report.php" rel="nofollow">Officer&#39;s Daily Shift Report</a></li>
                                    <li><a href="../private/security-officer-weekly-time-sheet.php" rel="nofollow">Security Officer&#39;s Weekly Time Sheet</a></li>
                                </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>  
    </div>
</div>

<?php
    require '../includes/footer.php';
?>