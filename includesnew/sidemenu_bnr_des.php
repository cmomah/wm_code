<div id="grpname">Designer: <h1><?php echo $tradeName; ?></h1></div>
			
			<div id="grplist"> <!-- 170px -->
							<div id='cssmenu'> <!-- Styles for this is in menustyles.css -->
								<ul>
								   
								   <h3 id='grpnamelft'><?php echo $tradeName; ?></h3>
								   
								   <!-- <li class='last'><a href='categresults.php'><span>Back to Landing Page</span></a></li> -->
								   <li class='has-sub'><a href='#'><span>Women</span></a>
									  <ul>
									  
										<?php
						
										$q = "SELECT distinct products.productcategory FROM `products` INNER JOIN designers on products.designerid = designers.designerid where producttype = 'Apparel' and producttarget = 'women'";	
									
										
										// Append what is needed	
										if ($designerid != '') {
										$q = $q . " AND designers.designerid='$designerid'";
										}
										
										
										$r = @mysqli_query ($dbc, $q); // Run the query.
											
										if ($r) { // If it ran OK, display the records.
																	
										// Fetch and display all the records:
										while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
										echo '<li><a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttype=Apparel&producttarget=women&designerid=' . $designerid . '">' . $row['productcategory'] . '</a></li>';
										}
									
										$num = mysqli_num_rows($r);
							
										if ($num == 0) {
											echo '<li><a id="redtext" href="#">None found.</a></li>';
										}
									
										mysqli_free_result ($r); // Free up the resources.	
									
										} else { // If it did not run OK.

										// Public message:
										echo '<p id=redtext>No categories could be retrieved. We apologize for any inconvenience</p>';	
										
										} // End of if ($r) IF.

										?>
										
									  </ul>
								   </li>
								   <li class='has-sub'><a href='#'><span>Men</span></a>
									  <ul>
									  
										<?php	
						
										$q = "SELECT distinct products.productcategory FROM `products` INNER JOIN designers on products.designerid = designers.designerid where producttype = 'Apparel' and producttarget = 'men'";				
										
										
										// Append what is needed	
										if ($designerid != '') {
										$q = $q . " AND designers.designerid='$designerid'";
										}
										
										
										$r = @mysqli_query ($dbc, $q); // Run the query.
											
										if ($r) { // If it ran OK, display the records.
																	
										// Fetch and display all the records:
										while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
										echo '<li><a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttype=Apparel&producttarget=men&designerid=' . $designerid . '">' . $row['productcategory'] . '</a></li>';
										}
									
										$num = mysqli_num_rows($r);
							
										if ($num == 0) {
											echo '<li><a id="redtext" href="#">None found.</a></li>';
										}
									
										mysqli_free_result ($r); // Free up the resources.	
									
										} else { // If it did not run OK.

										// Public message:
										echo '<p id=redtext>No categories could be retrieved. We apologize for any inconvenience</p>';	
										
										} // End of if ($r) IF.

										?>
										
									  </ul>
								   </li>
								   <li class='has-sub'><a href='#'><span>Kids</span></a>
									  <ul>
									  
										<?php	
						
										$q = "SELECT distinct products.productcategory FROM `products` INNER JOIN designers on products.designerid = designers.designerid where producttype = 'Apparel' and producttarget = 'kids'";		
										
										
										// Append what is needed	
										if ($designerid != '') {
										$q = $q . " AND designers.designerid='$designerid'";
										}
										
												
										$r = @mysqli_query ($dbc, $q); // Run the query.
											
										if ($r) { // If it ran OK, display the records.
																	
										// Fetch and display all the records:
										while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
										echo '<li><a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttype=Apparel&producttarget=kids&designerid=' . $designerid . '">' . $row['productcategory'] . '</a></li>';
										}
									
										$num = mysqli_num_rows($r);
							
										if ($num == 0) {
											echo '<li><a id="redtext" href="#">None found.</a></li>';
										}
									
										mysqli_free_result ($r); // Free up the resources.	
									
										} else { // If it did not run OK.

										// Public message:
										echo '<p id=redtext>No categories could be retrieved. We apologize for any inconvenience</p>';	
										
										} // End of if ($r) IF.

										?>
										
									  </ul>
								   </li>
								   <li class='has-sub'><a href='#'><span>Accessories</span></a>
									  <ul>
									  
										<?php	
						
										$q = "SELECT distinct products.productcategory FROM `products` INNER JOIN designers on products.designerid = designers.designerid where producttype = 'Accessories'";			
										
										
										// Append what is needed	
										if ($designerid != '') {
										$q = $q . " AND designers.designerid='$designerid'";
										}
										
											
										$r = @mysqli_query ($dbc, $q); // Run the query.
											
										if ($r) { // If it ran OK, display the records.
																	
										// Fetch and display all the records:
										while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
										echo '<li><a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttype=accessories&designerid=' . $designerid . '">' . $row['productcategory'] . '</a></li>';
										}
									
										$num = mysqli_num_rows($r);
							
										if ($num == 0) {
											echo '<li><a id="redtext" href="#">None found.</a></li>';
										}
									
										mysqli_free_result ($r); // Free up the resources.	
									
										} else { // If it did not run OK.

										// Public message:
										echo '<p id=redtext>No categories could be retrieved. We apologize for any inconvenience</p>';	
										
										} // End of if ($r) IF.

										?>
										
									  </ul>
								   </li>
								</ul>
							</div>
			</div>
			
			<div id="grpbanner"><img src="<?php echo $designerimage; ?>" width="100%" height="auto"></div>
		