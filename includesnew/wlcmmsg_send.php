<?php
session_start();

$title='Welcome';

     
/**********************************
    Email Recipient Config Area
***********************************/

if (isset($_SESSION['tradeName'])) {
	$name = $_SESSION['tradeName'];
	$email = $_SESSION['emailAddress'];
	
	$mainmessage = 'We are thrilled that you have indicated interest in joining us as a designer. At Waxmode, 
	we seek to win your confidence and loyalty through well managed supply chains, comprehensively marketed 
	sales channels, and an excellent working relationship with our designers. To get started, we would need 
	more information from you, so a member of our account management staff will be contacting you within 
	24 hours for additional set up details.';
	
	$signinhelplink = 'http://www.waxmode.com/responsive2/dessigninhelp.php';
	
} else if (isset($_SESSION['shopperid'])) {
	$name = $_SESSION['shopperfname'];
	$email = $_SESSION['shopperemail'];
	
	$mainmessage = 'We are thrilled that you have decided to join us. At Waxmode, we care about our shoppers and we seek to win your 
	confidence and loyalty through high quality product offerings, timely delivery and excellent customer service. Please 
	visit us often, browse through our product offerings, and purchase items of interest to you. Thanks for shopping
	with us.';
	
	$signinhelplink = 'http://www.waxmode.com/responsive2/signinhelp.php';
	
} else {

	$mainmessage = '<span style="font-family: arial-narrow,arial,sans-serif;color:#D4A50F;font-size:150%;">Hello</span><br /><br />We are thrilled that you have decided to join us. At Waxmode, we care about our shoppers and designers, and we seek to win your 
	confidence and loyalty through high quality product offerings, timely delivery and excellent customer service. If you are a shopper, please 
	visit us often, browse through our product offerings, and purchase items of interest to you. If you are a designer, please call us at 1-888-555-1212 for more information.';
	
}	


	// Initialize the $showshoppingbutton variable
	$showshoppingbutton = '';

	// If it is not designer that is registering (but rather shopper is), don't show the continueshoppingbutton 
	// (to be plugged in further down in the emailblock below)  
	if (!isset($_SESSION['tradeName'])) {
	$showshoppingbutton = '<div style="margin:15px 0 15px 0;">
		<a href="http://www.waxmode.com/responsive2/categresults.php?producttarget=women" target="_blank">
		<img src = "http://www.waxmode.com/responsive2/imagesnew/continueshopping_white.png" width="150px" height="27px" border="0">
		</a>
		</div>';
	}
	
	// Retrieve the "frmeml" variable that tells if user clicked the "if unable to view..." link that is in the email. This is so that the same link gets hidden when the page is displayed to them from the website 	
	// For the part of the code that displays the page, see bottom of this page
	if(isset($_GET['frmeml'])) {
		$unabletoviewlinktoggle = '';		
	} else {
		$unabletoviewlinktoggle = '<div style="padding:20px 0;"><span style="font:14px/14px arial-narrow,arial,sans-serif;color:#202020;">If unable to view this message, <a style="text-decoration:none;color:#D4A50F;" href="http://www.waxmode.com/responsive2/includesnew/wlcmmsg_send.php?frmeml=true" target="_blank">click here</a> </span></div>';
	}


	// Certain data are dependent on user session being active. If not active, suppress the data
	if ((!isset($_SESSION['tradeName']))AND(!isset($_SESSION['shopperid']))) {
		$showhellotoggle = '';
		$showlogininfotoggle = '';
		} else {
		$showhellotoggle = '<h3 style="font-family: arial-narrow,arial,sans-serif;color:#D4A50F;">Hello, <span style="color:#808080;"> ' . $name . '</span></h3>';

		$showlogininfotoggle = '<h3 style="font-family: arial-narrow,arial,sans-serif;color:#202020;">Log In Information</h3>				
								<p style="font-family: arial-narrow,arial,sans-serif;color:#202020;">
								Email Address:<br />' . $email . '<br /><br />					
								
								Forgot your password?<br />
								<a style="text-decoration:none;color:#D4A50F;" href="' . $signinhelplink . '" target="_blank">
								Click here for assistance.</a>  </p>';		
		}
					
?>		


<?php

$emailblock =
'<!DOCTYPE HTML>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" x-undefined="" />

<title>' . $title . '</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>

<body style="background-color:#F2F2F2;">

<div class="container" style="width:100%;">

	<div style="min-width:400px;max-width:700px;margin:0 auto 0 auto;">' . $unabletoviewlinktoggle . '	

		<div style="width:100%;height:32px;background-color:#202020;">
			<div style="width:170px;height:32px;display:inline;float:left;">
				<a href="http://www.waxmode.com/responsive2/index.php" target="_blank">
				<img src="http://www.waxmode.com/responsive2/imagesnew/logogoldblack_flattened_email.png" width="170" height="32" border="0">
				</a>
			</div>
		</div>	

		<div style="width:100%;height:43px;background-color:#ECE9E4;">
				<div style="width:95%;padding-top:10px;padding-left:15px;">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td width="25%" style="text-align:center;"><a style="text-decoration:none;font:13px/14px arial-narrow,arial,sans-serif;color:#202020;" href="http://www.waxmode.com/responsive2/designernav.php" target="_blank">DESIGNERS</a></td>
						
							<td width="19%" style="text-align:center;"><a style="text-decoration:none;font:13px/14px arial-narrow,arial,sans-serif;color:#202020;" href="http://www.waxmode.com/responsive2/categresults.php?producttarget=women" target="_blank">WOMEN</a></td>
						
							<td width="16%" style="text-align:center;"><a style="text-decoration:none;font:13px/14px arial-narrow,arial,sans-serif;color:#202020;" href="http://www.waxmode.com/responsive2/categresults.php?producttarget=men" target="_blank">MEN</a></td>
						
							<td width="17%" style="text-align:center;"><a style="text-decoration:none;font:13px/14px arial-narrow,arial,sans-serif;color:#202020;" href="http://www.waxmode.com/responsive2/categresults.php?producttarget=kids" target="_blank">KIDS</a></td>
						
							<td width="23%" style="text-align:center;"><a style="text-decoration:none;font:13px/14px arial-narrow,arial,sans-serif;color:#202020;" href="http://www.waxmode.com/responsive2/categresults.php?producttype=accessories" target="_blank">ACCESSORIES</a></td>
						</tr>	
					</table>
				</div>		
		</div>
						
		<div style="width:100%;">			
			<div style="width:100%;">
				<a href="http://www.waxmode.com/responsive2/index.php" target="_blank">
				<img src="http://www.waxmode.com/responsive2/imagesnew/emailbannercombo.png" width="100%" height="auto" border="0">
				</a>
			</div>
		</div>
						
		<div style="width:100%;background-color:#FFFFFF;margin:0;border:0;">
			<div style="width:95%;float:left;margin-left:15px;">' . $showhellotoggle . '				
			
				<p style="font-family: arial-narrow,arial,sans-serif;color:#202020;"> ' . $mainmessage . '</p>' . $showshoppingbutton . ' </div>
				
			<div style="width:100%;">
			
				<div style="float:left;margin-left:15px;margin-bottom:15px;">' . $showlogininfotoggle . '</div>	
				
			</div>
				
			<div style="width:100%;height:30px;background-color:#DDDDDD;clear:both;">
			</div>
		</div>

		

	</div>

</div>

</body>

</html>';


$mail_body = '';
					
			$email = $email;
					
			$mail_body = $emailblock;
						
			$subject = 'Welcome to WaxMode';
			$headers  = "From:info@waxmode.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$to = "$email";

			$mail_result = mail($to, $subject, $mail_body, $headers);
					


// This is to show the page when the "unable to view..." link is clicked in the email by the user	
if(isset($_GET['frmeml'])) {
	echo $emailblock;		
}
