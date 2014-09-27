<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Home</title>
    <?php include "head.php" ?>

</head>

<body>

    <?php include 'header.php' ?>

    <div class="container">
        <div class="content">
        
            <div class="row-fluid" style="border:1px solid #CCC;padding:1px;color:White;margin-bottom:10px;border-radius:4px">
                <div style="width:940px;height:360px;background-image:url('bin/samplepicture.jpg');padding:30px;border-radius:4px;text-align:right">
                    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                    <h1 class="h1header" style="font-size:36pt;text-shadow:2px 2px #333333;color:White">Get a high-school internship!</h1>
                    <p style="margin-top:10px;font-size:13pt;text-shadow:2px 2px #222222">Tired of looking for an internship? Want to do something productive in  your life?</p>
                    <a href="register.php" class="btn btn-large" style="font-size:14pt;font-weight:bold">Create an Account</a>
                    <a href="search.php" class="btn btn-large btn-primary" style="font-size:14pt;font-weight:bold">Check out our internships.</a>
                </div>
            <!--</div>            <div class="row-fluid">
                <!--<div class="span12 well" style="background-color:#FAFAFA;border:1px solid #CCCCCC">
                    
                    Why use Internfox?
                    1.    Easy and free sign up with Internfox.
                    2.    Efficiently browse through our database for companies searching for high school interns.
                    3.    Simple application – just upload a resume and click apply!
                </div>

                <div class="span5 well" style="background-color:#FAFAFA;border:1px solid #CCCCCC">
                    <h2>Employers</h2>
                    <br />
                    <p>Are you an employer?</p>
                    <br />
                    <a href="employers.php" class="btn">Click here</a>
                </div>
            
            </div>-->
            
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
