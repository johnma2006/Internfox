<?php 
session_start(); 
include "config.php";
include "require_admin.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Student Profile</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="well" class="content">

            <a href="student_list.php" class="btn"><i class="icon-arrow-left"></i> Back to Student List</a><hr />

            <?php
            $id = mysql_real_escape_string(filter_var($_GET['id'], FILTER_SANITIZE_STRING));

            $result = mysql_query("SELECT * FROM users WHERE id='$id'");
            $user = mysql_fetch_assoc($result);

            if (!(mysql_num_rows($result) > 0)) {
                echo '<div class="alert alert-error">No user exists.</div>';
                die();
            }

            $activities = mysql_query("SELECT * FROM activities WHERE id='$id'");
            ?>

            <h2 style="display:inline"><?php echo $user['fname'] . " " . $user['lname'] ?><span style="font-weight:normal"> Profile Info</span></h2><br /><br />

            <div class="row-fluid">
                <div class="span4">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td style="width:100px"><strong>Email</strong></td>
                                <td style="width:200px"><?php echo $user['email'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>First Name</strong></td>
                                <td><?php echo $user['fname'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Last Name</strong></td>
                                <td><?php echo $user['lname'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td><?php echo $user['gender'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Birth Date</strong></td>
                                <td><?php echo $user['dob'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Zip Code</strong></td>
                                <td><?php echo $user['zipcode'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Resume</strong></td>
                                <td><a href="#">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="span8 shadow well-white" style="border:1px solid #AAAAAA;padding:20px">
                    <!-- Objective ###################################################################################### -->
                    <br /><h2>Summary</h2><br />
                    <div class="row-fluid">
                        <div class="span11" style="margin-left:5px">
                            <?php 
                            if (isset($user['objective']) && trim($user['objective']) != '')
                                echo '<p style="white-space:pre-wrap">' . $user['objective'] . '</p>'; 
                            else 
                                echo '<p style="margin-left:10px"><em>Write a short description about yourself. This may include major achievements, relevant skills, character and personality traits, or future goals.</em></p>';
                            ?>
                        </div>
                    </div>
                    <hr />
                    <!-- Interests ###################################################################################### -->
                    <h2>Interests</h2><br />
                    <div class="row-fluid">
                        <div class="span11" style="margin-left:5px">
                            <p>I am primarily interested in internships in:</p>
                            <ul>
                                <?php
                                if (isset($user['technology_interest']) && $user['technology_interest'])
                                    echo '<li style="margin-top:3px">Technology</li>';
                                if (isset($user['science_interest']) && $user['science_interest'])
                                    echo '<li style="margin-top:3px">Science</li>';
                                if (isset($user['government_interest']) && $user['government_interest'])
                                    echo '<li style="margin-top:3px">Government</li>';
                                if (isset($user['business_interest']) && $user['business_interest'])
                                    echo '<li style="margin-top:3px">Business / Marketing</li>';
                                if (isset($user['journalism_interest']) && $user['journalism_interest'])
                                    echo '<li style="margin-top:3px">Journalism</li>';
                                if ((!isset($user['technology_interest']) || !$user['technology_interest']) && (!isset($user['science_interest']) || !$user['science_interest']) && (!isset($user['government_interest']) || !$user['government_interest']) && (!isset($user['business_interest']) || !$user['business_interest']) && (!isset($user['journalism_interest']) || !$user['journalism_interest']))
                                    echo '<p style="margin-left:-10px"><em>Filling this out will let employers know what types of internships you are most interested in.</em></p>';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <!-- Work and Extracurriculars ###################################################################################### -->
                    <h2>Work and Extracurriculars</h2><br />

                    <?php
                    if (mysql_num_rows($activities) > 0)
                        mysql_data_seek($activities, 0);
                    else
                        echo '<p style="margin-left:10px"><em>Add important activities that you have participated in throughout high school, such as work, volunteering, or extracurricular activities. Emphasize skills and achievements, and give proof of your potential value.</em></p>';

                    while($activity = mysql_fetch_array($activities)) {

                        $activity_id = $activity['activity_id'];
                        $activity_name = $activity['activity_name'];
                        $activity_description = $activity['activity_description'];

                        echo '  <div class="row-fluid" id="work-extracurricular-' . $activity_id . '" style="margin-bottom:12px">
                                    <div class="span11" style="margin-left:5px">
                                        <h3 style="color:#444444;margin-bottom:10px">' . $activity_name . '</h3>
                                        <p style="margin-left:10px;white-space:pre-wrap">' . $activity_description . '</p>
                                    </div>
                                </div>
                                ';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

</body>

</html>
