<?php
session_start();

if($_SESSION['username'])
{
	echo "<span style='color:#fff;font-size:100%;text-align:left;padding-left:13px;'>Welcome " . $_SESSION['username'] . "</span>";
	echo "<span style='color:#fff;font-size:100%;text-align:left;'><a href='../connect/logout.php'> Logout</a></span>";
	
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
    $title = 'Daily Shift Report' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Officer&#39;s Daily Shift Report</span><em></em></h2>
        <p class="center indent">Welcome <?php echo $_SESSION['username'] ?>! You are logged in. <br> <?php echo date('D M d, Y');?> 
            <br>
            <span class="center" id="time"></span>
        </p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div class="history">
       
                            <p>
                                
                            </p>                                                                                               
                  <!--          <a href="#" class="btn-default btn2">more</a>  -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
    </div>
    </div>
</div>    

<?php
    require '../includes/footer.php';
?>