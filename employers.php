<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Employers
    </title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="content">

            <div class="row-fluid" style="border:1px solid #CCC;padding:1px;color:White;margin-bottom:10px;border-radius:4px">
                <div style="width:940px;height:50px;background-image:url('bin/companypicture.jpg');padding:30px;border-radius:4px">
                    <h1 class="h1header" style="margin-top:10px;font-size:36pt;text-shadow:2px 2px #333333">Employers</h1>
                </div>
            </div>
            
            <a href="employers_registration.php" class="btn">Post a Listing</a>
      
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
