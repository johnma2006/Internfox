﻿<?php 
session_start(); 
include "config.php";

//$id = $_GET['id'];
$id = "2";

$result = mysql_query("SELECT * FROM users WHERE id='$id'");
$temp_user = mysql_fetch_assoc($result);

$temp_activities = mysql_query("SELECT * FROM activities WHERE id='$id'");

$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="*|MC:SUBJECT|*">
        
        <title>*|MC:SUBJECT|*</title>
		
	<style type="text/css">
		#outlook a{
			padding:0;
		}
		body{
			width:100% !important;
		}
		.ReadMsgBody{
			width:100%;
		}
		.ExternalClass{
			width:100%;
		}
		body{
			-webkit-text-size-adjust:none;
		}
		body{
			margin:0;
			padding:0;
		}
		img{
			border:0;
			height:auto;
			line-height:100%;
			outline:none;
			text-decoration:none;
		}
		table td{
			border-collapse:collapse;
		}
		#backgroundTable{
			height:100% !important;
			margin:0;
			padding:0;
			width:100% !important;
		}
		body,#backgroundTable{
			background-color:#FAFAFA;
		}
		#templateContainer{
			border:1px solid #DDDDDD;
		}
		h1,.h1{
			color:#202020;
			display:block;
			font-family:Arial;
			font-size:34px;
			font-weight:bold;
			line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			text-align:left;
		}
		h2,.h2{
			color:#202020;
			display:block;
			font-family:Arial;
			font-size:30px;
			font-weight:bold;
			line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			text-align:left;
		}
		h3,.h3{
			color:#202020;
			display:block;
			font-family:Arial;
			font-size:26px;
			font-weight:bold;
			line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			text-align:left;
		}
		h4,.h4{
			color:#202020;
			display:block;
			font-family:Arial;
			font-size:22px;
			font-weight:bold;
			line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			text-align:left;
		}
		#templatePreheader{
			background-color:#FAFAFA;
		}
		.preheaderContent div{
			color:#505050;
			font-family:Arial;
			font-size:10px;
			line-height:100%;
			text-align:left;
		}
		.preheaderContent div a:link,.preheaderContent div a:visited,.preheaderContent div a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateHeader{
			background-color:#FFFFFF;
			border-bottom:0;
		}
		.headerContent{
			color:#202020;
			font-family:Arial;
			font-size:34px;
			font-weight:bold;
			line-height:100%;
			padding:0;
			text-align:center;
			vertical-align:middle;
		}
		.headerContent a:link,.headerContent a:visited,.headerContent a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		#headerImage{
			height:auto;
			max-width:600px;
		}
		#templateContainer,.bodyContent{
			background-color:#FFFFFF;
		}
		.bodyContent div{
			color:#505050;
			font-family:Arial;
			font-size:14px;
			line-height:150%;
			text-align:left;
		}
		.bodyContent div a:link,.bodyContent div a:visited,.bodyContent div a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		.bodyContent img{
			display:inline;
			height:auto;
		}
		.leftColumnContent{
			background-color:#FFFFFF;
		}
		.leftColumnContent div{
			color:#505050;
			font-family:Arial;
			font-size:14px;
			line-height:150%;
			text-align:left;
		}
		.leftColumnContent div a:link,.leftColumnContent div a:visited,.leftColumnContent div a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		.leftColumnContent img{
			display:inline;
			height:auto;
		}
		.rightColumnContent{
			background-color:#FFFFFF;
		}
		.rightColumnContent div{
			color:#505050;
			font-family:Arial;
			font-size:14px;
			line-height:150%;
			text-align:left;
		}
		.rightColumnContent div a:link,.rightColumnContent div a:visited,.rightColumnContent div a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		.rightColumnContent img{
			display:inline;
			height:auto;
		}
		#templateFooter{
			background-color:#FFFFFF;
			border-top:0;
		}
		.footerContent div{
			color:#707070;
			font-family:Arial;
			font-size:12px;
			line-height:125%;
			text-align:left;
		}
		.footerContent div a:link,.footerContent div a:visited,.footerContent div a .yshortcuts {
			color:#336699;
			font-weight:normal;
			text-decoration:underline;
		}
		.footerContent img{
			display:inline;
		}
		#social{
			background-color:#FAFAFA;
			border:0;
		}
		#social div{
			text-align:center;
		}
		#utility{
			background-color:#FFFFFF;
			border:0;
		}
		#utility div{
			text-align:center;
		}
		#monkeyRewards img{
			max-width:190px;
		}
</style></head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: none;margin: 0;padding: 0;background-color: #FAFAFA;width: 100% !important;">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="margin: 0;padding: 0;background-color: #FAFAFA;height: 100% !important;width: 100% !important;">
            	<tr>
                	<td align="center" valign="top" style="border-collapse: collapse;">
                        <!-- // Begin Template Preheader \\ -->
                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="templatePreheader" style="background-color: #FAFAFA;">
                            <tr>
                                <td valign="top" class="preheaderContent" style="border-collapse: collapse;">
                                
                                	<!-- // Begin Module: Standard Preheader \ -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                    	<tr>
                                        	<td valign="top" style="border-collapse: collapse;">
                                            	<div style="color: #505050;font-family: Arial;font-size: 10px;line-height: 100%;text-align: left;"></div>
                                            </td>
                                            <!-- *|IFNOT:ARCHIVE_PAGE|* -->
											<td valign="top" width="190" style="border-collapse: collapse;">
                                            	<div style="color: #505050;font-family: Arial;font-size: 10px;line-height: 100%;text-align: left;"></div>
                                            </td>
											<!-- *|END:IF|* -->
                                        </tr>
                                    </table>
                                	<!-- // End Module: Standard Preheader \ -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader \\ -->
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer" style="border: 1px solid #DDDDDD;background-color: #FFFFFF;">
                        	<tr>
                            	<td align="center" valign="top" style="border-collapse: collapse;">
                                    <!-- // Begin Template Header \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader" style="background-color: #FFFFFF;border-bottom: 0;">
                                        <tr>
                                            <td class="headerContent" style="border-collapse: collapse;color: #202020;font-family: Arial;font-size: 34px;font-weight: bold;line-height: 100%;padding: 0;text-align: center;vertical-align: middle;">
                                                <br />
                                            	<!-- // Begin Module: Standard Header Image \\ -->
                                            	<div style="text-align: none;"><img src="http://gallery.mailchimp.com/d6ffaca970a8f8075cd917dac/images/logo.1.png" alt="" border="0" style="border: px none;border-color: ;border-style: none;border-width: px;height: 63px;width: 200px;margin: 0;padding: 0;line-height: 100%;outline: none;text-decoration: none;" width="200" height="63"></div>
                                            	<!-- // End Module: Standard Header Image \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top" style="border-collapse: collapse;">
                                    <!-- // Begin Template Body \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                    	<tr>
                                        	<td colspan="3" valign="top" class="bodyContent" style="border-collapse: collapse;background-color: #FFFFFF;">
                                            
                                                <!-- // Begin Module: Standard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top" style="border-collapse: collapse;">
                                                            <div style="color: #505050;font-family: Arial;font-size: 14px;line-height: 150%;text-align: left;">
                                                                <h1 class="h1" style="color: #202020;display: block;font-family: Arial;font-size: 24px;font-weight: bold;line-height: 100%;margin-top: 0;margin-right: 0;margin-bottom: 10px;margin-left: 0;text-align: left;">
	                                                            ' . $temp_user['fname'] . ' ' . $temp_user['lname'] . ' has applied for
                                                                </h1>

                                                                <br />
                                                                ' . $temp_user['fname'] . ' ' . $temp_user['lname'] . ' has applied for 
                                                                <strong><span style="color: gray; font-family: Helvetica, Arial, sans-serif">Marketing Research/Market Analytics Intern</span></strong>
                                                                through Internfox. <a href="">Click here</a> to view your listing.
                                                                <br />
                                                                <br />
                                                            </div>

                                                            <div style="border:1px solid #AAAAAA;padding:17px;background-color:#FAFAFA">
                                                                    <span style="font-size:18pt">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Profile Info</span>
                                                                    <br />
                                                                    <br />
                                                                    <table>
                                                                        <tr>
                                                                            <td width="80px"><strong>First Name</strong></td>
                                                                            <td>' . $temp_user['fname'] . '</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="80px"><strong>Last Name</strong></td>
                                                                            <td>' . $temp_user['lname'] . '</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="80px"><strong>Email</strong></td>
                                                                            <td>' . $temp_user['email'] . '</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="80px"><strong>Birth Date</strong></td>
                                                                            <td>' . $temp_user['dob'] . '</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="80px"><strong>Zipcode</strong></td>
                                                                            <td>' . $temp_user['zipcode'] . '</td>
                                                                        </tr>
                                                                    </table>
                                                                    <br />
                                                                    <!-- Objective ###################################################################################### -->
                                                                    <h4>Summary</h4>
                                                                        <p style="white-space:pre-wrap">' . $temp_user['objective'] . '</p>
                                                                    <br />
                                                                    <!-- Work and Extracurriculars ###################################################################################### -->
                                                                    <h4>Work and Extracurriculars</h4>
                                                                    <br />';


                                                                    while($activity = mysql_fetch_array($temp_activities)) {

                                                                        $activity_id = $activity['activity_id'];
                                                                        $activity_name = $activity['activity_name'];
                                                                        $activity_description = $activity['activity_description'];

                                                                        $message .= ' <div style="margin-left:5px">
                                                                                        <h4 style="color:#444444;margin-bottom:10px;font-size:13pt">' . $activity_name . '</h3>
                                                                                        <p style="margin-left:10px;white-space:pre-wrap">' . $activity_description . '</p>
                                                                                    </div>
                                                                                ';
                                                                    }

                                                                $message .= '</div>


														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top" style="border-collapse: collapse;">
                                    <!-- // Begin Template Footer \\ -->
                                	<table border="0" cellpadding="10" cellspacing="0" width="600" id="templateFooter" style="background-color: #FFFFFF;border-top: 0;">
                                    	<tr>
                                        	<td valign="top" class="footerContent" style="border-collapse: collapse;">
                                            
                                                <!-- // Begin Module: Standard Footer \\ -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="2" valign="middle" id="utility" style="border-collapse: collapse;background-color: #FFFFFF;border: 0;">
                                                            <div style="color: #707070;font-family: Arial;font-size: 12px;line-height: 125%;text-align: center;">This email was sent by <a href="http://www.internfox.com" target="_blank" style="color: #336699;font-weight: normal;text-decoration: underline;">www.internfox.com</a>.<br />
For more information, check our our <a href="http://internfox.com/faq.php" target="_blank" style="color: #336699;font-weight: normal;text-decoration: underline;">FAQ</a>.<br />
Contact us at <em>listing@internfox.com.</em></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>';

echo $message;
?>