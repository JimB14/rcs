<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon2.ico" type="image/x-icon" />
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="google-site-verification" content="HTVOrFNaf64_ljy8Ig_vagBA7u1O5YW3Qy91bESIaQc" />
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/camera.css">
    <link rel="stylesheet" href="css/stuck.css">
    <link rel="stylesheet" href="fonts/font-awesome.css">
    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <script src="js/camera.js"></script>
    <script src="js/tmstickup.js"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
          <script src="js/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    <script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
    <script src="js/jquery.mousewheel.min.js"></script>
    <script src="js/jquery.touchSwipe.min.js"></script>
    <script>
        $(document).ready(function(){
            jQuery('.camera_wrap').camera();
        });
    </script>
    <script>
        $(window).load(function() {
            $(function() {
                $('#foo2').carouFredSel({
                                    auto: false,
                                    responsive: true,
                                    width: '100%',
                                    scroll: 1,
                    prev: '#prev2',
                                    next: '#next2',
                                    items: {
                                            height: 'auto',
                                            width:225,
                                            visible: {
                                                    min: 1,
                                                    max: 6
                                            }
                                    },
                                    mousewheel: true,
                                    swipe: {
                                            onMouse: true,
                                            onTouch: true
                                    }
                            });
                    });
          });
    </script>
    <!--[if lt IE 9]>
        <div style='text-align:center'><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>
      <![endif]-->
      <!--[if lt IE 9]><script src="../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
</head>
