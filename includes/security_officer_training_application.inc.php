<?php
$page_id = 'school';
$title = 'Application';
$description = 'Security Officer Training Application';
include '../includes/states_array.inc.php';
//include 'includes/helper.php';

if (isset($_POST['action']) && $_POST['action'] === 'submit_application') {
    
    $first_name = sanitize($_POST['first_name']);
    $middle_name = sanitize($_POST['middle_name']);
    $last_name = sanitize($_POST['last_name']);
    $address = sanitize($_POST['address']);
    $city = sanitize($_POST['city']);
    $state = sanitize($_POST['state']);
    $zip = sanitize($_POST['zip']);    
    $telephone = sanitize($_POST['telephone']);
    $cell = sanitize($_POST['cell']);
    $email = sanitize($_POST['email']);
       
    // Store visitor name in SESSION variable for use @thankyou
    $_SESSION['name'] = $first_name . ' ' . $last_name;  
                   
    // Check if fields have input
    if(empty($first_name))
    {
        $errMsg['name'] = '*Please enter your name.';
    }
    elseif(empty($last_name))
    {
        $errMsg['last_name'] = '*Please enter your last name.';
    }
    elseif(empty($address))
    {
        $errMsg['address'] = '*Please enter your address.';
    }
    elseif(empty($city))
    {
        $errMsg['city'] = '*Please enter your city.';
    }
    elseif(empty($state))
    {
        $errMsg['state'] = '*Please enter your state.';
    }
    elseif(empty($zip))
    {
        $errMsg['zip'] = '*Please enter your zip code.';
    }
    elseif(empty($telephone)) 
    {
        $errMsg['telephone'] = '*Please enter your telephone number.';
    }
    elseif(empty($cell)) 
    {
        $errMsg['cell'] = '*Please enter your cell number.';
    }
    elseif(empty($email))
    {
        $errMsg['email'] = '*Please enter your email address.';
    }
        if(count($errMsg) == 0) {
        // Prepare message for e-mail; set e-mail recipient  
        $jim_gmail = 'jim.burns14@gmail.com';
        $connie = 'crobertson@rivercitysecurity.com';


        $to = $connie;
        $subject = 'Training Application';
        $from = $email;
        $message = '
        <html>
        <head></head>
        <body>
        <h2>Application for Security Officer Training</h2>
        <p>First name: ' . $name . '<br>
           Middle: ' . $middle_name . '<br>
           Last: ' . $last_name . '<br>
           Email: ' . $email . '<br>
           Telephone: ' . $telephone . '<br>
           Message: ' . $form_message . '<br><br>
           Catalog: ' . $catalog . '<br>    
           Address: ' . $address . '<br>
           City: ' . $city . '<br>
           State: ' . $state . '<br>    
           Zip Code: ' . $zip . '<br>    
        </body>
        </html>
        '; // end of message
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";      // code to send HTML on UNIX
        $headers .= 'Content-type:text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: ' . $from . "\r\n";
        $headers .= 'Bcc: ' . $marylou . "\r\n";         
        $headers .= 'Bcc: ' . $jim_gmail . "\r\n"; 
             
        // Send message using mail() function 
        mail($to, $subject, $message, $headers);

        header('Location: thankyou.php');
        exit();
    }
}
?>


<h1 class="text-center" style="margin-bottom: 20px;">Apply Online</h1>

<div id="app-form-bg">
    <h4 class="p1">Please provide the following information.</h4>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="contact-form" method="post">

        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['first_name'])) {
                    echo htmlspecialchars($errMsg['first_name']);
                }
                ?></p>
            <label class="control-label">First name </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" value="<?php if (isset($first_name)) echo htmlspecialchars($first_name); ?>" autofocus="autofocus">

        </div>

        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['middle_name'])) {
                    echo htmlspecialchars($errMsg['middle_name']);
                }
                ?></p>
            <label class="control-label">Middle name </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Middle name" value="<?php if (isset($middle_name)) echo htmlspecialchars($middle_name); ?>">

        </div>

        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['last_name'])) {
                    echo htmlspecialchars($errMsg['last_name']);
                }
                ?></p>
            <label class="control-label">Last name </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name" value="<?php if (isset($last_name)) echo htmlspecialchars($last_name); ?>">

        </div>


        <!-- - - - - - - - - - - - - - - - - - - -->

        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['address'])) {
                    echo htmlspecialchars($errMsg['address']);
                }
                ?></p>
            <label class="control-label">Address </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?php if (isset($address)) echo htmlspecialchars($address); ?>">

        </div>

        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['city'])) {
                    echo htmlspecialchars($errMsg['city']);
                }
                ?></p>
            <label class="control-label">City </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="city" class="form-control" id="city" placeholder="City" value="<?php if (isset($city)) echo htmlspecialchars($city); ?>">

        </div>


        <div class="form-group">
            <p class="errMsg"><?php if (isset($errMsg['state'])) {echo htmlspecialchars($errMsg['state']);}?></p>
            <label for="state">State</label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <select class="form-control" id="state" name="state">
                <option value="">Select state</option>
                <?php foreach ($states as $key => $state): ?>
                    <option value="<?php if(isset($state)) echo htmlspecialchars($state); else echo htmlspecialchars($state); ?>"><?php {echo htmlspecialchars($key);} ?></option>
                <?php endforeach; ?>
            </select>                       
        </div>


        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['zip'])) {
                    echo htmlspecialchars($errMsg['zip']);
                }
                ?></p>
            <label class="control-label">Zip code </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="zip" class="form-control" id="zip" placeholder="Zip code" value="<?php if (isset($zip)) echo htmlspecialchars($zip); ?>">

        </div>


        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['telephone'])) {
                    echo htmlspecialchars($errMsg['telephone']);
                }
                ?></p>
            <label class="control-label">Telephone</label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone" value="<?php if (isset($telephone)) echo htmlspecialchars($telephone); ?>">
        </div>


        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['cell'])) {
                    echo htmlspecialchars($errMsg['cell']);
                }
                ?></p>
            <label class="control-label">Cell</label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="text" name="cell" class="form-control" id="cell" placeholder="Cell" value="<?php if (isset($cell)) echo htmlspecialchars($cell); ?>">
        </div>



        <div class="form-group has-feedback">
            <p class="errMsg"><?php
                if (isset($errMsg['email'])) {
                    echo htmlspecialchars($errMsg['email']);
                }
                ?></p>
            <label class="control-label">Email address </label><sup><span class="glyphicon glyphicon-asterisk"></span></sup>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php if (isset($email)) echo htmlspecialchars($email); ?>">
        </div>


        <button type="submit" class="btn-default btn2" name="action" value="submit_application">Submit</button>
    </form>
</div><!--  // #app-form-bg  -->