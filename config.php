<?php

//############################ Connecting to Database ###############################
$url=parse_url(getenv("CLEARDB_DATABASE_URL"));
if($_SERVER['HTTP_HOST'] != 'localhost:8080') { $con = mysql_connect($dbserver = $url["host"], $dbusername = $url["user"], $dbpassword = $url["pass"]); $db=substr($url["path"],1); } //Real heroku connection
else { $con = mysql_connect("localhost","root",""); $db="internfoxdatabase"; } //localhost connection
if (!$con) {
    echo "Could not connect to database: " . mysql_error();
    die();
}
mysql_select_db($db, $con);
//###################################################################################

if (isset($_SESSION['logged'])) {
    include "get_profile.php";
    if ($_SESSION['logged'] == "johnma2006@gmail.com" || $_SESSION['logged'] == "grasehsieh@gmail.com")
        $_SESSION['admin'] = "TRUE";
 }
?>