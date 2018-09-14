<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = 'School' ;
$description = 'River City Security Services, Inc offers training to become a Licensed Security Officer.';
$menuid = 'school';
require '../includes/header.php';
require '../includes/menu.php';
?>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Training School</span><em></em></h2>
        <p class="center">Committed to Integrity since 1995</p>
        <div class="row">
            <div class="col-md-12 col-center-block school-banner">
                <h3 style="margin: 5px 0px">
                    <i>Call 904-346-0488 today</i> to register for our next class!
                    <br>
                    &quot;Class D Training Course&quot; begins August 13-17, 2018
                    <br>
                    Space is limited, so call today!
                </h3>
            </div>

            <h1 class="text-center" style="margin-bottom: 30px;">Become a Licensed Security Officer</h1>

            <div class="col-md-4">
                <img class="img-responsive pull-left" src="../img/school01.jpg" alt="Train to become a Security Officer">

            </div>

            <div class="col-xs-8 col-xs-push-0  pad3Box">

                    <div class="school">

                        <p>
                            The State of Florida, Department of Licensing, requires each Security Officer be licensed by the State of Florida.
                        </p>
                        <p>
                            In order to obtain a Security Officer License, a person must take a 40 hour class at a Licensed, pre-approved Security School, taught by a Licensed Instructor.
                        </p>
                        <p>
                            Once you complete the 40 hour class, you submit the State application for a Class &quot;D&quot; Security Officer License.
                        </p>
                        <p>
                            As stated in the State Application, the application fee is $45 for the License and $42 for a Fingerprint Processing fee, totaling $87.
                        </p>
                        <p>
                            <strong>Your application and fees must be taken to:</strong>
                            <br>
                            Florida Department of Agriculture and Consumer Services Regional Office<br>
                            7825 Baymeadows Way, Center Building, Suite 106A<br>
                            Jacksonville, FL 32256
                            <br><br>
                            If you are interested in becoming a Florida Licensed Security Officer, please call us at
                            <strong><a href=tel:9043460488>904-346-0488</a></strong>, or <a href="../pdf/security_officer_training_application.pdf" download="application">download the Application</a>,
                            print it out, complete the form and either mail it or bring it to our office with your deposit. We will then provide you a schedule of the upcoming Classes.
                            <br><br>
                            Photo identification is required. We look forward to meeting you!
                        </p>
                    </div>

            <div class="clearfix"></div>


            </div>

    </div> <!-- end row  -->
</div> <!-- end container  -->
</div> <!-- end global -->

<?php
    require '../includes/footer.php';
?>
