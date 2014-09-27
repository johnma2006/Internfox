<?php 
session_start(); 
include "config.php";
include "require_login.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Profile</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <div class="row-fluid">
            <?php
            if (isset($_POST['ac'])) {
                if ($_POST['ac'] == "change-contact") {
                    $formValid = TRUE;
                    $fname = $_POST['fname'];
                    if (isset($_POST['fname'])) {  
                        $fname = mysql_real_escape_string(filter_var($_POST['fname'], FILTER_SANITIZE_STRING));  
                        if ($fname == "") $formValid = FALSE;
                    }  

                    $lname = $_POST['lname'];
                    if (isset($_POST['lname'])) {  
                        $lname = mysql_real_escape_string(filter_var($_POST['lname'], FILTER_SANITIZE_STRING));  
                        if ($lname == "") $formValid = FALSE;
                    }  

                    if ($formValid) {
                        $query = "UPDATE users 
                                    SET fname='$fname', lname='$lname'
                                    WHERE email='$email'";
                        mysql_query($query);

                        $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-thumbs-up"></i> Your changes have been saved.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                        header('Location: profile.php');
                    }
                    else {
                        $_SESSION['message'] = '<div class="alert alert-error">
                                                    <i class="icon-thumbs-down"></i> There were errors with your input.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                        header('Location: profile.php');
                    }
                }
                if ($_POST['ac'] == "objective-edit") {
                    
                    $objective = $_POST['objective'];
                    if (isset($_POST['objective']))  
                        $objective = mysql_real_escape_string(filter_var($_POST['objective'], FILTER_SANITIZE_STRING));  

                    $query = "  UPDATE users 
                                SET objective='$objective'
                                WHERE email='$email'";
                    mysql_query($query);
                    $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-thumbs-up"></i> Your changes have been saved.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                    header('Location: profile.php');
                }
                if ($_POST['ac'] == "change-interests") {

                    if (isset($_POST['technology_interest']) && $_POST['technology_interest']) $query = "UPDATE users SET technology_interest='1' WHERE email='$email'";
                    else $query = "UPDATE users SET technology_interest='0' WHERE email='$email'";
                    mysql_query($query);

                    if (isset($_POST['science_interest']) && $_POST['science_interest']) $query = "UPDATE users SET science_interest='1' WHERE email='$email'";
                    else $query = "UPDATE users SET science_interest='0' WHERE email='$email'";
                    mysql_query($query);

                    if (isset($_POST['government_interest']) && $_POST['government_interest']) $query = "UPDATE users SET government_interest='1' WHERE email='$email'";
                    else $query = "UPDATE users SET government_interest='0' WHERE email='$email'";
                    mysql_query($query);

                    if (isset($_POST['business_interest']) && $_POST['business_interest']) $query = "UPDATE users SET business_interest='1' WHERE email='$email'";
                    else $query = "UPDATE users SET business_interest='0' WHERE email='$email'";
                    mysql_query($query);

                    if (isset($_POST['journalism_interest']) && $_POST['journalism_interest']) $query = "UPDATE users SET journalism_interest='1' WHERE email='$email'";
                    else $query = "UPDATE users SET journalism_interest='0' WHERE email='$email'";
                    mysql_query($query);

                    $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-thumbs-up"></i> Your changes have been saved.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                    header('Location: profile.php');
                }
                if ($_POST['ac'] == "work-extracurricular-edit") {
                    
                    if (isset($_POST['edit'])) {
                        $activity_id = $_POST['edit'];
                        $formValid = TRUE;
                        $activity_name = $_POST['activity_name'];
                        if (isset($_POST['activity_name'])) {  
                            $activity_name = mysql_real_escape_string(filter_var($_POST['activity_name'], FILTER_SANITIZE_STRING));  
                            if ($activity_name == "") $formValid = FALSE;
                        }  

                        $activity_description = $_POST['activity_description'];
                        if (isset($_POST['activity_description'])) {  
                            $activity_description = mysql_real_escape_string(filter_var($_POST['activity_description'], FILTER_SANITIZE_STRING));  
                            if ($activity_description == "") $formValid = FALSE;
                        }  

                        if ($formValid) {
                            $query = "  UPDATE activities 
                                        SET activity_name='$activity_name', activity_description='$activity_description'
                                        WHERE activity_id='$activity_id'";
                            mysql_query($query);
                            $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-thumbs-up"></i> Your changes have been saved.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                            header('Location: profile.php');
                        }
                        else {
                            $_SESSION['message'] = '<div class="alert alert-error">
                                                    <i class="icon-thumbs-down"></i> There were errors with your input.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                            header('Location: profile.php');
                        }
                    }
                    else if (isset($_POST['delete'])) {
                        $activity_id = $_POST['delete'];
                        $query = "DELETE FROM activities
                                  WHERE activity_id='$activity_id'";
                        mysql_query($query);
                        $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-trash"></i> Activity has been deleted.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                        header('Location: profile.php');
                    }
                }
                if ($_POST['ac'] == "work-extracurricular-add") {
                    
                    $formValid = TRUE;
                    $activity_name = $_POST['activity_name'];
                    if (isset($_POST['activity_name'])) {  
                        $activity_name = mysql_real_escape_string(filter_var($_POST['activity_name'], FILTER_SANITIZE_STRING));  
                        if ($activity_name == "") $formValid = FALSE;
                    }  

                    $activity_description = $_POST['activity_description'];
                    if (isset($_POST['activity_description'])) {  
                        $activity_description = mysql_real_escape_string(filter_var($_POST['activity_description'], FILTER_SANITIZE_STRING));  
                        if ($activity_description == "") $formValid = FALSE;
                    }  

                    if ($formValid) {
                        $query = "INSERT INTO activities (id, activity_name, activity_description)
                                    VALUES ('$id' , '$activity_name' , '$activity_description' )";
                        mysql_query($query);
                        $_SESSION['message'] = '<div class="alert alert-success">
                                                    <i class="icon-thumbs-up"></i> Activity has been added.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                        header('Location: profile.php');
                    }
                    else {
                        $_SESSION['message'] = '<div class="alert alert-error">
                                                    <i class="icon-thumbs-down"></i> There were errors with your input.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                                </div>';
                        header('Location: profile.php');
                    }
                }
            }
            ?>
            </div>

            <script type="text/javascript">
                    $(document).ready(function () {

                        $("#contact-info-button").click(function () {
                            $("#contact-info").hide();
                            $("#contact-info-edit").show();
                        });
                        $("#contact-info-cancel-button").click(function () {
                            $("#contact-info").show();
                            $("#contact-info-edit").hide();
                        });

                        $("#objective-button").click(function () {
                            $("#objective").hide();
                            $("#objective-edit").show();
                        });
                        $("#objective-cancel-button").click(function () {
                            $("#objective").show();
                            $("#objective-edit").hide();
                        });

                        $("#interests-button").click(function () {
                            $("#interests").hide();
                            $("#interests-edit").show();
                        });
                        $("#interests-cancel-button").click(function () {
                            $("#interests").show();
                            $("#interests-edit").hide();
                        });

                        <?php
                        while($activity = mysql_fetch_array($activities)) {
                
                            $activity_id = $activity['activity_id'];
                            echo ' $("#work-extracurricular-' . $activity_id . '-button").click(function () {
                                        $("#work-extracurricular-' . $activity_id . '").hide();
                                        $("#work-extracurricular-' . $activity_id . '-edit").show();
                                    });
                                    $("#work-extracurricular-' . $activity_id . '-cancel-button").click(function () {
                                        $("#work-extracurricular-' . $activity_id . '").show();
                                        $("#work-extracurricular-' . $activity_id . '-edit").hide();
                                    });';
                        }

                        ?>

                        $("#work-extracurricular-add-button").click(function () {
                            $("#work-extracurricular-add-button").hide();
                            $("#work-extracurricular-add").show();
                        });
                        $("#work-extracurricular-add-cancel-button").click(function () {
                            $("#work-extracurricular-add-button").show();
                            $("#work-extracurricular-add").hide();
                        });
                    });
                </script>

            <div class="row-fluid" style="border:1px solid #CCC;padding:1px;color:White;margin-bottom:10px;border-radius:4px">
                <div style="width:940px;height:80px;background-image:url('bin/profilepicture.jpg');padding:30px;border-radius:4px">
                    <br />
                    <h1 class="h1header" style="font-size:36pt;text-shadow:2px 2px #333333">My Profile</h1>
                    <p style="margin-top:10px;font-size:13pt;text-shadow:2px 2px #222222">Create a profile to apply to internships and attract employers.</p>
                </div>
            </div>

            <div class="row-fluid">

                <div class="span3">
                    <div class="well" style="height:100%;padding: 8px 0;border:1px solid #AAAAAA">
                        <ul class="nav nav-list">
                            <li class="nav-header">Navigation</li>
                            <li class="active"><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>
                            <li><a href="account.php"><i class="icon-lock"></i> Account Settings</a></li>
                            <li><a href="applications.php"><i class="icon-file"></i> My Applications</a></li>
                        </ul>
                    </div>
                </div>


                <div class="span9 shadow" style="background-color:white;border:1px solid #AAAAAA;padding:20px">
                    <!-- Contact Info ###################################################################################### -->
                    <div id="contact-info">
                        <button class="btn" id="contact-info-button" style="float:right"><i class="icon-pencil"></i></button>
                        <h1 class="h1header" style="text-align:center;color:#444444;margin-left:35px"><?php echo $user['fname'] . " " . $user['lname']; ?></h1>
                        <p style="text-align:center;font-size:9pt"><?php echo $user['email']; ?></p>
                    </div>
                    <div id="contact-info-edit" class="well" style="display:none;height:70px">
                        <form class="form" action="profile.php" method="post"><input type="hidden" name="ac" value="change-contact" />
                            <a class="btn" id="contact-info-cancel-button" style="float:right"><i class="icon-remove"></i></a> 
                            <button type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i></button>
                            <input name="fname" type="text" value="<?php echo $user['fname']; ?>" placeholder="First Name" class="input-medium" style="width:120px;height:25px;margin-left:28%;font-size:14pt;" />
                            <input name="lname" type="text" value="<?php echo $user['lname']; ?>" placeholder="Last Name" class="input-medium" style="width:120px;height:25px;font-size:14pt;" /><br />
                            <input type="text" value="<?php echo $user['email']; ?>" placeholder="Email" class="input-medium disabled" style="width:194px;margin-left:33%" disabled="disabled" />
                        </form>
                    </div>
                    <hr />
                    <!-- Objective ###################################################################################### -->
                    <div id="objective">
                        <div class="row-fluid">
                            <button class="btn" id="objective-button" style="float:right"><i class="icon-pencil"></i></button> 
                            <h2>About Me</h2><br />
                            <div class="span11" style="margin-left:5px">
                                <?php 
                                if (isset($user['objective']) && trim($user['objective']) != '')
                                    echo '<p style="white-space: pre-wrap">' . $user['objective'] . '</p>'; 
                                else 
                                    echo '<p style="margin-left:10px"><em>Write a short description about yourself. This may include major achievements, relevant skills, character and personality traits, or future goals.</em></p>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="objective-edit" class="well" style="display:none;height:225px">
                        <form class="form" action="profile.php" method="post"><input type="hidden" name="ac" value="objective-edit" />
                            <a class="btn" id="objective-cancel-button" style="float:right"><i class="icon-remove"></i></a> 
                            <button type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i></button>
                            <h2>Summary</h2>
                            
                            <p style="margin-left:5px;margin-top:5px;margin-bottom:10px"><em>Write a short description about yourself. This may include major achievements, relevant skills, character and personality traits, or future goals.</em></p>
                            <textarea name="objective" class="span12" rows="7" style="resize:none"><?php $objective = $user['objective']; echo $objective; ?></textarea>
                        </form>
                    </div>
                    <hr />
                    <!-- Interests ###################################################################################### -->
                    <div id="interests">
                        <div class="row-fluid">
                            <button class="btn" id="interests-button" style="float:right"><i class="icon-pencil"></i></button>
                            <h2>Interests</h2><br />
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
                    </div>
                    <div id="interests-edit" class="well" style="display:none">
                        <form class="form" action="profile.php" method="post"><input type="hidden" name="ac" value="change-interests" />
                            <a class="btn" id="interests-cancel-button" style="float:right"><i class="icon-remove"></i></a> 
                            <button type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i></button>
                            <h2>Interests</h2><br />
                            <!--<p style="margin-left:5px;margin-top:5px;margin-bottom:10px"><em>Filling this out will let employers know what types of internships you are interested in.</em></p>-->
                            <p>I am primarily interested in internships in:</p>
                            <div style="margin-left:15px">
                                <label class="checkbox"><input type="checkbox" name="technology_interest" value="TRUE" <?php if (isset($user['technology_interest']) && $user['technology_interest']) echo 'checked="checked"'; ?> />Technology</label>
                                <label class="checkbox"><input type="checkbox" name="science_interest" value="TRUE" <?php if (isset($user['science_interest']) && $user['science_interest']) echo 'checked="checked"'; ?> />Science</label>
                                <label class="checkbox"><input type="checkbox" name="government_interest" value="TRUE" <?php if (isset($user['government_interest']) && $user['government_interest']) echo 'checked="checked"'; ?> />Government</label>
                                <label class="checkbox"><input type="checkbox" name="business_interest" value="TRUE" <?php if (isset($user['business_interest']) && $user['business_interest']) echo 'checked="checked"'; ?> />Business / Marketing</label>
                                <label class="checkbox"><input type="checkbox" name="journalism_interest" value="TRUE" <?php if (isset($user['journalism_interest']) && $user['journalism_interest']) echo 'checked="checked"'; ?> />Journalism</label>
                            </div>
                        </form>
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
                                        <p style="margin-left:10px;white-space: pre-wrap">' . $activity_description . '</p>
                                    </div>
                                    <button class="btn" id="work-extracurricular-' . $activity_id . '-button" style="float:right"><i class="icon-pencil"></i></button>  
                                </div>
                                <div id="work-extracurricular-' . $activity_id . '-edit" style="display:none">
                                
                                    <form class="form-horizontal well" action="profile.php" method="post"><input type="hidden" name="ac" value="work-extracurricular-edit" />
                                        <a class="btn" id="work-extracurricular-' . $activity_id . '-cancel-button" style="float:right"><i class="icon-remove"></i></a>
                                        <h3 style="text-align:center">Edit Activity</h3>
                                        <label style="font-size:9pt">Title of Activity</label>
                                        <input name="activity_name" type="text" class="span12" value="' . $activity_name . '" /><br />
                                        <label style="font-size:9pt">Description of Activity</label>
                                        <textarea name="activity_description" class="span12" rows="5" style="resize:none">' . $activity_description . '</textarea>
                                        <button name="delete" value="' . $activity_id . '" type="submit" class="btn btn-danger" style="margin-top:8px" onClick="return confirm('; echo "'Are you sure you want to delete this activity?'"; echo ');"><i class="icon-trash icon-white"></i> Delete</button>
                                        <button name="edit" value="' . $activity_id . '" type="submit" class="btn btn-info" style="float:right;margin-right:3px;margin-top:8px"><i class="icon-ok icon-white"></i> Save Changes</button>
                                        <br /><br />
                                    </form>
                                
                                </div>
                                ';
                    }
                    ?>

                    <button id="work-extracurricular-add-button" class="btn" style="float:right"><i class="icon-plus"></i> Add Activity</button>
                    <div id="work-extracurricular-add" style="display:none;margin-top:10px">
                    
                        <form class="form-horizontal well" action="profile.php" method="post"><input type="hidden" name="ac" value="work-extracurricular-add" />
                            <a class="btn" id="work-extracurricular-add-cancel-button" style="float:right;"><i class="icon-remove"></i></a> 
                            <h3 style="text-align:center">Add Activity</h3>

                            <label style="font-size:9pt">Title of Activity</label>
                            <input name="activity_name" type="text" class="span12" /><br />
                            <label style="font-size:9pt">Description of Activity</label>
                            <textarea name="activity_description" class="span12" rows="5" style="resize:none"></textarea>
                            
                            <button type="submit" class="btn btn-info" style="float:right;margin-right:3px;margin-top:8px"><i class="icon-plus icon-white"></i> Add Activity</button>
                            <br /><br />
                        </form>
                    </div>

                    <br /><hr />

                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
