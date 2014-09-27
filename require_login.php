<?php

if (!isset($_SESSION['logged'])) {

    function curPageURL() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    $_SESSION['previous_page'] = curPageURL();
    $_SESSION['message'] = '<div class="alert alert-warning">
                                <i class="icon-user"></i> You must log in before viewing this page.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
    header('Location: login.php');
    die();  
}

?>