<body> 
<!-- <script>window.onload=function(){document.getElementById('username').focus();};</script> -->
<!--header-->
<header class="indent">
    <div class="follow-box">
        <div class="container"> 
            <ul class="follow_icon">
                <li class="txt120"><a href="tel:9043460488"><span style="color:#021983;"><em>Call</em> 904-346-0488</span></a></li>
            </ul>
<!--             <ul class="follow_icon">
                <li><a href="#"><img src="../img/follow_icon1.png" alt=""></a></li>
                <li><a href="#"><img src="../img/follow_icon2.png" alt=""></a></li>
                <li><a href="#"><img src="../img/follow_icon3.png" alt=""></a></li>
                <li><a href="#"><img src="../img/follow_icon4.png" alt=""></a></li>
                <li><a href="#"><img src="../img/follow_icon5.png" alt=""></a></li>
            </ul> --> 
        </div>
    </div>  
    <div id="stuck_container">
        <div class="menuBox">  
            <div class="container"> 
                <h1 class="navbar-brand navbar-brand_"><a href="../index.php" title="home"><img src="../img/logo-rcs-1275x277.jpg" width="336" height="73"  alt="River City Security Jacksonville FL"><span>company name</span></a></h1>
                <nav class="navbar navbar-default navbar-static-top tm_navbar clearfix" role="navigation">
                    <ul class="nav sf-menu clearfix">
                        <li class="sub-menu <?php if(isset($menuid) && $menuid === 'about'){echo ' active';} ?>"><a href="../about/">About</a><span></span>
                            <ul class="submenu">
                                <li><a href="../about/">about us</a></li>
                                <li><a href="../about/history.php">our history</a></li>
                                <li><a href="../about/team.php">our team</a></li>
                                <li><a href="#">Articles</a><span></span>
                                    <ul class="submenu">
                                        <li><a href="../about/how-to-choose-a-security-company.php">How to Choose a Security Company</a></li>
                                        <li><a href="../about/home-security.php">How to Secure Your Home for the Holidays</a></li>
                                        <li><a href="../about/integrity.php">What is Integrity?</a></li>
                                        <!--<li><a href="#">Article Four</a></li>-->
                                    </ul> 
                                </li>   
                            </ul>
                        </li>
                        <li class="<?php if(isset($menuid) && $menuid === 'services'){echo ' active';} ?>"><a href="../services/">services</a></li>
                        <li class="sub-menu <?php if(isset($menuid) && $menuid==='employment'){echo ' active';} ?>"><a href="../employment/">Employment</a>
                            <ul class="submenu">
                                <li><a href="../employment/">employment - our process</a></li>
                                <li><a href="../employment/how-to-apply.php">how to apply</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu<?php if(isset($menuid) && $menuid==='school'){echo ' active';} ?>"><a href="../school/">School</a>
                            <ul class="submenu">
                                <li><li><a href="#">testimonials from students</a></li></li>
                            </ul>
                        </li>
                        <li class="sub-menu <?php if(isset($menuid) && $menuid==='contacts'){echo ' active';} ?>"><a href="../contact">Contacts</a>
                            <ul class="submenu">
                                <li><a href="../contact/">contact us</a></li>
                                <li><a href="../more/get-quote.php">get quote</a></li>
                                <li><a href="../more/vendor-inquiry.php">sell to us</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
