		  <div id="grpresults">
		
		  <table border=0 cellspacing=0 cellpadding=0 width="100%" style="position:relative;right:0px;"> <!-- previous width 1101 -->
					<tr>
						
						<td id="grpresults-tdr" valign="top" style="width:100%;">  <!-- Increased from 84.08%, the width of the right div above this one,
															to 85.867% so as the make up for the gap and make the product images
															to be flush with the divs above it -->
						
						
						
						<?php
				
						// Multi-column display of results...
						
							// $q="select * from products LIMIT $start, $display";
							
							
							
							
							// For search query submission:
							$q = "select products.productid, products.productimage, products.productname, products.productprice from products
								inner join designers
								on products.designerid = designers.designerid
								WHERE designers.status='active' AND products.status='active'
								AND ((products.productname LIKE '%".$keyword."%')||(products.productdescription LIKE '%".$keyword."%'))";
								
								If ($designerid != '') {
								$q = $q . " AND designers.designerid='$designerid'";
								}
								
								if ($designers != '') { 
								$q = $q . " AND designers.tradeName='$designers'";
								}
								
								// Append the page limit control
								$q = $q . " LIMIT $start, $display";
							
							$r = @mysqli_query ($dbc, $q); // Run the query.
							
							$num = mysqli_num_rows($r);
							
							if ($num == 0) {
								echo '<div style="width:35%; min-width:300px; margin-left:auto;margin-right:auto;"><p id=redtext>No products were returned from the search.</p></div>';
							}
						 
							$cols=$columncount;	 // We define the number of columns (populated from the file that includes this one using $columncount variable)
							echo "<table width='100%' border=0>";	// The container table with $cols columns
							do{
								echo "<tr>";
								for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
															// the records are less than $cols
									$row=mysqli_fetch_array($r);
									if($row){
										$img = $row['productimage'];
						 ?>
								<td valign="top" align="left">
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tr valign="top">  <!-- Previous td width: 200. Previous image width: 200 -->
											<td id="tdcolspace"></td>  <!-- spacer td just added  -->
											
											<td id="tdcols">	

												<div id="prodimagediv">
											  
												<a href="itemdetails.php?productid=<?=$row['productid'] ?>"><img id="productlistimg" src="<?=$img ?>" border=0 /></a>
												
												</div>
												
												<div id="prodnamediv">
												
												<a href="itemdetails.php?productid=<?=$row['productid'] ?>"><span id="prodname"><?=$row['productname'] ?></span></a><br />
												<span id="redtext"><?=$row['productprice'] ?></span>
											 
												</div>
											  
											</td>
										</tr>
										<tr height="40">
											<td colspan="2"></td> <!-- Just added colspan to accomodate the new spacer td added above -->
										</tr>
								   </table>
								</td>
						<?
									}
									else{
										echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
									}
								}
							} while($row);
							echo "</tr></table>";
							
							// echo '<br>' . $q . '<br>'; 
							
						?>	
							
							<!-- the left empty "td" of the results section is 8.5% of a third of the 1175px table width, which is 25px -->
							<div id="grppagination">   <!-- Previous: width:811px;margin-left:45px;margin-right:45px; -->
									<div>
										<?php
										// Make the links to other pages, if necessary.
										if ($pages > 1) {
											
											echo '<p>';
											$current_page = ($start/$display) + 1;
											
											// If it's not the first page, make a Previous button:
											if ($current_page != 1) {
												echo '<a href="srchresults.php?s=' . ($start - $display) . '&p=' . $pages . '&designers=' . $designers . '&designerid=' . $designerid . '&keyword=' . $keyword . '">Previous</a> ';
											}
											
											// Make all the numbered pages:
											for ($i = 1; $i <= $pages; $i++) {
												if ($i != $current_page) {
													echo '<a href="srchresults.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&designers=' . $designers . '&designerid=' . $designerid . '&keyword=' . $keyword . '">' . $i . '</a> ';
												} else {
													echo $i . ' ';
												}
											} // End of FOR loop.
											
											// If it's not the last page, make a Next button:
											if ($current_page != $pages) {
												echo '<a href="srchresults.php?s=' . ($start + $display) . '&p=' . $pages . '&designers=' . $designers . '&designerid=' . $designerid . '&keyword=' . $keyword . '">Next</a>';
											}
											
											echo '</p>'; // Close the paragraph.
											
										} // End of links section.
										
										?>
									</div>
							</div>
						
						</td>
					</tr>
				</table>
  
			</div>