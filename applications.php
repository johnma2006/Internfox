<?php 
session_start(); 
include "config.php";
include "require_login.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; My Applications</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

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
                            <li><a href="account.php"><i class="icon-lock"></i> Account Settings</a></li>
                            <li class="active"><a href="applications.php"><i class="icon-file"></i> My Applications</a></li>
                        </ul>
                    </div>

                </div>


                <div class="span9 shadow" style="background-color:white;border:1px solid #AAAAAA;padding:20px">

                    <div class="row-fluid" style="text-align:center">
                        <h2>My Applications</h2><hr/>

                        <?php 
                          $result = mysql_query("SELECT * FROM applications WHERE user_id='$id'");
                          if(mysql_num_rows($result) > 0) {
                                echo '<table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th style="width:400px">Company</th>
                                          <th style="width:100px">Date</th>
                                          <th style="width:140px">Company Listing</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                                while($row = mysql_fetch_array($result))
                                {
                                    $company_id = $row['company_id'];
                                    $result2 = mysql_query("SELECT * FROM companies WHERE company_id='$company_id'");
                                    $temp_company = mysql_fetch_assoc($result2);
                                    $company_displayname = $temp_company['company_displayname'];
                                    $company_name = $temp_company['name'];

                    
                                    $date = $row['date'];

                                      echo '<tr>
                                                <td>' . $company_displayname . '</td>
                                                <td>' . $date . '</td>
                                                <td><a href="company.php?name=' . $company_name . '">View Listing</a></td>
                                            </tr>';
                                }
                                    echo '</tbody>
                                        </table>';
                            }
                            else {
                                echo '<h3>You have not applied to any internships.</h3>';

                            }
                            ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
