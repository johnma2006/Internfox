<?php

if (isset($_SESSION['logged'])) {
    $email = $_SESSION['logged'];
    $result = mysql_query("SELECT * FROM users WHERE email='$email'");
    $user = mysql_fetch_assoc($result);
    $id = $user['id'];

    $activities = mysql_query("SELECT * FROM activities WHERE id='$id'");
}

?>