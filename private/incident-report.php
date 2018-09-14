<?php
//session_start();

/*if($_SESSION['username'])
{
	echo "<span style='color:#fff;font-size:100%;text-align:left;padding-left:13px;'>Welcome " . $_SESSION['username'] . "</span>";
	echo "<a href='../connect/logout.php'><span style='background-color:#000;color:#ffff00;font-size:100%;text-align:left;'> Logout</a></span>";
	
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
*/

    $title = 'Incident Report' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Incident Report</span><em></em></h2>
        <p class="center">Welcome <?php echo $_SESSION['username'] ?>! You are logged in. <br> <?php echo date('D M d, Y');?> 
            <br>
            <span class="center" id="time"></span>
        </p>
            <div class="row">
                <div class="col-xs-12 col-xs-push-0  pad3Box">
                    <div class="thumb-pad3">
                        <div class="thumbnail">
                            <section>
                                <div class="ir-form">
                                    <p class="center txt140 bold"> This Incident Report must be completed and submitted for review.</p>
                                    <form action="process-ir.php" method="post" name="incident_report" id="incident_report">
                                        <label for="date">Today&#39;s date:</label>
                                        <input type="text" name="date" id="date_today" placeholder=" month-day-year" required autofocus tabindex="1"/><br><br>
                                        <label for="job_site">Job site:</label> 
                                        <input type="text" name="job_site" id="job_site" required tabindex="2" /><br>
                                        <label for="nature">Nature of report:</label> 
                                        <input type="text" name="nature" id="nature" required tabindex="3" /><br>
                                        <label for="incident_time">Time of incident:</label> 
                                        <input type="text" name="incident_time" id="incident_time" required tabindex="4" /><br>
                                        <label for="incident_date">Date of incident:</label> 
                                        <input type="text" name="incident_date" id="incident_date" placeholder=" month-day-year" required tabindex="5" /><br><br><br>
                                  <!--      <label for="shift">Tour / Shift time:</label> 
                                        <input type="text" name="shift" id="shift" required tabindex="6" /><br><br><br>
                                    -->
                                        <label for="firstname">First name:</label> 
                                        <input type="text" name="firstname" id="firstname" placeholder=" person filling out report" required tabindex="7" /><br>
                                        <label for="lastname">Last name:</label> 
                                        <input type="text" name="lastname" id="lastname" required tabindex="8" /><br>
                                        <label for="title">Title:</label> 
                                        <input type="text" name="title" id="title" required tabindex="9" /><br>
                                        <label for="shift">Tour / Shift time:</label> 
                                        <input type="text" name="shift_working" id="shift_working" required tabindex="10" /><br><br><br>
                         <!--               <label for="employee_id">Employee ID:</label> 
                                        <input type="text" name="employee_id" id="employee_id" required tabindex="11" /><br><br><br>-->

                                        <label for="incident_location">Location of incident:</label> 
                                        <input type="text" name="incident_location" id="incident_location" required tabindex="12" /><br>
                                        <label for="any_victims">Victim(s)?</label>
                                        <select name="any_victims" tabindex="13">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select><br>
                                        <label for="number_of_victims">Number of victims:</label>
                                        <select name="number_of_victims" tabindex="14">
                                            <option>--</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="more than 10"> 10+</option>
                                        </select><br>
                                        <label for="victim_info">Victim information:</label> 
                                        <textarea name="victim_info" id="victim_info" placeholder=" Record name, address & department for each victim" tabindex="15" wrap="soft" cols="35"></textarea><br><br>
                                        <label for="reported_by">Reported by:</label> 
                                        <input type="text" name="reported_by" id="reported_by" required tabindex="16" /><br>
                                        <label for="any_witness">Witnesses?</label>
                                        <select name="any_witness" tabindex="17">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select><br>
                                        <label for="number_of_witnesses">Number of witnesses:</label>
                                        <select name="number_of_witnesses" tabindex="18">
                                            <option>--</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select><br>
                                        <label for="witness_data">Witness information:</label> 
                                        <textarea name="witness_data" id="witness_data" placeholder=" Record name, address & department for each witness" tabindex="19" wrap="soft" cols="35"></textarea><br><br>
                                        <label for="other_info">Other information:</label> 
                                        <textarea name="other_info" id="other_info" placeholder=" Suspects, person(s) arrested, extra witnesses, etc." tabindex="20" wrap="soft" cols="35"></textarea><br><br>
                                        <label for="narrative">Narrative (details):</label> 
                                        <textarea name="narrative" title="Explain who, what, where, when, why, how, how many" id="narrative" placeholder=" Give details: (1)Who, (2)What, (3)Where, (4)When, (5)Why, (6)How, (7)How many" tabindex="21" wrap="soft" cols="35"></textarea><br><br>

                                        <div id="submission">
                                            <p class="bold">By submitting this Incident Report, you indicate that all information is true and reliable to the best of your knowledge.</p>

                                            <label>&nbsp;</label>
                                            <button type="submit" onclick="return confirm('Click \'OK\' to submit.\nClick \'Cancel\' to review or make changes before submission.');" class="btn-default btn2" id="ir_submission" title="Click to submit Incident Report" tabindex="22">Submit</button><br><br>			
                                        </div> <!-- end div submission -->
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end row -->
    </div> <!-- end container -->
</div> <!-- end global -->   

<?php
    require '../includes/footer.php';
?>