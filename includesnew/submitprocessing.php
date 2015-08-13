<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if($shopperid != '') {				

		// insert into orders and retrieve orderid
		
			$subtotal = $totalCost - $shipfee;  // First get the subtotal
			
			$q = "INSERT INTO orders (shopperid, ordertotal, shipfee, subtotal, orderdate) 
			VALUES 
			('$shopperid', '$totalCost', '$shipfee', '$subtotal', curdate() )";		
			$r = @mysqli_query ($dbc, $q); // Run the query.
			
			$orderid = mysqli_insert_id($dbc);  // Retrieve the ID from this insert			
			
				if ($r) { 
				// It ran OK.
				}	
				
				
			
			// insert into order_products
			
				// First retrieve some data
				$q1 = "select cart.pcartid, designers.designerid, cart.qty, prodcarttable.productprice
				from cart
				inner join prodcarttable
				on cart.pcartid = prodcarttable.pcartid
				inner join designers
				on prodcarttable.designerid = designers.designerid
				where cart.cookieId = '$cookieId'";
				
				//echo '<br>q1: ' . $q1 . '<br>';
				
				$r1 = @mysqli_query ($dbc, $q1);
				
				while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC))
				{					
					$pcartid = $row["pcartid"];
					$designerid = $row["designerid"];
					$qty = $row["qty"];
					$productprice = $row["productprice"];
			
			
					$q2 = "INSERT INTO order_products (orderid, pcartid, designerid, qty, productprice) 
					VALUES 
					('$orderid', '$pcartid', '$designerid', '$qty', '$productprice' )";	

					//echo '<br>q2: ' . $q2 . '<br>';
					
					$r2 = @mysqli_query ($dbc, $q2); // Run the query.
				}
				
				
				// Copy shipping addr into archive table, with an orderid column to associate to shopper's shopping events
				$q = "INSERT INTO shipaddr_archived (shopperid, orderid, shopperfname, shopperlname, 
				shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry, shopperphone)
				SELECT shopperid, '$orderid', shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, 
				shopperzip, shoppercountry, shopperphone
				FROM shoppers WHERE shopperid = '$shopperid'";				
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				
				$shipaddr_arch_id = mysqli_insert_id($dbc);  // Retrieve the ID from this insert
				
				
				// Copy billing addr into archive table, with an orderid column to associate to shopper's shopping events
				$q = "INSERT INTO billaddr_archived (shopperid, orderid, billingfname, billinglname, 
				billingaddr, billingcity, billingstate, billingzip, billingcountry, billingphone)
				SELECT shopperid, '$orderid', billingfname, billinglname, billingaddr, billingcity, billingstate, 
				billingzip, billingcountry, billingphone
				FROM shopperbilladdr WHERE shopperid = '$shopperid'";
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				
				$billaddr_arch_id = mysqli_insert_id($dbc);  // Retrieve the ID from this insert
				
				
				// Add shipaddr_arch_id, billaddr_arch_id to the orders table
				$q = "UPDATE orders SET
				shipaddr_arch_id = '$shipaddr_arch_id'
				billaddr_arch_id = '$billaddr_arch_id'
				WHERE orderid = '$orderid' AND shopperid = '$shopperid'";				
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
								
				
				// Retrieve shipping address
				$q = "select shopperfname, shopperlname, shopperemail, shopperaddr, shoppercity, shopperstate, shopperzip, 
				shoppercountry, shopperphone from shoppers
				WHERE shopperid='$shopperid'";
				
				// echo '<br>' . $q . '<br>';
				
				$r = @mysqli_query ($dbc, $q); // Run the query.

				if ($r) { // If it ran OK, display the records.	
				
				//get results for display
				while ($row = mysqli_fetch_array($r)) {
					$shopperfname = $row["shopperfname"];
					$shopperlname = $row["shopperlname"];
					$shopperemail = $row["shopperemail"];
					$shopperaddr = $row["shopperaddr"];
					$shoppercity = $row["shoppercity"];
					$shopperstate = $row["shopperstate"];
					$shopperzip = $row["shopperzip"];
					$shoppercountry = $row["shoppercountry"];
					$shopperphone = $row["shopperphone"];			
					}
				}	

				
				// The items from the cart will be deleted in "orderconfirm.php" email script since they have now been purchased
				
				
				mysqli_free_result ($r); // Free up the resources.
				
				
				
				
				
				
				
				
			
			// Send order confirmation email
			include ('includesnew/orderconfirm.php');
		
			// Print a message:
			echo '<div id="bottomcontainer"> 
  
			<div id="bottom">
			
			<div id="itemdetailssection">
			
				<div id="msgdiv">
			
			
					<div id="msgdiv_inner">
			
					<h1>Thank You</h1>
				
					<p style="margin:20px 0;">Your order has been placed. You will be receiving a confirmation email shortly. 
					If you cannot find it in your regular emails, check in your junk email folder.</p>
					
					</div>
				
				
				</div>
			
				<div id="msgdivb">
				
				</div>
			
			
			</div>
    
			</div>
			
			</div>';

			
			include ('includesnew/footertall.php');
				
			
			echo '</div>

			</body>

			</html>';		
				
							
			} // End of if ($r) IF.

			}   // End of the main Submit conditional.