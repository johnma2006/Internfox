<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox - Post Listing</title>
    <link rel="shortcut icon" href="bin/favicon2.ico" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
            
</head>

<body>

    <div class="container">

        <img src="bin/logo1.png" alt="logo" width="240px" />

        <div class="well">

            <?php

            if (isset($_POST['ac'])) {
                    
                $company_displayname = mysql_real_escape_string(filter_var($_POST['company_displayname'], FILTER_SANITIZE_STRING));

                $name = trim($company_displayname);
                while (strpos($name, " ") != false)
                    $name = substr($name, 0, strpos($name," ")) . '-' . substr($name, strpos($name," ") + 1);
                $name = strtolower($name);

                $internship_name = trim(mysql_real_escape_string(filter_var($_POST['internship_name'], FILTER_SANITIZE_STRING)));
                $internship_location = trim(mysql_real_escape_string(filter_var($_POST['internship_location'], FILTER_SANITIZE_STRING)));
                $internship_description = trim(mysql_real_escape_string(filter_var($_POST['internship_description'], FILTER_SANITIZE_STRING)));
                $internship_hours = trim(mysql_real_escape_string(filter_var($_POST['internship_hours'], FILTER_SANITIZE_STRING)));

                $internship_type = $_POST['internship_type'];

                if ($internship_type == "Other" && isset($_POST['internship_type_other'])) {
                    $internship_type = $_POST['internship_type_other'];
                }

                $contact_person = trim(mysql_real_escape_string(filter_var($_POST['contact_person'], FILTER_SANITIZE_STRING)));
                $contact_email = trim(mysql_real_escape_string(filter_var($_POST['contact_email'], FILTER_SANITIZE_STRING)));
                $company_website = trim(mysql_real_escape_string(filter_var($_POST['company_website'], FILTER_SANITIZE_URL)));
                $company_logo = trim(mysql_real_escape_string(filter_var($_POST['company_logo'], FILTER_SANITIZE_URL)));


                $query = "  INSERT INTO companies (name, company_displayname, internship_name, internship_location, internship_type, internship_description, internship_hours, contact_person, contact_email, company_website, company_logo)
                            VALUES ('$name', '$company_displayname', '$internship_name', '$internship_location', '$internship_type', '$internship_description', '$internship_hours', '$contact_person', '$contact_email', '$company_website', '$company_logo');";
                mysql_query($query);

                    include 'sendgrid-sendgrid-php-c483570/SendGrid_loader.php';
                    $sendgrid = new SendGrid('app5835073@heroku.com', '45xubqst');
                
                    $message = 'New company listing has been submitted.';
                        
                    $mail = new SendGrid\Mail();
                    $mail->addTo('johnma2006@gmail.com')->
                           setFrom('listing@internfox.com')->
                           setSubject('Internfox: New Company Listing')->
                           setText($message)->
                           setHtml($message);
                
                    $sendgrid->web->send($mail);



                $_SESSION['message'] = '<div class="alert alert-success">
                                            <i class="icon-thumbs-down"></i> Listing has been submitted.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                        </div>';
                header('Location: index.php');
                die();
            }

            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
            <h2 style="text-align:center;font-weight:normal">Post Listing</h2>
            <br />

            <form action="http://www.internfox.com/listing/" method="post"><input name="ac" type="hidden" value="logged" />
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="150px"><strong>Job Title</strong><br /><span style="font-size:8pt">(e.g. Software Development Intern, Market Research Intern)</span></td>
                            <td><input name="internship_name" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td><strong>Job Location</strong></td>
                            <td><input name="internship_location" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td><strong>Type of Internship</strong></td>
                            <td>
                                <select name="internship_type" class="span7">
                                    <option>-Select One-</option>
                                    <option value="">Arts</option>
                                    <option value="Business & Finance">Business and Finance</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Graphic Design">Graphic Design</option>
                                    <option value="IT">IT</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Other">Other (please specify)</option>
                                </select><br />
                                If other, please specify: <input id="internship_type_other" name="internship_type_other" type="text" class="span5"/>
                            </td>
                        <tr>
                            <td><strong>Job Description</strong></td>
                            <td><textarea name="internship_description" class="span7" rows="10" style="resize:none"></textarea></td>
                        </tr>
                        <tr>
                            <td><strong>Hours per Week</strong></td>
                            <td>
                                <select name="internship_hours" class="span7">
                                    <option>-Select One-</option>
                                    <option value="5-10">5-10</option>
                                    <option value="10-15">10-15</option>
                                    <option value="15-25">15-25</option>
                                    <option value="25+">25+</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3>Contact Info</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="150px"><strong>Name</strong></td>
                            <td><input name="contact_person" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><input name="contact_email" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td width="150px"><strong>Company Name</strong></td>
                            <td><input name="company_displayname" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td><strong>Company Website</strong></td>
                            <td><input name="company_website" type="text" class="span7" /></td>
                        </tr>
                        <tr>
                            <td><strong>Link to Company Logo</strong></td>
                            <td><input name="company_logo" type="text" class="span7" /></td>
                        </tr>
                    </tbody>

                </table>
                <button name="save" value="clicked" type="submit" class="btn btn-primary" style="float:right;margin-right:3px">Submit Listing</button><br />

            </form>

        </div>
    </div>

</body>

</html>
