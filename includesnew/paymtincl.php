<!-- Included in paymt.php and submit.php for posted data validation retry -->
<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="fix_expand">


			<div><h1 class="chkhdr">WAXMODE CHECK OUT</h1></div>   <!-- Div previously chkhdrdiv -->
			
			<div id="chkbrcrumbs">
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Address</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Method</h4></div>
				<div class="chkbrcrumbs_step" id="currentstep"><h4 class="currentsteplabel">Billing Address</h4></div>
				<div class="chkbrcrumbs_lstep"><h4 class="chksteplabel">Payment / Submit</h4></div>
			</div>
			
			<div id="chktsh_lhs">				
				
				<?php				
				if (!empty($shopperaddr)) {
				
				echo '<div style="width:90%; padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 1px 0;">';
				
					echo '<div><h1 style="padding:0 0 20px 0;">1. Shipping Address</h1></div>
					<div>';
					?>
						<?php echo $shopperfname . ' ' . $shopperlname; ?>
						<?php echo '<br>' . $shopperaddr; ?>
						<?php echo '<br>' . $shoppercity; 					
						if($shopperstate != '') {
						  echo ', ' . $shopperstate; 
						}
						if($shopperzip != '') {
						  echo ', ' . $shopperzip; 
						}
						?>
						<?php echo '<br>' . $shoppercountry; 
						
					echo '</div>';	
					
					if (!empty($sameasshipping)) {
						echo '<div>(Billing Address is: ' . $sameasshipping . ')</div>';
					} else {
						echo '<div>(Billing Address is not same as shipping. I will enter it later.)</div>';
					}
				
					echo '<div style="margin-top:10px;">
					<a class="colorlink-ul" href="shipedit.php?fromcart=true&fromshp=true">Edit Shipping Address</a>
					</div>
				
				</div>';
				}
				?>
				
				<div style="width:90%; height:90px; margin-bottom:40px; padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 1px 0;">
				
					<div><h1 style="padding:20px 0;">2. Shipping Options</h1></div>
				
					<div><?php echo $shpoption; ?> </div> 
				
				</div>	
				
				
				<?php				
				
				$carttitle = 'Order Summary';
				$shipfee = $shipfee; 
				$showeditcartlink = 'true';
				$showreduceandremove = 'false';
				$showcheckoutbutton = 'false';
			
				include ('cartnew.php');
				?>
				
			</div>

			
			<div id="chktsh_rhs">
			
				
				<div style="width:90%; margin-left:15%;padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 0 0;">				
					
				<form action="submit.php" method="POST" id="payment-form">
				
				
				
				<div style="width:380px; height:280px; padding:0 0 30px 0;">
						
					<div><h1 style="padding:0 0 20px 0;">3. Billing Address</h1></div>
						
					<!-- Temporary credit card form was here before -->
					
					<div id="wrap" style="width:420px;margin-left:0;margin-top:0;padding-left:0;padding-top:0;"> 			
				
							





					<?php
					if (!empty($sameasshipping)) {  
					// That is, shopper checked the box (in shipping.php) to indicate shipping addr = billing addr
					// Therefore, retrieve shipping address data and populate the billing address form
							
							
							
							if($shopperid != '') {
							$q = "select shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry, shopperphone from shoppers
							WHERE shopperid='$shopperid'";
							}
							
							// echo '<br>' . $q . '<br>';
							
							$r = @mysqli_query ($dbc, $q); // Run the query.

							if ($r) { // If it ran OK, display the records.	
							
							//get results for display
							while ($row = mysqli_fetch_array($r)) {
								$shopperfname = $row["shopperfname"];
								$shopperlname = $row["shopperlname"];
								$shopperaddr = $row["shopperaddr"];
								$shoppercity = $row["shoppercity"];
								$shopperstate = $row["shopperstate"];
								$shopperzip = $row["shopperzip"];
								$shoppercountry = $row["shoppercountry"];
								$shopperphone = $row["shopperphone"];			
								}
									
								mysqli_free_result ($r); // Free up the resources.	
											
								} else { // If it did not run OK.

								// Public message:
								echo '<p class="redtext">Your address could not be retrieved. We apologize for any inconvenience.</p>';
											
								} // End of if ($r) IF.
								?>
								
								<!-- Display form -->
								<div class="shipform"> 
														
									<div class="input">
										First Name:<br> <input id="i1" name="billingfname" type="text" value="<?php echo $shopperfname; ?>" class="required" size="50" />
									</div>
									<div class="input">
										Last Name:<br> <input id="i2" name="billinglname" type="text" value="<?php echo $shopperlname; ?>" class="required" size="50" />
									</div>
									<div class="input">
										Street Address:<br> <input id="i3" name="billingaddr" type="text" value="<?php echo $shopperaddr; ?>" class="required" size="50" />
									</div>
									
									<div class="input">
										<div class="csz">
											City:<br> <input id="i4" name="billingcity" type="text" value="<?php echo $shoppercity; ?>" class="required" size="10" />
										</div>
										<div class="csz">
											Zip/Postal Code:<br> <input id="i6" name="billingzip" type="text" value="<?php echo $shopperzip; ?>" size="10" />
										</div>
									</div>
								
									<div class="input">
										<div class="csz">
											Country:<br> <input id="i4" name="billingcountry" type="text" value="<?php echo $shoppercountry; ?>" class="required" size="10" />
										</div>
										<div class="csz">
											State:<br> <input id="i6" name="billingstate" type="text" value="<?php echo $shopperstate; ?>" size="10" />
										</div>
									</div>
										
									<div class="input">
										Phone Number:<br> <input id="i5" name="billingphone" type="text" value="<?php echo $shopperphone; ?>" class="required" size="50" />
									</div>
									
								</div>
							
							
							
							
							




					<?php
					} else { // box was unchecked, so provide unfilled form 
					?>	
								
							<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
								
								<div class="input">
									First Name:<br> <input id="i1" name="billingfname" type="text" value="<?php if(isset($_SESSION['shopperfname'])) { echo $_SESSION['shopperfname']; } ?>" class="required" size="50" />
								</div>
								<div class="input">
									Last Name:<br> <input id="i2" name="billinglname" type="text" value="<?php if(isset($_SESSION['shopperlname'])) { echo $_SESSION['shopperlname']; } ?>" class="required" size="50" />
								</div>
								<div class="input">
									Street Address:<br> <input id="i3" name="billingaddr" type="text" value="<?php if (isset($_POST['billingaddr'])) echo $_POST['billingaddr']; ?>" class="required" size="50" />
								</div>
								
								<div class="input">
									<div class="csz">
										City:<br> <input id="i4" name="billingcity" type="text" value="<?php if (isset($_POST['billingcity'])) echo $_POST['billingcity']; ?>" class="required" size="10" />
									</div>
									<div class="csz">
										Zip/Postal Code:<br> <input id="i6" name="billingzip" type="text" value="<?php if (isset($_POST['billingzip'])) echo $_POST['billingzip']; ?>" size="10" />
									</div>
								</div>
							
								<div class="input">
									<div class="csz">
										Country:<br> <input id="i4" name="billingcountry" type="text" value="<?php if (isset($_POST['billingcountry'])) echo $_POST['billingcountry']; ?>" class="required" size="10" />
									</div>
									<div class="csz">
										State:<br> <input id="i6" name="billingstate" type="text" value="<?php if (isset($_POST['billingstate'])) echo $_POST['billingstate']; ?>" size="10" />
									</div>
								</div>
								
								<div class="input">
									Phone Number:<br> <input id="i5" name="billingphone" type="text" value="<?php if (isset($_POST['billingphone'])) echo $_POST['billingphone']; ?>" class="required" size="50" />
								</div> 
								
							</div>
				
					<?php
					}
					?>
						</div>
						
					
						<div class="shpsubmit">							
						
							<div style="float:left;">
							<input type="hidden" name="fromcart" value="true"> 
							<input type="hidden" name="sameasshipping" value="<?php echo $sameasshipping; ?>">
							<input type="hidden" name="shpoption" value="<?php echo $shpoption; ?>">
							<input type="hidden" name="shipfee" value="<?php echo $shipfee; ?>">
									
							<input style="margin-top:5px;" type="image" border=0 src="imagesnew/saveandcontinue.png" height=27 width=113 />
							</div>
								
						</div>
						
					
				
				</div>
				
				</form>
			
			
			  </div>
			
				
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