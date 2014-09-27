<?php 
session_start(); 
include "config.php";
include "require_admin.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; <?php echo $_GET['name'] ?> Company Info</title>
    <?php include "head.php" ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#company-info-button").click(function () {
                $("#company-info").hide();
                $("#company-info-button").hide();
                $("#company-info-edit").show();
                $("#company-info-cancel-button").show();
            });
            $("#company-info-cancel-button").click(function () {
                $("#company-info").show();
                $("#company-info-button").show();
                $("#company-info-edit").hide();
                $("#company-info-cancel-button").hide();
            });
        });
    </script>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="well" class="content">

            <a href="company_list.php" class="btn"><i class="icon-arrow-left"></i> Back to Company List</a><hr />

            <?php

            $name = $_GET['name'];
            $result = mysql_query("SELECT * FROM companies WHERE name='$name'");
            $company = mysql_fetch_assoc($result);

            if (!(mysql_num_rows($result) > 0)) {
                echo '<div class="alert alert-error">No company exists.</div>';
                die();
            }

            $company_id = $company['company_id'];

            if (isset($_POST['ac'])) {
                    
                if (isset($_POST['save'])) {
                    
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
                    
                    $isPosted = $_POST['isPosted'];

                    $query = "  UPDATE companies 
                                SET contact_person='$contact_person', 
                                    contact_email='$contact_email', 
                                    company_about='$company_about', 
                                    company_website='$company_website', 
                                    company_operatinghours='$company_operatinghours',
                                     
                                    internship_name='$internship_name', 
                                    internship_description='$internship_description', 
                                    internship_type='$internship_type', 
                                    internship_date='$internship_date', 
                                    internship_deadline='$internship_deadline', 
                                    internship_location='$internship_location', 
                                    internship_compensation='$internship_compensation',
                                    internship_hours='$internship_hours',

                                    isPosted='$isPosted'
                                WHERE company_id='$company_id'";
                    mysql_query($query);

                    echo '<div class="alert alert-success">
                                <i class="icon-thumbs-up"></i> Your changes have been saved.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                    }
                    else if (isset($_POST['delete'])) {
                        $query = "DELETE FROM companies
                                    WHERE company_id='$company_id'";
                        mysql_query($query);
                        echo '  <a href="company_list.php" class="btn"><i class="icon-arrow-left"></i> Back to Company List</a><hr />
                                <div class="alert alert-error">
                                    <i class="icon-trash"></i> Listing has been deleted.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                </div>';
                        die();
                    }
                }
                $result = mysql_query("SELECT * FROM companies WHERE name='$name'");
                $company = mysql_fetch_assoc($result);

                $company_displayname = $company['company_displayname'];
                $contact_person = $company['contact_person'];
                $contact_email = $company['contact_email'];
                $company_about = $company['company_about'];
                $company_website = $company['company_website'];
                $company_operatinghours = $company['company_operatinghours'];

                $internship_name = $company['internship_name'];
                $internship_description = $company['internship_description'];
                $internship_type = $company['internship_type'];
                $internship_date = $company['internship_date'];
                $internship_deadline = $company['internship_deadline'];
                $internship_location = $company['internship_location'];
                $internship_compensation = $company['internship_compensation'];
                $internship_hours = $company['internship_hours'];

                $isPosted = $company['isPosted'];


            ?>
            <h2 style="display:inline"><?php echo $company_displayname ?> <span style="font-weight:normal">Company Info</span></h2>
            <button class="btn" id="company-info-cancel-button" style="float:right;display:none"><i class="icon-remove"></i> Cancel</button>
            <button class="btn" id="company-info-button" style="float:right"><i class="icon-pencil"></i> Edit Company Info</button>

            <br />
            <br />

            <div id="company-info">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td style="width:180px"><strong>Logo</strong></td>
                            <td><img src="bin/company-logos/<?php echo $name ?>-logo.png" alt="Image has not been uploaded" /></td>
                        </tr>
                        <tr>
                            <td><strong>Contact Person</strong></td>
                            <td><?php echo $contact_person ?></td>
                        </tr>
                        <tr>
                            <td><strong>Contact Email</strong></td>
                            <td><?php echo $contact_email ?></td>
                        </tr>
                        <tr>
                            <td><strong>About Company</strong></td>
                            <td style="white-space: pre-wrap;"><?php echo $company_about ?></td>
                        </tr>
                        <tr>
                            <td><strong>Company Website</strong></td>
                            <td><?php echo $company_website ?></td>
                        </tr>
                        <tr>
                            <td><strong>Operating Hours</strong></td>
                            <td><?php echo $company_operatinghours  ?></td>
                        </tr>

                        <tr>
                            <td><strong>Name of Internship</strong></td>
                            <td><?php echo $internship_name  ?></td>
                        </tr>
                        <tr>
                            <td><strong>Description of Internship</strong></td>
                            <td style="white-space: pre-wrap;"><?php echo $internship_description ?></td>
                        </tr>
                        <tr>
                            <td><strong>Type of Internship</strong></td>
                            <td><?php echo $internship_type ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Internship</strong></td>
                            <td><?php echo $internship_date ?></td>
                        </tr>
                        <tr>
                            <td><strong>Deadline of Application</strong></td>
                            <td><?php echo $internship_deadline ?></td>
                        </tr>
                        <tr>
                            <td><strong>Location of Company</strong></td>
                            <td><?php echo $internship_location ?></td>
                        </tr>
                        <tr>
                            <td><strong>Compensation</strong></td>
                            <td><?php echo $internship_compensation  ?></td>
                        </tr>
                        <tr>
                            <td><strong>Operating Hours</strong></td>
                            <td><?php echo $internship_hours ?></td>
                        </tr>
                        <tr>
                            <td><strong>Post on Website</strong></td>
                            <td><?php if ($isPosted) echo "Yes"; else echo "No"; ?></td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div id="company-info-edit" style="display:none">
                <form action="company_info.php?name=<?php echo $name ?>" method="post"><input name="ac" type="hidden" value="logged" />
                    <table class="table table-bordered">
                        <tbody>
                            <tr style="width:180px">
                                <td style="width:180px"><strong>Logo</strong></td>
                                <td>bin/company-logos/<?php echo $name ?>-logo.png</td>
                            </tr>
                            <tr>
                                <td><strong>Contact Person</strong></td>
                                <td><input name="contact_person" type="text" class="span9" value="<?php echo $contact_person ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Contact Email</strong></td>
                                <td><input name="contact_email" type="text" class="span9" value="<?php echo $contact_email ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>About Company</strong></td>
                                <td><textarea name="company_about" class="span9" rows="5" style="resize:none"><?php echo $company_about ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Company Website</strong></td>
                                <td><textarea name="company_website" class="span9" rows="5" style="resize:none"><?php echo $company_website ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Operating Hours</strong></td>
                                <td><input name="company_operatinghours" type="text" class="span9" value="<?php echo $company_operatinghours ?>" /></td>
                            </tr>

                            <tr>
                                <td><strong>Name of Internship</strong></td>
                                <td><input name="internship_name" type="text" class="span9" value="<?php echo $internship_name ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Description of Internship</strong></td>
                                <td><textarea name="internship_description" class="span9" rows="10" style="resize:none"><?php echo $internship_description ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Type of Internship</strong></td>
                                <td><input name="internship_type" type="text" class="span9" value="<?php echo $internship_type ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Internship</strong></td>
                                <td><input name="internship_date" type="text" class="span9" value="<?php echo $internship_date ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Deadline of Application</strong></td>
                                <td><input name="internship_deadline" type="text" class="span9" value="<?php echo $internship_deadline ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Location of Company</strong></td>
                                <td><input name="internship_location" type="text" class="span9" value="<?php echo $internship_location ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Compensation</strong></td>
                                <td>
                                    <input type="radio" name="internship_compensation" value="Paid" <?php if ($internship_compensation == "Paid") echo 'checked="checked"'; ?>> Paid<br />
                                    <input type="radio" name="internship_compensation" value="Unpaid" <?php if ($internship_compensation == "Unpaid") echo'checked="checked"'; ?>/> Unpaid<br />
                                    <input type="radio" name="internship_compensation" value="" <?php if ($internship_compensation == "") echo'checked="checked"'; ?>/> Not specified
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Operating Hours</strong></td>
                                <td><input name="internship_hours" type="text" class="span9" value="<?php echo $internship_hours ?>" /></td>
                            </tr>
                            <tr>
                                <td><strong>Post Listing</strong></td>
                                <td>
                                    <input type="radio" name="isPosted" value="1" <?php if ($isPosted) echo 'checked="checked"'; ?>> Yes<br />
                                    <input type="radio" name="isPosted" value="0" <?php if (!$isPosted) echo'checked="checked"'; ?>/> No
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <button name="delete" value="clicked" type="submit" class="btn btn-danger" style="float:right" onclick="return confirm('Are you sure you want to delete this listing?');"><i class="icon-trash icon-white"></i> Delete</button>
                    <button name="save" value="clicked" type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i> Save Changes</button><br />

                </form>

            </div>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
