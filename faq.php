<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Frequently Asked Questions</title>
    <?php include "head.php" ?>
    <style type="text/css">
    .well-white 
    {
        line-height:300%;
    }
    </style>
</head>

<body>

    <?php include 'header.php' ?>

    <div class="container">

            <div class="content">
                <div class="row-fluid" style="border:1px solid #CCC;padding:1px;color:White;margin-bottom:10px;border-radius:4px">
                    <div style="width:940px;height:50px;background-image:url('bin/companypicture.jpg');padding:30px;border-radius:4px">
                        <h1 class="h1header" style="margin-top:10px;font-size:36pt;text-shadow:2px 2px #333333">Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
            <div class="content well-white">
              <div class="row-fluid">
                <div class="span12" style="padding-left:0px;padding-right:0px">

                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Students</a></li>
                        <li><a href="#tab2" data-toggle="tab">Companies</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <h1>Students</h1><br />

                            <h3>What’s the difference between my profile and my resume?</h3>

                            <p>Your profile on Internfox should be a shortened version of your resume and contain only the most important "selling points."</p>

                            <h3>What happens when I apply?</h3>

                            <p>An email is sent to employers to notify them of your application. The employer will review your resume ASAP.</p>

                            <h3>How do I know if I get accepted into the internship?</h3>

                            <p>Your employers will contact you directly if they are interested in hiring you.</p>

                            <h3>When will I be notified of acceptance?</h3>

                            <p>Your date of notification depends on the specific employer. Please wait about 1-3 weeks.</p>

                            <h3>Can anybody else see my profile and resume?</h3>

                            <p>No, only companies offering internships will be able to view your profile. Your profile is not visible to anybody else.</p>
                            <br />
                            <p>Additional questions? Email contact@internfox.com</p>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h1>Companies</h1><br />

                            <h3>How do I submit a listing?</h3>

                            <p>To submit a listing, please fill out this form: <a href="http://www.internfox.com/listing">www.internfox.com/listing</a></p>

                            <h3>How do I edit my company profile?</h3>

                            <p>Email listing@internfox.com if there’s something you want to change on your company profile.</p>

                            <h3>What happens when a student applies?</h3>

                            <p>Internfox will email you whenever a student applies to your internship.</p>

                            <h3>How do I contact the student?</h3>

                            <p>You contact the student directly via the provided email.  </p>

                            <h3>What happens when I decide on an applicant?</h3>

                            <p>Notify the student via email and let Internfox know so we can make the proper updates to your internship page. </p>
                            <br />
                            <p>Additional questions? Email contact@internfox.com</p>
                        </div>
                      </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
