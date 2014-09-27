<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Successful Registration</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>
    <div class="container">
        <div class="content well-white">

            <?php

            if (isset($_GET['id'])) {

                $confirm_email = substr($_GET['id'], 0, strpos($_GET['id'], '?'));
                $confirm_email = mysql_real_escape_string(filter_var($confirm_email, FILTER_SANITIZE_EMAIL)); 
                $confirm_id = substr($_GET['id'], strpos($_GET['id'], '?') + 1);

                echo $confirm_email . '<br />';

                $result = mysql_query("SELECT * FROM users WHERE email='$confirm_email'");
                $user = mysql_fetch_assoc($result);
                $salt = $user['salt'];

                echo substr(hash('sha256', $confirm_email . $salt), 0, 10) . '<br />';
                echo $confirm_id . '<br />';

                if (substr(hash('sha256', $confirm_email . $salt), 0, 10) == $confirm_id) {
                    
                    mysql_query("UPDATE users SET isConfirmed='1' WHERE email='$confirm_email'");

                    $_SESSION['message'] = '<div class="alert alert-success">
                                                <i class="icon-thumbs-up"></i> Your account has been confirmed. Fill out your profile and start applying for internships!<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                                            </div>';

                    header('Location: index.php');
                    die();
                }
                else {
                    header('Location: index.php');
                    die();
                }
            }
            else {
                    header('Location: index.php');
                    die();
                }
            ?>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
