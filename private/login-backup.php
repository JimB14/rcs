<?php
    $title = 'Login' ;        
    $description = '';
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';   
?>

<script>window.onload=function(){document.getElementById('username').focus();};</script>

<div class="global indent">
    <!--content-->
    <div class="container">
        <h2 class="indent"><span>Login</span><em></em></h2>
        <p class="center indent"></p>
        <div class="row">
            <div class="col-xs-12 col-xs-push-4  pad3Box">
                <div class="thumb-pad3">
                    <div class="thumbnail">
                 <!--       <em><span class="fa fa-group"></span></em> -->
                         <?php
                            if(isset($errMsg)){
                            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                            }
                          ?>
                        <div class="login p16">
                            <form action="../connect/" method="post">
                                <label>Username:</label>
                                <input type="text" name="username" id="username">
                                <br>
                                <label>Password:</label>
                                <input type="password" name="password" >
                                <br>
                                <label>&nbsp;</label>
                                <button class="btn-default btn2b" type="submit" name="login">Login</button> 
                            </form>
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