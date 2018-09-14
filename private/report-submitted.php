<?php
    $title = 'Form submitted' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php'; 
    $rca = 'River City Apartments';
?>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Success!</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div class="history">
                                    <!--  <p class="title">Ut enim ad minima veniam <br>quis lorem nostrum</p> -->
                                <p class="txt120">The Report was successfully submitted. <br>Thank you!</p>                               
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