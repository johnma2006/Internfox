<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Login</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <div class="well well-white" style="width:500px;height:240px;margin-left:230px;margin-top:30px">
            <?php

            if (isset($_POST['ac']))
            {
                $formValid = TRUE;
                $email = $_POST['email'];
                $password = $_POST['password'];

                // ############################### Checking if the inputs are valid ###############################

                if (isset($_POST['email'])) {  
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                        $_SESSION['message'] = '<div class="alert alert-error">
                                <i class="icon-user"></i> Email is not valid.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                        header('Location: login.php');
                        die();
                    }  
                }
                if (isset($_POST['password'])) {  
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);  
                    if ($password == "") { 
                        $_SESSION['message'] = '<div class="alert alert-error">
                                <i class="icon-user"></i> Password is not valid.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                        header('Location: login.php');
                        die();
                    }  
                }   

                if ($formValid) {

                    $loginFailed = FALSE;
                    $query = "SELECT password, salt
                            FROM users
                            WHERE email = '$email';";
                    $result = mysql_query($query);
                    if(mysql_num_rows($result) < 1) //no such user exists
                    {
                        $_SESSION['message'] = '<div class="alert alert-error">
                                <i class="icon-user"></i> No such user exists.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                        header('Location: login.php');
                        die();
                    }
                    $userData = mysql_fetch_array($result, MYSQL_ASSOC);
                    $hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
                    if($hash != $userData['password'] && !$loginFailed) //incorrect password
                    {
                        $_SESSION['message'] = '<div class="alert alert-error">
                                <i class="icon-user"></i> Incorrect password.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                        header('Location: login.php');
                        die();
                    }

                    if (!$loginFailed) {
                        session_destroy();
                        session_start();
                        $_SESSION['logged'] = $email;
                        $_SESSION['message'] = '<div class="alert alert-success">
                                <i class="icon-thumbs-up"></i> You have successfully logged in.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
                        header('Location: index.php');
                    }
                }

            }

            ?>
                <h1>Log in</h1><hr />
                <form class="form-horizontal" action="login.php" method="post"><input type="hidden" name="ac" value="log" />
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" maxlength="30" for="email">Email</label>
                            <div class="controls">
                            <input type="text" class="input-xlarge" name="email" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" maxlength="30" for="pass1">Password</label>
                            <div class="controls">
                            <input type="password" class="input-xlarge" name="password" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="submit" class="btn btn-primary" value="Log in" />
                                <br /><br /><span style="font-size:9pt;margin-left:0px;margin-top:35px">Not a user? <a href="register.php">Create an account</a></span>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
