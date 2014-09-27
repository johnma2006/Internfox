<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Browse Internships</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <?php

            if (isset($_POST['ac'])) {

                $company_displayname = $_POST['company_displayname'];
                $company_id = $_POST['ac'];
                $user_id = $user['id'];

                date_default_timezone_set('America/Vancouver');
                $date = date('Y/m/d', time());

                $query = "SELECT *
                        FROM applications
                        WHERE company_id = '$company_id' AND user_id = '$user_id';";
                $result = mysql_query($query);
                if(mysql_num_rows($result) > 0) {
                    $_SESSION['message'] = '<div class="alert alert-error">
                                            <i class="icon-thumbs-down"></i> You have already applied to ' . $company_displayname . '.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                        </div>';
                        header('Location: search.php');
                }
                else {
                    $query = "  INSERT INTO applications (company_id , user_id , date , isVerified)
                                VALUES ('$company_id' , '$user_id' , '$date' , '0');";
                    mysql_query($query);


                    include 'sendgrid-sendgrid-php-c483570/SendGrid_loader.php';
                    $sendgrid = new SendGrid('app5835073@heroku.com', '45xubqst');
                
                    $message = 'New application has been submitted.';
                        
                    $mail = new SendGrid\Mail();
                    $mail->addTo('johnma2006@gmail.com')->
                           setFrom('listing@internfox.com')->
                           setSubject('Internfox: New Application')->
                           setText($message)->
                           setHtml($message);
                
                    $sendgrid->web->send($mail);


                    $_SESSION['message'] = '<div class="alert alert-success">
                                            <i class="icon-thumbs-down"></i> You have successfully applied to ' . $company_displayname . '.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                        </div>';
                        header('Location: search.php');
                }

                /*include 'sendgrid-sendgrid-php-c483570/SendGrid_loader.php';
                $sendgrid = new SendGrid('app5835073@heroku.com', '45xubqst');
                
                $mail = new SendGrid\Mail();
                $mail->addTo('johnma2006@gmail.com')->
                       setFrom('john@internfox.com')->
                       setSubject('Subject goes here')->
                       setText('Hello World!')->
                       setHtml('<strong>Hello World!</strong>');
                
                $sendgrid->web->send($mail);*/
            }

            ?>

            <div class="row-fluid" style="border:1px solid #CCC;padding:1px;color:White;margin-bottom:10px;border-radius:4px">
                <div style="width:940px;height:80px;background-image:url('bin/companypicture.jpg');padding:30px;border-radius:4px">
                    <br />
                    <h1 class="h1header" style="font-size:36pt;text-shadow:2px 2px #333333">Our Internships</h1>
                    <p style="margin-top:10px;font-size:13pt;text-shadow:2px 2px #222222">Look through the internships we have to see which one fits you best.</p>
                </div>
            </div>
            
            <div class="row-fluid">

                <div class="span3" style="height:800px">
                <!--
                    <div class="well" style="padding: 8px 0;border:1px solid #AAAAAA">
                        <ul class="nav nav-list">
                            <li class="nav-header">Category</li>
                            <li class="active"><a href="#">Technology</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>
                    </div>-->
                <div class="well well-white" style="border:1px solid #AAAAAA">
                        <h4>Why can't I view more info?</h4><br />
                        <p>You need to create an account to view more info on the listings.</p><br />
                        <h4>How do I apply for an internship?</h4><br />
                        <p>Create an account, fill out your profile, and press Apply.</p><br />
                        <h4>What happens next?</h4><br />
                        <p>The company will get notified of your application, and will get back to you within 1-3 weeks.</p>
                    </div>

                </div>

                <div class="span9" id="companyDiv">

                <?php

                $result = mysql_query("SELECT * FROM companies");

                while($row = mysql_fetch_array($result)) {

                    $company_id = $row['company_id'];
                    $name = $row['name'];
                    $company_displayname = $row['company_displayname'];
                    $company_about = $row['company_about'];
                    $internship_name = $row['internship_name'];
                    $internship_description = $row['internship_description'];
                    $internship_location = $row['internship_location'];
                    $internship_type = $row['internship_type'];

                    $isPosted = $row['isPosted'];

                    if ($isPosted) {
                    echo '  <div class="row-fluid" style="height:140px;width:94%;border-radius:4px;border:1px solid #AAAAAA;padding:20px;background-color:#FAFAFA;margin-bottom:17px">
                                <div class="span4" style="background-color:#FEFEFE;padding:10px;margin-right:13px;height:100%;border:1px solid #CCCCCC;line-height:110px;overflow:hidden">
                                    <img src="bin/company-logos/' . $name . '-logo.png" alt="Logo" style="width:100%;line-height:110px;vertical-align:middle" />
                                </div>
                                <div class="span8" style="margin-left:0px;width:450px;">
                                    <div class="row-fluid">
                                        <h2><a href="company.php?name=' . $name . '" >' . $company_displayname . '</a></h2>
                                    </div>
                                    <div class="row-fluid" style="margin-top:-5px">
                                        <span style="color:#259EDB;font-size:10pt;font-weight:bold;margin-left:2px;">' . $internship_name . '</span>
                                    </div>

                                    <div class="row-fluid">
                                        <div class="span9">
                                            <div class="row-fluid" style="height:60px;overflow:hidden;margin-left:3px;margin-top:5px;font-size:9pt;color:#444444">' . substr($company_about, 0, 210) . ' ...</div>
                                            <div class="row-fluid" style="margin-left:3px;margin-top:5px;font-size:9pt;color:#444444">
                                                <div class="span2"><strong>Type: </strong></div>
                                                <div class="span10">' . $internship_type . '</div>
                                            </div>
                                        </div>
                                        <div class="span3" style="margin-top:5px">';

                                            if (isset($_SESSION['logged'])) {

                                                $query = "SELECT *
                                                        FROM applications
                                                        WHERE company_id = '$company_id' AND user_id = '$id';";
                                                $result2 = mysql_query($query);
                                                if(mysql_num_rows($result2) > 0)
                                                    echo '<a class="btn btn-primary btn-large disabled" style="width:80%;height:26px;font-size:14pt;padding-top:13px">Applied</a>';
                                                else
                                                    echo '<a class="btn btn-primary btn-large" data-toggle="modal" href="#' . $company_id . '-modal" style="width:80%;height:26px;font-size:14pt;padding-top:13px">Apply</a>';
                                            }
                                            else
                                                echo '<a class="btn btn-primary btn-large" href="login.php" style="width:80%;height:26px;font-size:14pt;padding-top:13px">Apply</a>';
                                                
                    echo                    '<a href="company.php?name=' . $name . '" class="btn btn-info btn-large" style="width:80%;height:14px;font-size:10pt;margin-top:3px;padding-top:6px"><span style="">More info</span></a>
                                        </div>
                                    </div>
                                </div>
         
                            </div>
                            <div class="modal hide" id="' . $company_id . '-modal">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h3>Confirm Application</h3>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to apply to ' . $company_displayname . '?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                                    <form action="search.php" method="post" style="display:inline">
                                        <input type="hidden" name="company_displayname" value="' . $company_displayname . '" />
                                        <button type="submit" name="ac" value="' . $company_id . '" href="#" class="btn btn-primary">Submit Application</button>
                                    </form>
                                </div>
                            </div>';
                    }
                }
                ?>

                </div>
            

            </div>


        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
