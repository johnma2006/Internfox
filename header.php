
    <div class="container-fluid" style="background-color:#5BCDEF">
        <div class="container" style="height:23px;padding-top:4px;text-align:right;font-size:9pt">
         <?php 
        if (isset($_SESSION['logged'])) {
            echo '<div class="row-fluid" style="height:19px;text-align:right;position:relative">
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("#header-email-div").mouseover(function () {
                                $("#header-email-div-hidden").show();
                            });
                            $("#header-email-div").mouseout(function () {
                                $("#header-email-div-hidden").hide();
                            });
                        });
                      </script>
                      <div id="header-email-div" style="float:right">
                         <a href="profile.php" id="header-email" style="color:white;font-size:8pt;font-weight:bold;margin-right:5px"><i class="icon-chevron-down icon-white"></i>';
                echo     $user['email'];
                echo     '</a>
                          <div id="header-email-div-hidden" style="z-index:3;display:none;text-align:left;right:0px;margin-top:0px;position:absolute;padding:5px;width:125px;border:1px solid #888888;border-radius:2px;background-color:White;box-shadow: 0 0 3px 3px rgba(100,100,100,0.5);-moz-box-shadow: 0 0 3px 3px rgba(100,100,100,0.5);-webkit-box-shadow: 0 0 6px 3px rgba(100,100,100,0.3);">
                            <ul class="nav nav-list">
                                <li><a href="profile.php" style="font-size:9pt">My Profile</a></li>';
                              if (isset($_SESSION['admin'])) { echo '<li><a href="company_list.php" style="font-size:9pt">Company List</a></li><li><a href="student_list.php" style="font-size:9pt">Student List</a></li><li><a href="application_list.php" style="font-size:9pt">Application List</a></li>'; }
                echo '      <li><a href="logout.php" style="font-size:9pt">Log out</a></li>
                            </ul>
                          </div>
                      </div>
                    </div>';
        }
        else {
            echo '  <a href="register.php" class="btn btn-mini" style="padding-left:8px;padding-right:8px">Create an Account</a>
                    <a href="login.php" class="btn btn-info btn-mini" style="padding-left:8px;padding-right:8px">Log in</a>';
            }
        ?>
                
        </div>
    </div>

    <div class="container-fluid headerShadow" style="background-image:url('bin/header-background.png');background-color:#FFFFFF;position:relative;">
        <div class="container" style="height:75px">
        
            <div class="span3" style="padding-top:10px">
                <a href="index.php"><img src="bin/logo.png" id="logo" alt="logo" width="180px" /></a>
            </div>
            <div class="span9" style="padding-top:24px">
                <div class="btn-group" style="float:right">
                    <a href="index.php" class="btn btn-nav btn-large headerLinks">Home</a>
                    <a href="search.php" class="btn btn-nav btn-large headerLinks">Browse Internships</a>
                    <a href="faq.php" class="btn btn-nav btn-large headerLinks">FAQ</a>
                    <!--<a href="contact.php" class="btn btn-nav btn-large headerLinks">Contact Us</a>-->
                    <a href="profile.php" class="btn btn-nav btn-large headerLinks">My Profile</a>
                </div>
            </div>

        </div>
    </div>
    <div class="container" style="margin-top:10px;margin-bottom:0px">
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </div>