<?php 
session_start();

include ('includesnew/topcontainer_shopping.php');



// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Retrieve the $fromcart value that indicates if user came from the cart page
		if(isset($_POST['fromcart'])) {
			$fromcart = $_POST["fromcart"];
		}

	$errors = array(); // Initialize an error array.
	
	if (empty($_POST['shopperfname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['shopperfname']));
	}
		
	// Check for a last name:
	if (empty($_POST['shopperlname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['shopperlname']));
	}
	
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['password']));
	}
	
	// Check for test question:
	if (empty($_POST['testquestion'])) {
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
	
	// Check for email
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}	
	
	// Prevent duplicate emails in the system	
	$q = "SELECT shopperemail FROM shoppers WHERE shopperemail='$e'";		
	$r = @mysqli_query ($dbc, $q); // Run the query.
						
	// Check the result:
	if (mysqli_num_rows($r) == 1) {
		$errors[] = 'The email address you entered already exists as it has been used to register here before.';
	} 	
		
	// Retrieve rest of data and store in variables:

	// (there are no additional variables to retrieve and store)
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the shopper in the database...
		
		// Make the query:
		$q = "INSERT INTO shoppers (shopperfname, shopperlname, shopperemail, shopperpass, 
		testquestion, testquestionanswer) 
		VALUES 
		('$fn', '$ln', '$e', '$p', '$tq', '$tqa' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		$shopperid = mysqli_insert_id($dbc);  // Retrieve the ID from this insert
		
		if ($r) { // If it ran OK.			
		
			// Set the session data:
			$_SESSION['shopperfname'] = $fn;
			$_SESSION['shopperlname'] = $ln;
			$_SESSION['shopperemail'] = $e;
			$_SESSION['shopperid'] = $shopperid;
		
			// Send welcome email
			include ('includesnew/wlcmmsg_send.php');
			
		
			// Print a message:
			echo '<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
			
			
					<div id="msgdiv_inner">
			
					<h1>Your registration is complete</h1>
				
					<p style="margin:20px 0;">You have successfully created your account. You will be receiving 
					a confirmation email shortly. If you cannot find it in your regular emails, check in your 
					junk email folder.</p>';
						
						if ((isset($fromcart))&&(($fromcart)!= '')) { // To shipping page if user was in process of checking out
							echo '<div id="msglink_lhs"><a class="colorlink" href="shipping.php?fromcart=true">Continue Checking Out</a></div>';

						} else { // Else, redirect to shopping pages		
							echo '<div id="msglink_lhs"><a class="colorlink" href="categresults.php?producttarget=women">Continue shopping</a></div>';
						}
					
					echo '<div id="msglink_rhs"> 
						
						</div>
						
					</div>
				
				
			</div>
			
			<div id="msgdivb" style="width:90%;margin:0 auto 100px auto;">
			
			</div>';

	 
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
			<p>Your account could not be created due to a system error. We apologize for any inconvenience.</p>'; 
			
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
  
    <div id="bottom">
			
		<div id="itemdetailssection">
			
			<div id="mywrap_reg">  
		
					<form name="form1" action="createprofile.php" method="post">
					
							<div style="width:183px; margin:10px auto 5px auto;">
								<img src="imagesnew/joinuscaption.png" height=30 width=183 border=0 />
							</div>
							
							<div style="width:246px; margin:0 auto 20px auto;">
								<a href="desreg.php"><img src="imagesnew/designerjoinusprompt.png" height=25 width=246 border=0 /></a>
							</div>
							
							<div style="width:201px; margin:10px auto;">
								<a href="signin.php"><img src="imagesnew/memberloginprompt.png" height=22 width=201 border=0 /></a>
							</div>
					
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">First Name:</div>   <div style="float:right;"><input id="i1" name="shopperfname" type="text" value="" class="required" size="20" /></div>
							</div>
					
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Last Name:</div>   <div style="float:right;"><input id="i1" name="shopperlname" type="text" value="" class="required" size="20" /></div>
							</div>
					
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Email:</div>   <div style="float:right;"><input id="i1" name="email" type="text" value="" class="required" size="20" /></div>
							</div>
					
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Password:</div>   <div style="float:right;"><input id="i2" name="password" type="password" value="" class="required" size="20" /></div>
							</div>
							
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">T. Question:</div> 
								
								<div style="float:right;">
									<select id="i1" class="required" name="testquestion" size="1">
										<option value="">Select a test question</option>
										<option value="What is your mothers maiden name?">What is your mothers maiden name?</option>
										<option value="In which city were you born?">In which city were you born?</option>
										<option value="What is your oldest siblings first name?">What is your oldest siblings first name?</option>
										<option value="What is your oldest childs first name?">What is your oldest childs first name?</option>
										<option value="In which city did you attend high school?">In which city did you attend high school?</option>
										<option value="What is the color of the first car your owned?">What is the color of the first car your owned?</option>
									</select>
								</div>
								
							</div>	
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Answer:</div> <div style="float:right;"> <input id="i3" name="testquestionanswer" type="text" value="" class="required" size="20" /> </div>
							</div>
								
							<div style="width:85px; margin:20px auto 10px auto;"> 

								<input type="hidden" name="fromcart" value="<?php if (isset($fromcart)) { echo $fromcart; } ?>"> <!-- tracks shopper that just came from the checkout page and had to create his/her profile -->
								
								<input type="image" border=0 src="imagesnew/shopnow_submit.png" height=27 width=85 />
							</div>
								
							<div>
								<div style="width:20px;margin:10px auto;">  OR  </div>
							</div>
								
							<div style="width:195px; margin:0 auto 20px auto;">
								<a href="#"><img src="imagesnew/joinwithfacebook.png" height=32 width=195 /> </a>
							</div>
							
							<div>
								<p class="formlegal">By signing up to join WaxMode through email or Facebook, you are agreeing to the <a href="#">Terms and Conditions</a> for the WaxMode.com shopping site.</p>
							</div>
							
					</form>	
			
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
