<?php

session_start();

if(!empty($_POST['narrative'])){

    // get data from form
    $date                   = check_input($_POST['date']);
    $job_site               = check_input($_POST['job_site']);
    $nature                 = check_input($_POST['nature']);
    $incident_time          = check_input($_POST['incident_time']);
    $incident_date          = check_input($_POST['incident_date']);
    $firstname              = check_input($_POST['firstname']);
    $lastname               = check_input($_POST['lastname']);
    $title                  = check_input($_POST['title']);
    $shift_working          = check_input($_POST['shift_working']);
    $incident_location      = check_input($_POST['incident_location']);
    $any_victims            = check_input($_POST['any_victims']);
    $number_of_victims      = check_input($_POST['number_of_victims']);
    $victim_info            = check_input($_POST['victim_info']);
    $reported_by            = check_input($_POST['reported_by']);
    $any_witness            = check_input($_POST['any_witness']);
    $number_of_witnesses    = check_input($_POST['number_of_witnesses']);
    $witness_data           = check_input($_POST['witness_data']);
    $witness_data2          = nl2br($witness_data, false);
    $other_info             = check_input($_POST['other_info']);
    $other_info2            = nl2br($other_info, false);
    $narrative              = check_input($_POST['narrative']);
    $narrative2             = nl2br($narrative, false);
    
    $username               = $_SESSION['username'];
}
else
{
    echo "Submission cancelled. You did not complete the narrative section.";
    exit();
}
/* Prepare message for e-mail */
/* set e-mail recipient */
$to = "crobertson@rivercitysecurity.com, jim.burns14@gmail.com";
$subject = "Incident Report";
$message = // contents of report in $message
"
<html>
<head>
</head>
<body>
            <p><img src='http://www.rivercitysecurity.com/img/logo-rcs-216x50.png' width='216'; height='50' alt='River City Security Services logo'/></p>
            <h3>INCIDENT REPORT</h3>
        
<table name='incident_report' style='border-collapse:collapse; width:500px';> 
            <tr><th colspan='2'><h4 style='text-align:center';>Incident Report submitted by $firstname $lastname </h4></th></tr> 
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Login username: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'>$username</span></td></tr><br>    

            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Today's date: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'>$date</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Jobsite: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $job_site </span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Nature of report: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $nature</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Time of incident: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $incident_time</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Date of incident: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $incident_date</span></td></tr><br>           
                
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>First name: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $firstname</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Last name:<td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $lastname</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Title: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $title</span></td></tr>                      
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Tour / Shift time: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $shift_working</span></td></tr><br>          
                
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Location of incident: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $incident_location</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Victim(s)? <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $any_victims</span></td></tr>            
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Number of victims: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $number_of_victims</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Victim information: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $victim_info</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Reported by: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $reported_by</span></td></tr><br>
            
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Witnesses? <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $any_witness</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Number of witnesses: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $number_of_witnesses</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Witness information: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $witness_data2</span></td></tr>
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Other information: <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $other_info2</span></td></tr><br>     
            <tr><td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:35%';>Narrative (details): <td style='border:1px solid gray;padding:.2em 0 .2em .5em; width:65%';><span style='color:blue;font-weight:bold'> $narrative2</span></td></tr><br> 
        </table>
       	<p>End of Incident Report</p> 
       	<hr />
        
</body>
</html>
"; //end of $message

$from = "$email";  // required (must be $email ?)
$headers  = "MIMI-Version: 1.0" . "\n";      // code to send HTML on UNIX
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
$headers .= "From: $from" . "\n";

/* Send message using mail() function */
mail($to, $subject, $message, $headers); //  three parameters required, plus two optional

/* Redirect visitor to thank_you.php page */
header('Location: report-submitted.php');
exit();

/******  Functions used ******/
/** to validate text box and textarea data  **/
function check_input($data, $problem=''){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
        if($problem && strlen($data) === 0){
            show_error($problem);
        }
        return $data;
}
function show_error($myError){
?>

<html>
    <body>
        <strong>Please correct the following error:</strong><br>
        <?php echo $myError; ?>
    </body>
</html> 
<?php exit(); 
}
?>