<?php
    $title = 'Vendor Inquiry' ;
    $description = '';
    $menuid = 'contacts';

    if (isset($_POST['action']) && $_POST['action'] === 'submit_vendor_inquiry_info')
    {
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
        {
            // store secret key
            $secret = '6LfaNVQUAAAAANlu-M-euPFUn_HqdN7HItkcEUzK';

            // get verify response data in JSON
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

            // convert JSON to PHP
            $responseData = json_decode($verifyResponse);

            // test
            // echo '<pre>';
            // print_r($responseData);
            // echo '</pre>';
            // exit();

            if ($responseData->success)
            {
                $company = (isset($_POST['company'])) ? filter_var($_POST['company'],FILTER_SANITIZE_STRING): '';
                $name = (isset($_POST['name'])) ? filter_var($_POST['name'],FILTER_SANITIZE_STRING): '';
                $email = (isset($_POST['email'])) ? filter_var($_POST['email'],FILTER_SANITIZE_STRING): '';
                $phone = (isset($_POST['phone'])) ? filter_var($_POST['phone'],FILTER_SANITIZE_STRING): '';
                $message = (isset($_POST['message'])) ? filter_var($_POST['message'],FILTER_SANITIZE_STRING): '';

                $honeypot = (isset($_POST['honeypot'])) ? filter_var($_POST['honeypot'],FILTER_SANITIZE_STRING): '';

                // test
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                // exit();

                if ($honeypot != '')
                {
                    echo "Form successfully submitted. Thank You!";
                    exit();
                }

                if (strlen($message > 300))
                {
                   return false;
                   exit();
                }

                // set gatekeeper
                $okay = 1;

                // Store visitor name in SESSION variable for use @thankyou
                $_SESSION['name'] = $name;

                // Check if fields have input
                if($company === '')
                {
                    echo "*Please enter your company name.";
                    $okay = 0;
                    exit();
                }
                elseif($name === '')
                {
                    echo "*Please enter your name.";
                    $okay = 0;
                    exit();
                }
                elseif($email === '')
                {
                    echo '*Please enter your email address.';
                    $okay = 0;
                    exit();
                }
                elseif($phone === '')
                {
                    echo '*Please enter your telephone number.';
                    $okay = 0;
                    exit();
                }


                if($okay == 1)
                {
                    // echo '<pre>';
                    // print_r($_POST);
                    // exit();

                    // Prepare message for e-mail; set e-mail recipient
                    $connie = 'crobertson@rivercitysecurity.com';
                    $kellee = 'kfriday@rivercitysecurity.com';
                    $jim_gmail = 'jim.burns14@gmail.com';

                    $to = $connie;
                    $subject = 'Vendor Contact';
                    $from = $email;
                    $message = '
                    <html>
                    <head></head>
                    <body>
                    <h2>Vendor seeking to Sell Products and/or Services</h2>
                    <p>
                       Company: ' . $company . '<br>
                       Name: ' . $name . '<br>
                       Email: ' . $email . '<br>
                       Telephone: ' . $phone . '<br>
                       Message: ' . $message . '<br><br>
                    </p>
                    </body>
                    </html>
                    '; // end of message
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";      // code to send HTML on UNIX
                    $headers .= 'Content-type:text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    $headers .= 'From: ' . $from . "\r\n";
                    $headers .= 'Cc: ' . $kellee . "\r\n";
                    $headers .= 'Bcc: ' . $jim_gmail . "\r\n";

                    // Send message using mail() function
                    mail($to, $subject, $message, $headers);

                    header('Location: ../more/thankyou.php');
                    exit();
                }
            }
            else
            {
                echo "Error occurred while processing data. Please try again.";
                exit();
            }
        }
    }
include '../includes/header.php';
include '../includes/menu.php';
?>

<!--content-->
<div class="global indent">
    <div class="formBox">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h3>Address</h3>
                <div class="info">
            <!--        <h4>Address 1</h4>  -->
                    <p>River City Security Services, Inc.<br>3728 Philips Hwy Ste 213 <br> Jacksonville, FL 32207</p>

                    <h4>Telephone</h4>
                    <p><a href="tel:9043460488">904-346-0488</a><br>Fax 904-346-0854</p>

           <!--         <h4>Address 2</h4>
                    <p>The Company Name Inc<br>9867 Mill Road, Cambridge, MG09 99HT.</p>  -->
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <h3>Sell to River City Security Services, Inc.
                    <br>
                    <span class="red txt070">(complete if you want to sell your products or services to us)</span>
                </h3>
                <p class="txt120 bold">
                    Thank you for your interest in selling your products or services to River City Security Services, Inc.
                    <br><br>
                    Please fill out the form below and in the text area explain the reason for your inquiry. If we are interested we
                    will contact you.
                </p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="vendor-inquiry-contact-form">

                        <label class="honeypot">Please fill out if you are a human</label>
                        <input type="text" name="honeypot" class="honeypot" value="">

                        <div class="form-group">
                          <input type="text" class="form-control required" name="company" id="company" placeholder="Company*" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control required" name="name" id="name" placeholder="Name*">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control required" name="email" id="email" placeholder="Email*">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control required" name="phone" id="phone" placeholder="Telephone*">
                        </div>

                        <div class="form-group">
                            <textarea maxlength="300" name="message" rows="5" class="form-control" id="message" placeholder="Briefly describe your products and/or services (300 character limit)"></textarea>
                            <p id="counterTitle">Character count (limit 300): <span id="messageCount"></span></p>
                            <p id="remainingCharactersTitle">Remaining characters: <span id="remainingCharacters"></span></p>
                        </div>

                        <!-- google recaptcha -->
                        <div style="margin-bottom: 20px;" class="g-recaptcha" data-sitekey="6LfaNVQUAAAAAOAOrTSC4ufsImG-0poB98PftsGk"></div>

                        <div class="form-group">
                            <button style="margin-left: 0px;" type="submit" id="get-quote-submit-btn" class="btn-default btn2" name="action" value="submit_vendor_inquiry_info">
                                Submit
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $("#vendor-inquiry-contact-form").validate();

    // count characters
    var maxLength = 300;
    var runningCount = 0;
    var count = {
      'counter': $("#messageCount").text($(this).val().length)
    }

    $("#message").on('keyup', function(){
        console.log("keyup occurred!");
        $("#counterTitle").show();
        $("#remainingCharactersTitle").show();

        $("#messageCount").text($(this).val().length);
        $("#remainingCharacters").text(maxLength - $(this).val().length);
        runningCount += count.counter.length;
        console.log(count.counter.length);
        console.log('Running count ' + runningCount);
        if( runningCount == maxLength ) {
            console.log("Reached character limit!");
            return alert("You have reached the character limit of " + maxLength);
        }
    });

});
</script>
<?php
    require '../includes/footer.php';
?>
