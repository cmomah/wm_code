<?php 
session_start();
?>
		
		<!DOCTYPE HTML>
		<html>

		<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" x-undefined="" />
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/menuscript.js"></script>
			
		</head>

		<body>

		<div id="wrapper">

		<?php
		include ('includesnew/topcontainer_shopping.php');



// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('includesnew/mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for trade name:
	if (empty($_POST['tradeName'])) {
		$errors[] = 'You forgot to enter your trade name.';
	} else {
		$tn = mysqli_real_escape_string($dbc, trim($_POST['tradeName']));
	}
	
	// Check for a first name:
	if (empty($_POST['firstName'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
	}
		
	// Check for a last name:
	if (empty($_POST['lastName'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
	}
		
	// Check for an email address:
	if (empty($_POST['emailAddress'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
	}
	
	// Prevent duplicate emails in the system	
	
	if (!empty($e)) {
	
		$q = "SELECT designeremail FROM designers WHERE designeremail='$e'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
						
		// Check the result:
		if (mysqli_num_rows($r) == 1) {
			$errors[] = 'The email address you entered already exists as it has been used to register here before.';
		} 
	}				
		
	// checking validity of the email address 
	$emailAddress = strtolower($_POST['emailAddress']);  
	
	if(eregi("^[a-z]+[a-z0-9_\.\-]+[0-9a-z]+@+[a-z0-9]+[a-z0-9_\.\-]+\.+[0-9a-z]+$", $emailAddress)){ 
		// OK (the email address is of the correct format)
	} 
	else{ 
		//excute the following line only if the email address is not of the correct format 
		$errors[] = 'Email address entered is invalid. It must be in the form abc@def.com, abc@def.net or other valid format.'; 
	} 

	
	// Check for valid password
	if (preg_match("%^[A-Za-z0-9-_]{4,20}$%", $_POST['pass1'])) {
    // OK
	} else {
		$errors[] = 'You entered an invalid password. Password must be between 4 and 20 characters long. These are okay: alphabets, numbers, and the special characters  - and _';
	}
	
	if (preg_match("%^[A-Za-z0-9-_]{4,20}$%", $_POST['pass2'])) {
    // OK
	} else {
		$errors[] = 'You entered an invalid value to confirm password. Password must be between 4 and 20 characters long. These are okay: alphabets, numbers, and the special characters  - and _';
	}
	
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password entries did not match.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	
	
	// Check for test question:
	if ($_POST['testquestion'] == 'Select One') {
		$errors[] = 'You forgot to enter your test question.';
	} else {
		$tq = mysqli_real_escape_string($dbc, trim($_POST['testquestion']));
	}
	
	
	// Check for answer to test question:
	if (empty($_POST['testquestionanswer'])) {
		$errors[] = 'You forgot to enter your answer to your test question.';
	} else {
		$tqa = mysqli_real_escape_string($dbc, trim($_POST['testquestionanswer']));
	}
	
	// Check for a street address:
	if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter your street address.';
	} else {
		$sa = mysqli_real_escape_string($dbc, trim($_POST['address']));
	}
		
	// Check for city:
	if (empty($_POST['city'])) {
		$errors[] = 'You forgot to enter your city.';
	} else {
		$sc = mysqli_real_escape_string($dbc, trim($_POST['city']));
	}
		
	// Check for country:
	if (empty($_POST['country'])) {
		$errors[] = 'You forgot to enter your country.';
	} else {
		$sco = mysqli_real_escape_string($dbc, trim($_POST['country']));
	}
		
	// Check for phone:
	if (empty($_POST['phoneNumber'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$sp = mysqli_real_escape_string($dbc, trim($_POST['phoneNumber']));
	}
	
	// Assign the non-required values to variables	
	$ss = mysqli_real_escape_string($dbc, trim($_POST['state']));	
	$sz = mysqli_real_escape_string($dbc, trim($_POST['zipCode']));
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the designer in the database...
		
		// Make the query:
		$q = "INSERT INTO designers (tradeName, desfirstname, deslastname, designeremail, designerpass, 
		testquestion, testquestionanswer, designeraddr, designercity, designerstate, designerzip, 
		designercountry, designerphone) 
		VALUES 
		('$tn', '$fn', '$ln', '$e', '$p', '$tq', '$tqa', '$sa', '$sc', '$ss', '$sz', '$sco', '$sp' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Set the session data:
			$_SESSION['tradeName'] = $tn;
			$_SESSION['firstName'] = $fn;
			$_SESSION['lastName'] = $ln;
			$_SESSION['emailAddress'] = $e;
		
			// Send welcome email
			include ('includesnew/wlcmmsg_send.php');
		
			// Print a message:
			echo '<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
			
			
					<div id="msgdiv_inner">
			
					<h1>Your registration is complete</h1>
				
					<p style="margin:20px 0;">You have successfully created your profile. You will be receiving 
					a confirmation email shortly. If you cannot find it in your regular emails, check in your 
					junk email folder.</p>
						
					<div id="msglink_lhs"><a class="colorlink" href="index.php">Back to home page</a></div>
					
					<div id="msglink_rhs"></div>
						
					</div>
				
				
			</div>
			
			<div id="msgdivb" style="width:90%;margin:0 auto 100px auto;">
			
			</div>';
		 
		

		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div style="margin-top:20px;margin-left:235px;color:#FF0000;"><h5>System Error</h5>
			<p>Your profile could not be created due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '</p> </div>';
						
		} // End of if ($r) IF.

		// Include the footer and quit the script:
		include ('includesnew/footertall.php'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
			<p>The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p> </div>';
		
	} // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>



  <div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1200px;">
			
		<div id="itemdetailssection" style="height:1200px;">
			
		



		<div style="width:100%;">
		<!-- main content starts -->
		
		
			<div id="desregform">  <!-- 62% -->
				
			  <table cellspacing=0 cellpadding=0 width="100%" style="border-style:solid;border-width:0px 0px 0px 0px;border-color:#CDCBCB;"> <!-- Previously 0 0 thin 0 -->
				  <!-- 100% -->
				  
				<tr>
					<!--
					<td width=363 class="topleft-aligned">
					<img border=0 src="images/temp.jpg" width=362> 
					</td>
					<td width=32 rowspan="4">
					&nbsp;
					</td>
					-->
					<td class="topleft-aligned">
					
					<div id="resultheader2" style="width:100%;margin-left:auto;margin-right:auto;"> 			
						<h1>Create your waxmode.com designer profile</h1>		
					</div>
					
					<br><span>Fill the form below and press "Submit" to create your profile</span>
					
					<p id="redtext">*: Required</p>
					
					<!-- <img src = "images/horizline_590px.png" border=0 height="8px" width="595px"> -->
					<br>
					
					<form action="desreg.php" method="post">
						
						<table border="0" cellspacing="0" cellpadding="0" width="600px">  <!-- 82.2% -->
							<tbody>
							<tr>
								<td colspan="2">
								</td>
							</tr>
							<tr height="40">
								<td width="210">Trade Name (Business Name)<span id="redtext">*</span></td>
								<td><input id="tradeName" maxlength="100" name="tradeName" size="60" type="text" value="<?php if (isset($_POST['tradeName'])) echo $_POST['tradeName']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">First Name <span id="redtext">*</span></td>
								<td><input id="firstName" maxlength="100" name="firstName" size="60" type="text" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Last Name <span id="redtext">*</span></td>
								<td><input id="lastName" maxlength="100" name="lastName" size="60" type="text" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Email <span id="redtext">*</span></td>
								<td><input id="emailAddress" maxlength="100" name="emailAddress" size="60" type="text" value="<?php if (isset($_POST['emailAddress'])) echo $_POST['emailAddress']; ?>" /></td>
							</tr>
							<tr height="60">
								<td width="210" class="topleft-aligned">
								<span style="position:relative;bottom:-8px;">Create Your Password <span id="redtext">*</span></span>
								</td>
								<td class="topleft-aligned">
								<span style="position:relative;bottom:-8px;"><input id="pass1" maxlength="40" name="pass1" size="40" type="password" value="" /> </span>
								<p id="smallgray" style="position:relative;bottom:-8px;">(must be between 4 and 20 characters long. These are okay:<br>
								alphabets, numbers, and the special characters  - and _)</p>
								</td>
							</tr>
							<tr height="40">
								<td width="210">Confirm Your Password <span id="redtext">*</span></td>
								<td><input id="pass2" maxlength="40" name="pass2" size="40" type="password" value="" /></td>
							</tr>
							<tr height="50">
								<td width="210" class="topleft-aligned"><span style="position:relative;bottom:-8px;">Test question <span id="redtext">*</span></span></td>
								<td class="topleft-aligned">
									<div style="position:relative;bottom:-8px;">
									
									<!--
									<select name="testquestion">
										<option value="">Select One</option>
										<option value="What is your mothers maiden name?">What is your mothers maiden name?</option>
										<option value="In which city were you born?">In which city were you born?</option>
										<option value="What is your oldest siblings first name?">What is your oldest siblings first name?</option>
										<option value="What is your oldest childs first name?">What is your oldest childs first name?</option>
										<option value="In which city did you attend high school?">In which city did you attend high school?</option>
										<option value="What is the color of the first car your owned?">What is the color of the first car your owned?</option>
									</select>
									-->
									
									<select name="testquestion">
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'Select One')) echo 'selected="selected"'; ?> value="Select One">Select One</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'What is your mothers maiden name?')) echo 'selected="selected"'; ?> value="What is your mothers maiden name?">What is your mothers maiden name?</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'In which city were you born?')) echo 'selected="selected"'; ?> value="In which city were you born?">In which city were you born?</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'What is your oldest siblings first name?')) echo 'selected="selected"'; ?> value="What is your oldest siblings first name?">What is your oldest siblings first name?</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'What is your oldest childs first name?')) echo 'selected="selected"'; ?> value="What is your oldest childs first name?">What is your oldest childs first name?</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'In which city did you attend high school?')) echo 'selected="selected"'; ?> value="In which city did you attend high school?">In which city did you attend high school?</option>
										<option <?php if ((isset($_POST['testquestion'])) && ($_POST['testquestion'] == 'What is the color of the first car your owned?')) echo 'selected="selected"'; ?> value="What is the color of the first car your owned?">What is the color of the first car your owned?</option>
									</select>
									
									</div>
								<p id="smallgray" style="position:relative;bottom:-8px;">(In case your forget your password for logging in)</p>
								</td>
							</tr>
							<tr height="40">
								<td width="210">Answer to test question <span id="redtext">*</span></td>
								<td><input id="testquestionanswer" maxlength="100" name="testquestionanswer" size="60" type="text" value="<?php if (isset($_POST['testquestionanswer'])) echo $_POST['testquestionanswer']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Street Address <span id="redtext">*</span></td>
								<td><input id="address" maxlength="100" name="address" size="60" type="text" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">City <span id="redtext">*</span></td>
								<td><input id="city" maxlength="100" name="city" size="60" type="text" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">State</td>
								<td><input id="state" maxlength="100" name="state" size="60" type="text" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Zip/Postal Code</td>
								<td><input id="zipCode" maxlength="20" name="zipCode" size="20" type="text" value="<?php if (isset($_POST['zipCode'])) echo $_POST['zipCode']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Country <span id="redtext">*</span></td>
								<td><input id="country" maxlength="20" name="country" size="20" type="text" value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>" /></td>
							</tr>
							<tr height="40">
								<td width="210">Phone <span id="redtext">*</span></td>
								<td><input id="phoneNumber" maxlength="100" name="phoneNumber" size="60" type="text" value="<?php if (isset($_POST['phoneNumber'])) echo $_POST['phoneNumber']; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td>
								
								<br>
								<input type="image" border=0 src="imagesnew/buttonsubmit.png" height=27 width=85 /> 								
						 
								<script type="text/javascript" src="jsnew/jquery-1.8.2.min.js"></script>
								<script type="text/javascript" src="jsnew/my_script.js"></script>
								
								</td>
							</tr>
							<tr>
								<td colspan="2">
								</td>
							</tr>						
							<tr height="10">
								<td colspan="2">&nbsp;</td>
							</tr>
						  </tbody>
						</table>
					
					</form>
					
					
					
					</td>
				</tr>
			</table>
			
			</div>
		
		
		<?php
		// Designer reg form for smaller screens
		
		include ('includesnew/desreg_incl.php');
		?>
		
		<!-- main content ends -->
		</div>
				
				
				

				
			
    
		</div>
    
	</div>
    
  </div>
	
  <?php
	include ('includesnew/footertall.php');
  ?>
	
</div>

</body>

</html>
