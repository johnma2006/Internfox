<?php 
session_start(); 
include "config.php";
include "require_admin.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Add Company</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="well" class="content">

            <?php

            if (isset($_POST['ac'])) {
                    
                $company_displayname = mysql_real_escape_string(filter_var($_POST['company_displayname'], FILTER_SANITIZE_STRING));

                $name = $company_displayname;
                while (strpos($name, " ") != false)
                    $name = substr($name, 0, strpos($name," ")) . '-' . substr($name, strpos($name," ") + 1);
                $name = strtolower($name);

                $contact_person = mysql_real_escape_string(filter_var($_POST['contact_person'], FILTER_SANITIZE_STRING));
                $contact_email = mysql_real_escape_string(filter_var($_POST['contact_email'], FILTER_SANITIZE_STRING));
                $company_about = mysql_real_escape_string(filter_var($_POST['company_about'], FILTER_SANITIZE_STRING));
                $company_website = mysql_real_escape_string(filter_var($_POST['company_website'], FILTER_SANITIZE_STRING));
                $company_operatinghours = mysql_real_escape_string(filter_var($_POST['company_operatinghours'], FILTER_SANITIZE_STRING));
                    
                $internship_name = mysql_real_escape_string(filter_var($_POST['internship_name'], FILTER_SANITIZE_STRING));
                $internship_description = mysql_real_escape_string(filter_var($_POST['internship_description'], FILTER_SANITIZE_STRING));
                $internship_type = mysql_real_escape_string(filter_var($_POST['internship_type'], FILTER_SANITIZE_STRING));
                $internship_date = mysql_real_escape_string(filter_var($_POST['internship_date'], FILTER_SANITIZE_STRING));
                $internship_deadline = mysql_real_escape_string(filter_var($_POST['internship_deadline'], FILTER_SANITIZE_STRING));
                $internship_location = mysql_real_escape_string(filter_var($_POST['internship_location'], FILTER_SANITIZE_STRING));
                $internship_compensation = mysql_real_escape_string(filter_var($_POST['internship_compensation'], FILTER_SANITIZE_STRING));
                $internship_hours = mysql_real_escape_string(filter_var($_POST['internship_hours'], FILTER_SANITIZE_STRING));
                    
                $isPosted = '0';

                $query = "  INSERT INTO companies (name, company_displayname, contact_person, contact_email, company_about, company_website , company_operatinghours , internship_description, internship_type, internship_date, internship_deadline, internship_location, internship_compensation , internship_hours ,isPosted)
                            VALUES ('$name', '$company_displayname', '$contact_person', '$contact_email', '$company_about', '$company_website' , '$company_operatinghours' , '$internship_description', '$internship_type', '$internship_date', '$internship_deadline', '$internship_location', '$internship_compensation' , '$internship_hours' , '$isPosted');";
                mysql_query($query);

                echo '<div class="alert alert-success">
                            <i class="icon-thumbs-up"></i> Company has been added.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                        </div>';
            }
            ?>
            <a href="company_list.php" class="btn"><i class="icon-arrow-left"></i> Back to Company List</a><hr />
            <h2 style="display:inline;font-weight:normal">Add Company</h2>
            <br />

            <form action="company_add.php" method="post"><input name="ac" type="hidden" value="logged" />
                    <table class="table table-bordered">
                        <tbody>
                            <tr style="width:180px">
                                <td><strong>Company Name</strong></td>
                                <td><input name="company_displayname" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Contact Person</strong></td>
                                <td><input name="contact_person" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Contact Email</strong></td>
                                <td><input name="contact_email" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>About Company</strong></td>
                                <td><textarea name="company_about" class="span9" rows="5" style="resize:none"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Company Website</strong></td>
                                <td><textarea name="company_website" class="span9" rows="5" style="resize:none"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Operating Hours</strong></td>
                                <td><input name="company_operatinghours" type="text" class="span9" /></td>
                            </tr>

                            <tr>
                                <td><strong>Name of Internship</strong></td>
                                <td><input name="internship_name" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Description of Internship</strong></td>
                                <td><textarea name="internship_description" class="span9" rows="5" style="resize:none"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Type of Internship</strong></td>
                                <td><input name="internship_type" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Internship</strong></td>
                                <td><input name="internship_date" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Deadline of Application</strong></td>
                                <td><input name="internship_deadline" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Location of Company</strong></td>
                                <td><input name="internship_location" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Compensation</strong></td>
                                <td>
                                    <input type="radio" name="internship_compensation" value="Paid" /> Paid<br />
                                    <input type="radio" name="internship_compensation" value="Unpaid" /> Unpaid<br />
                                    <input type="radio" name="internship_compensation" value="" /> Not specified
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Operating Hours</strong></td>
                                <td><input name="internship_hours" type="text" class="span9" /></td>
                            </tr>
                            <tr>
                                <td><strong>Post Listing</strong></td>
                                <td>
                                    <input type="radio" name="isPosted" value="1" /> Yes <br />
                                    <input type="radio" name="isPosted" value="0" /> No
                                </td>
                            </tr>
                        </tbody>

                    </table>
                <button name="save" value="clicked" type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i> Add Company</button><br />

            </form>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
