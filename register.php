<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Register</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <div class="row-fluid">

            <div class="span4 well-white">
                <h3>Already have an account?</h3><br />
                <div class="well">
                    <form class="form-inline" action="login.php" method="post"><input type="hidden" name="ac" value="log" />
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" maxlength="30" for="email">Email</label>
                                <div class="controls">
                                <input type="text" class="input-large" name="email" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" maxlength="30" for="pass1">Password</label>
                                <div class="controls">
                                <input type="password" class="input-large" name="password" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" class="btn btn-primary" value="Log in" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>	
			</div>	

            <div class="span8 shadow well-white">

            <?php     

            if (isset($_POST['ac'])) {
                $formValid = TRUE;
                $email = $_POST['email'];
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $dob = $_POST['dobyear'] . $_POST['dobmonth'] . $_POST['dobday'];
                $zipcode = $_POST['zipcode'];
                $gender = $_POST['gender'];

                if (isset($_POST['email'])) $_SESSION['register_email'] = $email;
                if (isset($_POST['fname'])) $_SESSION['register_fname'] = $fname;
                if (isset($_POST['lname'])) $_SESSION['register_lname'] = $lname;
                if (isset($_POST['dobyear'])) $_SESSION['register_dobyear'] = $_POST['dobyear'];
                if (isset($_POST['dobmonth'])) $_SESSION['register_dobmonth'] = $_POST['dobmonth'];
                if (isset($_POST['dobday'])) $_SESSION['register_dobday'] = $_POST['dobday'];
                if (isset($_POST['zipcode'])) $_SESSION['register_zipcode'] = $zipcode;
                if (isset($_POST['gender'])) $_SESSION['register_gender'] = $gender;

                // ############################### Checking if the inputs are valid ###############################



                if (isset($_POST['email'])) {  
                    $email = mysql_real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)); 
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                        echo '<div class="alert alert-error">
                               <i class="icon-thumbs-down"></i> Email is not valid<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                              </div>';
                        $formValid = FALSE;
                    } 
                    else {
                        $query = "SELECT *
                                FROM users
                                WHERE email = '$email';";
                        $result = mysql_query($query);
                        if(mysql_num_rows($result) > 0)
                        {
                            echo '<div class="alert alert-error">
                                       <i class="icon-thumbs-down"></i> User already exists.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                      </div>';
                            $loginFailed = TRUE;
                        }
                    } 
                }

                if (isset($_POST['pass1'])) {
                    if (strlen($_POST['pass1']) < 5 || strlen($_POST['pass1']) > 20) {
                        echo '<div class="alert alert-error">
                               <i class="icon-thumbs-down"></i> Password must be 5 - 20 characters long.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                              </div>';
                        $formValid = FALSE;
                    }
                    else if (isset($_POST['pass2'])) {
                        if($pass1 != $pass2) {
                            echo '<div class="alert alert-error">
                                   <i class="icon-thumbs-down"></i> Passwords do not match.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                  </div>';
                            $formValid = FALSE;
                        }
                    }
                }

                if (isset($_POST['fname'])) {  
                    $fname = mysql_real_escape_string(filter_var($_POST['fname'], FILTER_SANITIZE_STRING));  
                    if ($fname == "") { 
                        echo '<div class="alert alert-error">
                               <i class="icon-thumbs-down"></i> First name is not valid<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                              </div>';
                        $formValid = FALSE;
                    }  
                }  

                if (isset($_POST['lname'])) {  
                    $lname = mysql_real_escape_string(filter_var($_POST['lname'], FILTER_SANITIZE_STRING));  
                    if ($lname == "") { 
                        echo '<div class="alert alert-error">
                               <i class="icon-thumbs-down"></i> Last name is not valid.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                              </div>';
                        $formValid = FALSE;
                    }  
                }  

                if (isset($_POST['zipcode'])) {  
                    $zipcode = mysql_real_escape_string(filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT));  
                    if ($zipcode == "") { 
                        echo '<div class="alert alert-error">
                               <i class="icon-thumbs-down"></i> Zipcode is not valid<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                              </div>';
                        $formValid = FALSE;
                    }  
                } 

                // ############################### Registering ###############################

                if ($formValid) {

                    $hash = hash('sha256', $pass1);
                    function createSalt()//creates a 3 character sequence
                    {
                        $string = md5(uniqid(rand(), true));
                        return substr($string, 0, 3);
                    }
                    $salt = createSalt();
                    $hash = hash('sha256', $salt . $hash);

                    $query = "INSERT INTO users ( email, password, salt , fname , lname , dob , zipcode , gender , isConfirmed)
                            VALUES ( '$email' , '$hash' , '$salt'  , '$fname' , '$lname' , $dob , '$zipcode' , '$gender' , '0');";
                    mysql_query($query);



                    include 'sendgrid-sendgrid-php-c483570/SendGrid_loader.php';
                    $sendgrid = new SendGrid('app5835073@heroku.com', '45xubqst');
                
                    $message = 'Hello ' . $fname . ',<br /><br />
                                Thanks for registering with Internfox!<br /><br />
                                Please click on the following link below to confirm your account.:<br />
                                <a href="http://www.internfox.com/confirm.php?id=' . $email . '?' . substr(hash('sha256', $email . $salt), 0, 10) . '" style="margin-left:30px">http://www.internfox.com/confirm.php?id=' . $email . '?' . substr(hash('sha256', $email . $salt), 0, 10) . '</a><br /><br />
                                Now you can start filling out your profile and applying to internships!<br /><br />
                                Best of Luck,<br />
                                Internfox
                                ';
                        
                    $mail = new SendGrid\Mail();
                    $mail->addTo($email)->
                           setFrom('Registration@internfox.com')->
                           setSubject('Confirm your Internfox account')->
                           setText($message)->
                           setHtml($message);
                
                    $sendgrid->web->send($mail);



                    header('Location: register_success.php');
                }
            }

            ?>

                <h1>Register</h1><br />
                <form class="form-horizontal well" name="register" action="register.php" method="post"><input type="hidden" name="ac" value="log" />
                  <fieldset>
                    <h2>Account Information</h2><br />
                    <div class="control-group">
                      <label class="control-label" for="email">Email Address</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="30" name="email" value="<?php if(isset($_SESSION['register_email'])) echo $_SESSION['register_email'] ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pass1">Password</label>
                      <div class="controls">
                        <input type="password" class="input-xlarge" maxlength="20" name="pass1" /><br />
                        <span style="font-size:8pt;color:#888888">5 - 20 characters long.</span>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pass2">Re-enter Password</label>
                      <div class="controls">
                        <input type="password" class="input-xlarge" maxlength="20" name="pass2" />
                      </div>
                    </div>

                    <h2>General Information</h2><br />
                    <div class="control-group">
                      <label class="control-label" for="fname">First Name</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="20" name="fname" value="<?php if(isset($_SESSION['register_fname'])) echo $_SESSION['register_fname'] ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="lname">Last Name</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" maxlength="20" name="lname" value="<?php if(isset($_SESSION['register_lname'])) echo $_SESSION['register_lname'] ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gender">Gender</label>
                        <div class="controls">
                            <select name="gender" style="width:90px">
                                <option value="Male" <?php if(isset($_SESSION['register_gender'])) { if($_SESSION['register_gender'] == 'Male') echo 'selected="selected"'; } ?>>Male</option>
                                <option value="Female" <?php if(isset($_SESSION['register_gender'])) { if($_SESSION['register_gender'] == 'Female') echo 'selected="selected"'; } ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="lname">Date of Birth</label>
                      <div class="controls">
                        <select name="dobmonth" style="width:100px">
                            <option value="01" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '01') echo 'selected="selected"'; } ?>>January</option>
                            <option value="02" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '02') echo 'selected="selected"'; } ?>>February</option>
                            <option value="03" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '03') echo 'selected="selected"'; } ?>>March</option>
                            <option value="04" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '04') echo 'selected="selected"'; } ?>>April</option>
                            <option value="05" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '05') echo 'selected="selected"'; } ?>>May</option>
                            <option value="06" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '06') echo 'selected="selected"'; } ?>>June</option>
                            <option value="07" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '07') echo 'selected="selected"'; } ?>>July</option>
                            <option value="08" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '08') echo 'selected="selected"'; } ?>>August</option>
                            <option value="09" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '09') echo 'selected="selected"'; } ?>>September</option>
                            <option value="10" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '10') echo 'selected="selected"'; } ?>>October</option>
                            <option value="11" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '11') echo 'selected="selected"'; } ?>>November</option>
                            <option value="12" <?php if(isset($_SESSION['register_dobmonth'])) { if($_SESSION['register_dobmonth'] == '12') echo 'selected="selected"'; } ?>>December</option>
                        </select>
                        <select name="dobday" style="width:50px">
                            <?php 
                            for ($i = 1; $i <= 31; $i++) {
                                echo '<option value="' . $i . '"';
                                if(isset($_SESSION['register_dobday'])) { 
                                    if($_SESSION['register_dobday'] == $i) echo 'selected="selected"';
                                }
                                echo '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                        <select name="dobyear" style="width:70px">
                            <option value="1993" <?php if(isset($_SESSION['register_dobyear'])) { if($_SESSION['register_dobyear'] == '1993') echo 'selected="selected"'; } ?>>1993</option>
                            <option value="1994" <?php if(isset($_SESSION['register_dobyear'])) { if($_SESSION['register_dobyear'] == '1994') echo 'selected="selected"'; } ?>>1994</option>
                            <option value="1995" <?php if(isset($_SESSION['register_dobyear'])) { if($_SESSION['register_dobyear'] == '1995') echo 'selected="selected"'; } ?>>1995</option>
                            <option value="1996" <?php if(isset($_SESSION['register_dobyear'])) { if($_SESSION['register_dobyear'] == '1996') echo 'selected="selected"'; } ?>>1996</option>
                            <option value="1997" <?php if(isset($_SESSION['register_dobyear'])) { if($_SESSION['register_dobyear'] == '1997') echo 'selected="selected"'; } ?>>1997</option>
                        </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="zipcode">Zip Code</label>
                      <div class="controls">
                        <input type="text" class="input-small" maxlength="5" name="zipcode" value="<?php if(isset($_SESSION['register_zipcode'])) echo $_SESSION['register_zipcode'] ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="controls">
                        <input type="submit" class="btn btn-primary" value="Register" />
                      </div>
                    </div>
                  </fieldset>
                </form>
                <?php
                    unset($_SESSION['register_email']);
                    unset($_SESSION['register_fname']);
                    unset($_SESSION['register_lname']);
                    unset($_SESSION['register_dobyear']);
                    unset($_SESSION['register_dobmonth']);
                    unset($_SESSION['register_dobday']);
                    unset($_SESSION['register_zipcode']);
                ?>
            </div>
            </div>


        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
