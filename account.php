<?php 
session_start(); 
include "config.php";
include "require_login.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Account Settings</title>
    <?php include "head.php" ?>
    <script type="text/javascript">
        $(document).ready(function () {

            $("#password-change-button").click(function () {
                $("#password-change").hide();
                $("#password-change-edit").show();
            });
            $("#password-change-cancel-button").click(function () {
                $("#password-change").show();
                $("#password-change-edit").hide();
            });
        });
    </script>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <?php     

            if (isset($_POST['ac'])) {
                $formValid = TRUE;
                $oldpass = $_POST['oldpass'];
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];

                // ############################### Checking if the inputs are valid ###############################

                if (isset($_POST['pass1']) && isset($_POST['pass2'])) {
                    if($pass1 != $pass2) {
                        echo '<div class="alert alert-error">
                            <i class="icon-thumbs-up"></i> Passwords do not match.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                          </div>';
                        $formValid = FALSE;
                    }
                } 

                // ############################### Saving Changes ###############################

                if ($formValid) {
                    $email = $_SESSION['logged'];
                    $loginFailed = FALSE;

                    $hash = hash('sha256', $user['salt'] . hash('sha256', $oldpass) );
                    if($hash != $user['password']) //incorrect password
                    {
                        echo '<div class="alert alert-error">
                            <i class="icon-thumbs-up"></i> Incorrect password.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                          </div>';
                        $loginFailed = TRUE;
                    }

                    if (!$loginFailed) {
                        
                        $hash = hash('sha256', $pass1);
                        $hash = hash('sha256', $user['salt'] . $hash);

                        $query = "UPDATE users 
                                SET password='$hash'
                                WHERE email='$email'";
                        mysql_query($query);
                        mysql_close();

                        echo '<div class="alert alert-success">
                            <i class="icon-thumbs-up"></i> Password has been changed.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                          </div>';
                    }
                }

            }
            ?>

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
                            <li><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>
                            <li class="active"><a href="account.php"><i class="icon-lock"></i> Account Settings</a></li>
                            <li><a href="applications.php"><i class="icon-file"></i> My Applications</a></li>
                        </ul>
                    </div>

                </div>

                <div class="span9 shadow" style="background-color:white;border:1px solid #AAAAAA;padding:20px">

                    <div class="row-fluid" style="text-align:center">
                        <h2>Account Settings</h2><hr/>
                    </div>
                    <div class="row-fluid">
                        <div id="password-change">
                            <button class="btn" id="password-change-button" style="float:right"><i class="icon-pencil"></i></button> 
                            <h3>Password</h3><hr />
                        </div>  
                        <div id="password-change-edit" class="well" style="display:none">
                            <form class="form-horizontal" action="account.php" method="post"><input type="hidden" name="ac" value="log" />
                                <h3 style="display:inline">Password</h3>
                                <a class="btn" id="password-change-cancel-button" style="float:right"><i class="icon-remove"></i></a> 
                                <button type="submit" class="btn btn-info" style="float:right;margin-right:3px"><i class="icon-ok icon-white"></i></button>
                                <br /><br />
                                <fieldset>
                                   <div class="control-group">
                                        <label class="control-label" for="fname">Old Password</label>
                                        <div class="controls">
                                        <input type="password" class="input-xlarge" name="oldpass" maxlength="30" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="lname">New Password</label>
                                        <div class="controls">
                                        <input type="password" class="input-xlarge" name="pass1" maxlength="30"  />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="zipcode">Re-enter New Password</label>
                                        <div class="controls">
                                        <input type="password" class="input-xlarge" name="pass2" maxlength="30"  />
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>  
                    </div>  

                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
