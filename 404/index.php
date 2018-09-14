<?php
    $title = '404 page' ;        
    $description = '';  
    $menuid = '';
    require '../includes/header.php';
    require '../includes/menu.php';
?> 

<!--content-->
<div class="global indent">
    <div class="err-box">
        <div class="container">
            <div class="row">
  <!--              <div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-1 errorBox">
                    <figure><img src="img/error.png" alt=""></figure>
                </div> -->
                <div class="col-lg-5 col-md-6 col-sm-6 errorBox1">
                    <h3>Sorry! Page not found</h3>
                    <h4>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h4>
                    <p>Please try using our search box below to look for information on the website.</p>
                    <form id="search-404" class="search" action="search.php" method="GET" accept-charset="utf-8">
                        <input type="text" name="s" value="" onfocus="if (this.value == '') {this.value=''}" onblur="if (this.value == '') {this.value=''}">
                        <a href="#" onClick="document.getElementById('search-404').submit()" class="btn-default btn2">search</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require '../includes/footer.php';
?>