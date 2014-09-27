<?php 
session_start(); 
include "config.php";
include "require_login.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <?php
        if (isset($_GET['name'])) {
            $name = mysql_real_escape_string(filter_var($_GET['name'], FILTER_SANITIZE_STRING));
            $result = mysql_query("SELECT * FROM companies WHERE name='$name'");
            $company = mysql_fetch_assoc($result);

            if (mysql_num_rows($result) > 0) {

                $company_id = $company['company_id'];
                $company_displayname = $company['company_displayname'];
                $company_about = $company['company_about'];
                $company_website = $company['company_website'];
                $internship_description = $company['internship_description'];
                $internship_name = $company['internship_name'];
                $internship_type = $company['internship_type'];
                $internship_date = $company['internship_date'];
                $internship_deadline = $company['internship_deadline'];
                $internship_location = $company['internship_location'];
                $internship_hours = $company['internship_hours'];
                $contact_email = $company['contact_email'];
                $contact_person = $company['contact_person'];

                echo '<title>Internfox &middot; ' . $company_displayname . '</title>';
            }
            else
                echo  '<title>Internfox &middot; Company not found</title>';
        }
        else 
            echo  '<title>Internfox &middot; Company not found</title>';
    ?>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">

            <?php
                if (isset($_GET['name'])) {
                    $name = $_GET['name'];
                    $result = mysql_query("SELECT * FROM companies WHERE name='$name'");
                    $company = mysql_fetch_assoc($result);

                     if (!(mysql_num_rows($result) > 0)) {
                        echo '<div class="alert alert-error">Company not found.</div>';
                        die();
                    }
                }
                else {
                     echo '<div class="alert alert-error">Company not found.</div>';
                     die();
                }
            ?>

        <div class="well content" style="padding-top:20px">

            <?php

            if (isset($_POST['ac'])) {

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
                        header('Location: company.php?name=' . $name);
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
                     header('Location: company.php?name=' . $name);


                }
            }

            ?>





              <div class="content well-white" style="padding:30px"> 
			
			<div class="row-fluid">
			
				
				<div class="span4" style="padding:0px;">

                    <?php 
                        $query = "SELECT *
                                        FROM applications
                                        WHERE company_id = '$company_id' AND user_id = '$id';";
                                $result2 = mysql_query($query);
                                if(mysql_num_rows($result2) > 0)
                                    echo '<a class="btn btn-primary btn-large disabled" style="margin:auto; width:120px; display:block; height:20px;">Applied</a>';
                                else
                                    echo '<a class="btn btn-primary btn-large" data-toggle="modal" href="#myModal" style="margin:auto; width:120px; display:block; height:20px;">Apply now!</a>';
                    ?>

                    <div class="modal hide" id="myModal">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Confirm Application</h3>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to apply to <?php echo $company_displayname?>?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                            <form action="company.php?name=<?php echo $name ?>" method="post" style="display:inline">
                                <button type="submit" name="ac" value="<?php echo $company_id ?>" href="#" class="btn btn-primary">Submit Application</button>
                            </form>
                        </div>
                    </div>

					<br /><br />
					<div class="span10" style=" text-align:center; margin-left:15px;"> <!--Company Sidebar-->
						<h1><?php echo $company_displayname ?></h1>
                        <br />
					</div>
					<br /><br /><br />
					<h3 style="color:#59C2FF; font-size:15px;">Company Description:</h3>
					<span style="white-space: pre-wrap;"><?php echo $company_about ?></span>
                    <br /><br />
					<h3 style="color:#59C2FF; font-size:15px; display:inline;">Company Website:</h3><br />
					<a href="http://<?php echo $company_website ?>" style="font-size:15px; color:gray;"><?php echo $company_website ?></a> <br /><br />
					<img src="bin/company-logos/<?php echo $name ?>-logo.png" style="opacity:0.6; padding: 8px; margin-left:-18px;  "/><br /><br /><br />
				</div>
				
				
			
				<div class="span8" style="padding-left:25px">

					<h1 style="color:Gray;"><?php echo $internship_name ?></h1>
					<hr style="width:100%; height:0em; border:1px solid #B8B8B8; margin-top:-4px; float:left;"/>
					
					<br />
                    <!--
					<div class="row-fluid" style="border:1px solid #B8B8B8; text-align:center; padding-top: 10px;">
					
						<div class="span4">
							<i class="icon-briefcase"></i> <strong>Application Deadline</strong><p>
							<span style="color:#59C2FF;"><strong>September 30</strong></span>
						</div>
						
						<div class="span4">
							<span style="color:#484848; font-size:14px;"><strong>$ </span>Compensation</strong><p>
							<span style="color:#59C2FF;"><strong>Unpaid</strong></span>
						</div>
						
						<div class="span4">
							<i class="icon-time"></i> <strong>Hours Per Week</strong><p>
							<span style="color:#59C2FF;"><strong>10-15</strong></span>
						</div>
					
					</div> 
                    <br />-->
					
					    <h4>Internship Description:</h4><br />
                        <span style="white-space: pre-wrap;"><?php echo $internship_description ?><br />
					    <h4>Location:</h4><?php echo $internship_location  ?><br /><br />
                        <!--<p>
					        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=4227+E.+Madison+St.+Seattle+WA&amp;aq=&amp;sll=47.272986,-120.882277&amp;sspn=3.786984,10.821533&amp;ie=UTF8&amp;hq=&amp;hnear=4227+E+Madison+St,+Seattle,+King,+Washington+98112&amp;t=m&amp;z=14&amp;ll=47.635947,-122.277578&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=4227+E.+Madison+St.+Seattle+WA&amp;aq=&amp;sll=47.272986,-120.882277&amp;sspn=3.786984,10.821533&amp;ie=UTF8&amp;hq=&amp;hnear=4227+E+Madison+St,+Seattle,+King,+Washington+98112&amp;t=m&amp;z=14&amp;ll=47.635947,-122.277578" style="color:#0000FF;text-align:left"></a></small>
				        </p>-->
                
                </div>
			
			</div>	
		   
			</div>





























        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
