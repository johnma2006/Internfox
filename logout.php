<?php 
session_start();
$_SESSION = array();
session_destroy();
$_SESSION['message'] = '<div class="alert alert-warning">
                                <i class="icon-user"></i> You have successfully logged out.<button type="button" class="close" data-dismiss="alert"><i class="icon-remove" style="margin-top:4px;"></i></button>
                            </div>';
header('Location: index.php');
?>
