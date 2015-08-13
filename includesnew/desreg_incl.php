<div id="desregform-small">  <!-- 62% -->
			
		  <table cellspacing=0 cellpadding=0 style="border-style:solid;border-width:0px 0px 0px 0px;border-color:#CDCBCB;"> <!-- Previously 0 0 thin 0 -->
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
				
				<div id="resultheader2" style="width:100%; margin-left:auto;margin-right:auto;"> 			
					<h1>Create your designer profile</h1>		
				</div>
				
				<span>Fill the form below and press "Submit" to create your profile</span><br><br>
				
				<p id="redtext">*: Required</p>
				
				<!-- <img src = "images/horizline_590px.png" border=0 height="8px" width="595px"> -->
				<br>
				
				<style>
					td { padding-bottom:10px; }
				</style>
				
				
				<form action="desreg.php" method="post">
				
					<table border="0" cellspacing="0" cellpadding="0">  <!-- 82.2% -->
						<tbody>
						<tr>
							<td>
							</td>
						</tr>
						<tr height="40">
							<td width="210">Trade Name (Business Name)<span id="redtext">*</span><br>
							<input id="tradeName" maxlength="100" name="tradeName" size="40" type="text" value="<?php if (isset($_POST['tradeName'])) echo $_POST['tradeName']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">First Name <span id="redtext">*</span><br>
							<input id="firstName" maxlength="100" name="firstName" size="40" type="text" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Last Name <span id="redtext">*</span><br>
							<input id="lastName" maxlength="100" name="lastName" size="40" type="text" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Email <span id="redtext">*</span><br>
							<input id="emailAddress" maxlength="100" name="emailAddress" size="40" type="text" value="<?php if (isset($_POST['emailAddress'])) echo $_POST['emailAddress']; ?>" /></td>
						</tr>
						<tr height="60">
							<td width="210" class="topleft-aligned">
							<span style="position:relative;bottom:-8px;">Create Your Password <span id="redtext">*</span></span>
							<br>
							<span style="position:relative;bottom:-8px;"><input id="pass1" maxlength="40" name="pass1" size="40" type="password" value="" /> </span>
							<p id="smallgray" style="position:relative;bottom:-8px;">(must be between 4 and 20 characters long. These are okay:<br>
							alphabets, numbers, and the special characters  - and _)</p>
							</td>
						</tr>
						<tr height="40">
							<td width="210">Confirm Your Password <span id="redtext">*</span><br>
							<input id="pass2" maxlength="40" name="pass2" size="40" type="password" value="" /></td>
						</tr>
						<tr height="50">
							<td width="210" class="topleft-aligned"><span style="position:relative;bottom:-8px;">Test question <span id="redtext">*</span></span><br>
							
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
							<td width="210">Answer to test question <span id="redtext">*</span><br>
							<input id="testquestionanswer" maxlength="100" name="testquestionanswer" size="40" type="text" value="<?php if (isset($_POST['testquestionanswer'])) echo $_POST['testquestionanswer']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Street Address <span id="redtext">*</span><br>
							<input id="address" maxlength="100" name="address" size="40" type="text" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">City <span id="redtext">*</span><br>
							<input id="city" maxlength="100" name="city" size="40" type="text" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">State<br>
							<input id="state" maxlength="100" name="state" size="40" type="text" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Zip/Postal Code<br>
							<input id="zipCode" maxlength="20" name="zipCode" size="20" type="text" value="<?php if (isset($_POST['zipCode'])) echo $_POST['zipCode']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Country <span id="redtext">*</span><br>
							<input id="country" maxlength="20" name="country" size="20" type="text" value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>" /></td>
						</tr>
						<tr height="40">
							<td width="210">Phone <span id="redtext">*</span><br>
							<input id="phoneNumber" maxlength="100" name="phoneNumber" size="40" type="text" value="<?php if (isset($_POST['phoneNumber'])) echo $_POST['phoneNumber']; ?>" /></td>
						</tr>
						<tr>
							<td>
							<input type="image" border=0 src="imagesnew/buttonsubmit.png" height=27 width=85 /> 
					 
							<script type="text/javascript" src="jsnew/jquery-1.8.2.min.js"></script>
							<script type="text/javascript" src="jsnew/my_script.js"></script>
							
							</td>
						</tr>
						<tr>
							<td>
							</td>
						</tr>						
						<tr height="20px">
							<td>&nbsp;</td>
						</tr>
					  </tbody>
					</table>
				
				</form>
				
				
				
				</td>
			</tr>
		</table>
		
		</div>