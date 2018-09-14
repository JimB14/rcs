<?php
    $title = 'Logged out' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?> 
        
<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Logged Out</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-0  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                        <div class="history">
                            <p>
                                Your session connection has timed out.
                                <br>
                                <a href="../private/login.php" title="login" rel="nofollow">Login</a>
                            </p>
                        </div> <!-- end history -->
                    </div>
                </div> <!-- end thumb-pad3 -->
            </div> <!-- end col-xs-12 -->
         <div class="clearfix"></div>
        </div>
    </div>
</div>    

<?php
    require '../includes/footer.php';
?>
