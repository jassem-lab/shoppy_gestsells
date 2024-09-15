<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>GestSells eCommerce Admin Dashboard</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="admin/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="admin/css/animation.css">
    <link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="admin/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="admin/css/style.css">



    <!-- Font -->
    <link rel="stylesheet" href="admin/font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="admin/icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <!-- <link rel="shortcut icon" href="admin/images/favicon.png"> -->
    <!-- <link rel="apple-touch-icon-precomposed" href="admin/images/favicon.png"> -->

</head>

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="wrap-login-page">
                <div class="flex-grow flex flex-column justify-center gap30">
                    <a href="index.html" id="site-logo-inner">
                        
                    </a>
                    <div class="login-box">

                        <div>
                            <h3>Login to account</h3>
                            <div class="body-text">Enter your email & password to login</div>
                        </div>
                        <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                                    <div class="alert alert-custom alert-indicator-bottom indicator-danger"
                                        role="alert">
                                        <div class="alert-content">

                                            <span class="alert-text">Invalid username or password</span>
                                        </div>
                                    </div>
                                    <?php } ?>
                       
                        <form class="form-login flex flex-column gap24" action="validate.php" method="POST">
                            <fieldset class="email">
                                <div class="body-title mb-10">Email address <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Enter your email address" name="email" tabindex="0" value="" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Enter your password" name="password" tabindex="0" value="" aria-required="true" required="">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input class="" type="checkbox" id="signed">
                                    <label class="body-text" for="signed">Keep me signed in</label>
                                </div>
                                <a href="#" class="body-text tf-color">Forgot password?</a>
                            </div>
                            <button type="submit" name="submit" class="tf-button w-full">Login</button>
                        </form>
                        <div>
                      
                        </div>
                        <div class="body-text text-center">
                            You don't have an account yet?
                            <a href="sign-up.html" class="body-text tf-color">Register Now</a>
                        </div>
                    </div>
                </div>
                <div class="text-tiny">Copyright © 2024 JG, All rights reserved.</div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/bootstrap-select.min.js"></script>
    <script src="admin/js/main.js"></script>

</body>

</html>