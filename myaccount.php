<?php
session_start();

// Coming from sign in page	(indicates if user has signed in)
	if(isset($_GET['si'])) {
		$_SESSION['si'] = $_GET["si"];
	}

// Retrieve shopper's id if signed in 	
	if((isset($_SESSION['shopperid']))&&(isset($_SESSION['si']))) {
		$shopperid = $_SESSION['shopperid'];
	} else {
		header("Location: http://www.waxmode.com/responsive2/signin.php?frommyct=true");
	}	
		
	if(isset($_SESSION['shopperfname'])) {
		$shopperfname = $_SESSION['shopperfname'];
	}

	
$title='My Account';

include ('includesnew/topcontainer_shopping.php');

	

	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {				
			
			if(isset($_GET['orderid'])) {
				$orderid = $_GET['orderid'];
			}
	
			if(isset($_GET['op'])) {
				$op = $_GET['op'];
			}
			
			if(($op == 'addr')&&($shopperid != '')) {
			// Retrieve the addresses:
			
			// Retrieve the shipping address:	
			
				$q = "select shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry, shopperphone from shoppers
				WHERE shopperid='$shopperid'";
				
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
					
					
					
					
					// Retrieve the billing address:
					
						
						$q = "select billingfname, billinglname, billingaddr, billingcity, billingstate, billingzip, billingcountry, billingphone from shopperbilladdr
						WHERE shopperid='$shopperid'";
						
						
						//echo '<br>' . $q . '<br>';
						
						$r = @mysqli_query ($dbc, $q); // Run the query.

						if ($r) { // If it ran OK, display the records.	
						
						//get results for display
						while ($row = mysqli_fetch_array($r)) {
							$billingfname = $row["billingfname"];
							$billinglname = $row["billinglname"];
							$billingaddr = $row["billingaddr"];
							$billingcity = $row["billingcity"];
							$billingstate = $row["billingstate"];
							$billingzip = $row["billingzip"];
							$billingcountry = $row["billingcountry"];
							$billingphone = $row["billingphone"];			
							}
							
							//echo '<br>$billingaddr #1' . $billingaddr . '<br>';
							
							mysqli_free_result ($r); // Free up the resources.	
										
							} else { // If it did not run OK.

							// Public message:
							echo '<p class="redtext">Your billing address could not be retrieved. We apologize for any inconvenience.</p>';
										
							} // End of if ($r) IF.
							
			}				
					
			if($op == 'ordhst') {
			// Retrieve the order history:
			
				$q = "select orderdate, orderid, orderstatus from orders
				WHERE shopperid='$shopperid' order by orderdate DESC LIMIT 15";
				
				// echo '<br>' . $q . '<br>';
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
					
			}
			
			if((isset($orderid))&&($orderid != '')) {  
			
			// itemdetails query
				$q1 = "select prodcarttable.pcartid, designers.tradeName, prodcarttable.productname, prodcarttable.productprice, productsize.size, productcolor.color,
				order_products.qty, order_products.itemstatus, order_products.shipdate 
				from prodcarttable
				inner join designers
				on prodcarttable.designerid = designers.designerid
				inner join productsize
				on prodcarttable.sizeid = productsize.sizeid
				inner join productcolor
				on prodcarttable.productcolorid = productcolor.productcolorid
				inner join order_products
				on prodcarttable.pcartid = order_products.pcartid
				WHERE order_products.orderid = '$orderid'
				order by prodcarttable.productname asc";
				
				// echo '<br>q: ' . $q1 . '<br>';
				
				$r1 = @mysqli_query ($dbc, $q1); // Run the query.
			
			
			
			
			// orderdetails query
				$q = "select subtotal, shipfee, ordertotal, orderdate, cctype, ccnumber_testonly, orderstatus from orders
				WHERE orderid='$orderid'";
				
				// echo '<br>' . $q . '<br>';
				
				$r = @mysqli_query ($dbc, $q); // Run the query.

				if ($r) { // If it ran OK, display the records.	
				
				//get results for display
				while ($row = mysqli_fetch_array($r)) {
					$subtotal = $row["subtotal"];
					$shipfee = $row["shipfee"];
					$ordertotal = $row["ordertotal"];
					$orderdate = $row["orderdate"];
					$cctype = $row["cctype"];
					$ccnumber_testonly = $row["ccnumber_testonly"];	
					$orderstatus = $row["orderstatus"];		
					}
						
					mysqli_free_result ($r); // Free up the resources.	
								
					} else { // If it did not run OK.

					// Public message:
					echo '<p class="redtext">Your order details could not be retrieved. We apologize for any inconvenience.</p>';
								
					}
			}
			
			
			
			
			if($op == 'siinfo') {
			// Retrieve the email address:	
			
				$q = "select shopperemail from shoppers
				WHERE shopperid='$shopperid'";
				
				// echo '<br>' . $q . '<br>';
				
				$r = @mysqli_query ($dbc, $q); // Run the query.

				if ($r) { // If it ran OK, display the records.	
				
				//get results for display
				while ($row = mysqli_fetch_array($r)) {
					$shopperemail = $row["shopperemail"];			
					}
						
					mysqli_free_result ($r); // Free up the resources.	
								
					} else { // If it did not run OK.

					// Public message:
					echo '<p class="redtext">Your email address could not be retrieved. We apologize for any inconvenience.</p>';
								
					} // End of if ($r) IF.								
			}
			
			
			
			
			
			
			
	}						


							
?>

<div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1100px;">
			
		<div id="itemdetailssection" style="height:1100px;">

		
			<div style="width:100%;">
		
				<div style="width:23%; float:left;"><h1 class="chkhdr">YOUR ACCOUNT</h1></div>
				
				<div style="width:73%; float:right;margin-top:19px;"><h3>View and manage your account and order details</h3></div>
			
			</div>
			
			<div style="width:100%; clear:both;">
			
				<!-- LEFT -->
				<div id="myacct_lhs" style="width:23%; float:left;">
				
					<div>
						
						<div style="height:630px; margin:0 0 30px 0; background-color:#EDEDED;">		

							<div style="height:34px;padding-left:14px;padding-top:5px;float:left;"><a href="myaccount.php?op=ordhst">Order History</a></div> <div style="padding-right:20px;padding-top:13px;float:right;"><img src="imagesnew/menu_arrow.png" border="0" width="8px" height="16px"></div>							
							
							<div style="height:2px; background-color:#fff; clear:both;"></div>
							
							<div style="height:34px;padding-left:14px;padding-top:5px;float:left;"><a href="myaccount.php?op=siinfo">Sign-In Information</a></div> <div style="padding-right:20px;padding-top:13px;float:right;"><img src="imagesnew/menu_arrow.png" border="0" width="8px" height="16px"></div>							
							
							<div style="height:2px; background-color:#fff; clear:both;"></div>
							
							<div style="height:34px;padding-left:14px;padding-top:5px;float:left;"><a href="myaccount.php?op=addr">Addresses & Phone Numbers</a></div> <div style="padding-right:20px;padding-top:13px;float:right;"><img src="imagesnew/menu_arrow.png" border="0" width="8px" height="16px"></div>														
							
							<div style="height:2px; background-color:#fff; clear:both;"></div>
							
							<div style="height:34px;padding-left:14px;padding-top:5px;float:left;"><a href="view_cart.php">Shopping Cart</a></div> <div style="padding-right:20px;padding-top:13px;float:right;"><img src="imagesnew/menu_arrow.png" border="0" width="8px" height="16px"></div>														
							
							<div style="height:2px; background-color:#fff; clear:both;"></div>
							
						</div>
				
					</div>
				
				</div>
				
				<!-- RIGHT -->
				<div id="myacct_rhs" style="width:73%; float:right;">
				
					<div>
				
						<div style="width:100%; height:30px; background-color:#EAE9E8; text-align:center;margin:0 0 30px 0;">
						<h3 style="padding-top:5px;">
						
						<?php 
						if($orderid != '') {
							echo 'Order Details for Order No. ' . $orderid;
						}
						if(($op == 'ordhst')&&($orderid == '')) {
							echo 'Order History';
						} 						 
						if($op == 'siinfo') {
							echo 'Sign-In Information';
						}
						if($op == 'addr') {
							echo 'Address Information';
						}
						?>
						
						</h3>
						</div>
						
						<div style="height:400px;">	
						
						<?php 
						if($op == '') {
							echo 'Hello ' . $shopperfname . ':<br>
							Please click an option to the left to manage your information and preferences or to view your order history.';
						}
						?>
						
						
							<?php				
							if(($op == 'addr')&&($shopperid != '')) {
							
							echo '<div style="width:90%; padding:0 0 2px 0;">';
							
								echo '<div><h3 style="padding-bottom:10px;">Your current shipping address</h3></div>
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
									<?php echo '<br>' . $shoppercountry . '
									<br>' . $shopperphone; 
									
								echo '</div>
							
							</div>';
							
							
							echo '<div style="margin-bottom:30px;">
							<a class="colorlink-ul" href="shipedit.php?frommyct=true">Edit Shipping Address</a>
							</div>';
							
							}
							
							
							
							
							
							
						if(($op == 'addr')&&($shopperid != '')) {
						
						echo '<div style="width:90%; padding:0 0 2px 0;">';
						
							echo '<div><h3 style="padding-bottom:10px;">Your current billing address:</h3></div> 
							<div>';
							?>
								<?php echo $billingfname . ' ' . $billinglname; ?>
								<?php echo '<br>' . $billingaddr; ?>
								<?php echo '<br>' . $billingcity; 					
								if($billingstate != '') {
								  echo ', ' . $billingstate; 
								}
								if($billingzip != '') {
								  echo ', ' . $billingzip; 
								}
								?>
								<?php echo '<br>' . $billingcountry . '
									<br>' . $billingphone; 
								
							echo '</div>
						
						</div>';
						
						echo '<div style="margin-bottom:30px;">
							<a class="colorlink-ul" href="billeditacct.php?frommyct=true">Edit Billing Address</a>
							</div>';						
						
						}
						
						
						
						
						if(($op == 'ordhst')&&($orderid == '')) {
						
						// Populated from query that is near the top of the page
							
							echo '<div style="width:90%; padding:0 0 20px 0;">';
							
								echo '<div><p style="padding-bottom:20px;">To view details of an order or return an item, click on it\'s order reference number.
								</p></div>';
								
								
								echo '<table width="100%" cellspacing="0" cellpadding="6" border="1">
									  <tr>
										<td width="40%" bgcolor="#F9F9F9"><strong>Order Date</strong></td>
										<td width="28%" bgcolor="#F9F9F9"><strong>Order Ref No.</strong></td>
										<td width="17%" bgcolor="#F9F9F9"><strong>Status</strong></td>
									  </tr>';
								
								while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
								{
													
								echo '<tr>
										<td>
										' . $row["orderdate"] . '						
										</td> 
										
										<td> 
										<a class="colorlink-ul" href="myaccount.php?op=ordhst&orderid=' . $row["orderid"] . '">' . $row["orderid"] . '</a>
										</td>
										
										<td>   
										' . $row["orderstatus"] . '  
										</td> 
									</tr>';
									
								}	

								
								$num = mysqli_num_rows($r);
							
								if ($num == 0) {
									echo '<p id=redtext>No order records were found for this registered account.</p>';
								}
								
								
								mysqli_free_result ($r); // Free up the resources.
								
								echo '</table>';
								
								
							}
							
							
							
							if((isset($orderid))&&($orderid != '')) {
							
								// Populated from itemdetails and orderdetails queries that are near the top of the page
							
								
								// Item Details
								echo'<h3 style="margin-bottom:20px;">The Item(s) You Purchased</h3>
								<table width="100%" cellspacing="0" cellpadding="6" border="1">
								  <tr>
									<td width="16%" bgcolor="#F9F9F9"><strong>Product ID</strong></td>
									<td width="24%" bgcolor="#F9F9F9"><strong>Product</strong></td>
									<td width="20%" bgcolor="#F9F9F9"><strong>Designer</strong></td>
									<td width="13%" bgcolor="#F9F9F9"><strong>Unit Price</strong></td>
									<td width="9%" bgcolor="#F9F9F9"><strong>Quantity</strong></td>
									<td width="9%" bgcolor="#F9F9F9"><strong>Status</strong></td>
									<td width="9%" bgcolor="#F9F9F9"><strong>Ship Date</strong></td>
								  </tr>';
							
							
								while ($row = mysqli_fetch_array($r1))
								{
													
								echo '<tr>
										
										<td>' . 
										$row["pcartid"] . '
										</td>
										
										<td>' . $row["productname"] . '<br>' . $row["size"] . ' - ' . $row["color"] . '						
										</td> 
										
										<td>' . 
										$row["tradeName"] . '
										</td>
										
										<td>$' .   
										number_format($row["productprice"], 2, ".", ",") . '  
										</td>  
										
										<td>' .  
										$row["qty"] . '
										</td>  
										
										<td>' .  
										$row["itemstatus"] . '
										</td>   
										
										<td>' .  
										$row["shipdate"] . '
										</td>
									</tr>';
									
								}		
							
								$num = mysqli_num_rows($r1);
										
								if ($num == 0) {
									echo '<p id=redtext>No records were found for the selected order number.</p>';
								}
											
											
								mysqli_free_result ($r1); // Free up the resources.
							
								echo '</table>';



								
							// Order Details
							
							echo '<div><h3 style="margin:30px 0 15px 0;">Other Details for the Order ' . $orderid . '</h3></div> 
							<div>';
							
								echo 'Subtotal: ' . $subtotal . '<br>';
								echo 'Shipping Fee: ' . $shipfee . '<br>';
								echo 'Grand Total: ' . $ordertotal . '<br>';
								echo 'Order Date: ' . $orderdate . '<br>';
								echo 'Card Type: ' . $cctype . '<br>';
								echo 'Card Last four: ' . $ccnumber_testonly . '<br>';
								echo 'Order Status: ' . $orderstatus . '<br>';								 
								
							echo '</div>';

								
							
							}
							
							if($op == 'siinfo') {
							
								echo '<div><p style="margin:30px 0;font-weight:bold;">Update your sign-in information for your online account as needed</p></div> 
								
								<div>';							
							
								echo 'Email Address: ' . $shopperemail . '<span style="margin-left:60px;"><a class="colorlink-ul" href="signineditacct.php?frommyct=true">Edit Email Address</a></span>
									
								</div>';
							
							
							echo '<div style="margin:30px 0;">
							<a class="colorlink-ul" href="pswr.php">Click Here</a> to Reset Password
							</div>
							
							<div>
							<a class="colorlink-ul" href="signinhelp.php">Forgot Your Password?</a>
							</div>';							
							
							}
							
							
							
							
														
						?>	
							
							
							
						
						
						</div>					
				
					</div>
				
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
