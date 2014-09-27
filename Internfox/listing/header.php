<div class="container" style="margin-bottom:5px;">
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
                         <a href="profile.php" id="header-email" style="font-size:8pt;font-weight:normal;margin-right:5px"><i class="icon-chevron-down" style="opacity:0.7;zoom:1;filter:alpha(opacity=70);"></i>';
                echo     $user['email'];
                echo     '</a>
                          <div id="header-email-div-hidden" style="z-index:3;display:none;text-align:left;right:0px;margin-top:0px;position:absolute;padding:5px;width:125px;border:1px solid #888888;border-radius:2px;background-color:White;box-shadow: 0 0 3px 3px #F2F2F2;-moz-box-shadow: 0 0 3px 3px #F2F2F2;-webkit-box-shadow: 0 0 3px 3px #F2F2F2;">
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
            echo '<div class="row-fluid" style="height:25px;text-align:right;position:relative"></div>';
        }
    ?>
    <div class="row-fluid" <?php if(!isset($_SESSION['logged'])) { echo 'style="margin-top:-6px"'; } ?>>

        <div class="span3" style="width:21%">
            <a href="index.php"><img id="logo" width="200px" src="bin/logo3.png" alt="Internfox" style="margin-top:-10px" /></a>
        </div>

        <div class="span7" style="margin-left:25px;padding-top:4px;width:59%">
            <div class="btn-group">
                <a href="search.php" class="btn btn-large search-internships-button" style="width:43%;"><i class="icon-search" style="margin-top:2px"></i> Browse Internships</a>
                <a href="#" class="btn btn-large search-internships-button" style="width:20%;height:17px;white-space:nowrap">FAQ</a>
                <a href="#" class="btn btn-large search-internships-button" style="width:20%;height:17px;white-space:nowrap">Contact Us</a>
            </div>
        </div>
        <?php
        if (isset($_SESSION['logged'])) {
            echo '  <div class="span2" style="padding-top:4px;width:16%;margin-left:7px;float:right">
                        <a href="profile.php" class="btn btn-info btn-large" style="margin-top:1px;width:79%;white-space:nowrap"><strong>My Profile</strong></a>
                    </div>';
        }
        else {

            echo '<div class="span2" style="margin-left:10px;width:16%;padding-top:5px">
                        <ul class="nav nav-pills">
                            <li><a href="register.php" style="font-size:11pt">Sign up</a></li>
                            <li><a href="login.php" style="font-size:11pt">Log in</a></li>
                        </ul>
                    </div>';

        }
        ?>

    </div>
</div>