<?php
$title='Product Listing';
include ('includesnew/topcontainer_shopping.php');


// Code that displays product results listing from clicking any of the category links
// (e.g. Designers, Women, Men, etc.). Also displays results from using the Search form
// The code is written to display results on multiple columns, and also paginate



	
	
	// Retrieve passed parameter

	// designerid, productcategory, producttarget
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
		if(isset($_GET['designerid'])) {
		$designerid = $_GET["designerid"];
		} 
		
		if(isset($_GET['productcategory'])) {
		$productcategory = $_GET["productcategory"];
		}
		
		if(isset($_GET['producttarget'])) {
		$producttarget = $_GET["producttarget"];
		}
			
		if(isset($_GET['designers'])) {
		$designers = $_GET['designers'];
		}				
		
		if(isset($_GET['producttype'])) {
		$producttype = $_GET["producttype"];
		}
		
		if(isset($_GET['productprice'])) {
		$productprice = $_GET['productprice'];
		}
		
		if(isset($_GET['color'])) {
		$color = $_GET['color'];
		}
		
		if(isset($_GET['size'])) {
		$size = $_GET['size'];
		}
		
		if(isset($_GET['occasion'])) {
		$occasion = $_GET['occasion'];
		}
	
	}
		//designers, productprice, color, size, occassion
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					
		if(isset($_POST['designerid'])) {
		$designerid = $_POST['designerid'];
		}
		
		if(isset($_POST['productcategory'])) {
		$productcategory = $_POST['productcategory'];
		}
		
		if(isset($_POST['producttarget'])) {
		$producttarget = $_POST['producttarget'];
		}	
		
		//search criteria: designers, productprice, color, size, occasion
		if(isset($_POST['designers'])) {
		$designers = $_POST['designers'];
		}		
		
		if(isset($_POST['productprice'])) {
		$productprice = $_POST['productprice'];
		}
		
		if(isset($_POST['color'])) {
		$color = $_POST['color'];
		}
		
		if(isset($_POST['size'])) {
		$size = $_POST['size'];
		}
		
		if(isset($_POST['occasion'])) {
		$occasion = $_POST['occasion'];
		}
	
	}
	
	if ($designerid != '') {
			$q = "SELECT tradeName, designerimage FROM `designers` WHERE designerid = '$designerid' and status = 'active'";		
			$r = @mysqli_query ($dbc, $q); // Run the query.

			if ($r) { // If it ran OK, display the records.	
			
				//get results for display
					while ($row = mysqli_fetch_array($r)) {
					$tradeName = $row["tradeName"];	
					$designerimage = $row["designerimage"];		
					}
					

					
					mysqli_free_result ($r); // Free up the resources.	
							
					} else { // If it did not run OK.

					// Public message:
					echo '<div style="width:35%; min-width:300px; margin-left:auto;margin-right:auto;"><p class="error">The designer name could not be retrieved. We apologize for any inconvenience.</p></div>';
							
					} // End of if ($r) IF.
	}
	
	/*
	echo '<br>$designerid =' . $designerid  . '<br>';
	echo '<br>$productcategory =' . $productcategory  . '<br>';
	echo '<br>$producttarget =' . $producttarget  . '<br>';
	*/
	
	
	// Count the number of records:		
		
		
			$q = "select count(designers.designerid) from designers
				inner join products
				on designers.designerid = products.designerid";				
			
				// Append only the joins that are needed			
				
				if ($size != '') { 
				$q = $q . " inner join productsize
							on products.productid = productsize.productid";
				}
				if ($color != '') { 
				$q = $q . " inner join productcolor
							on products.productid = productcolor.productid";
				}
				if ($occasion != '') { 
				$q = $q . " inner join occasions
							on products.productid = occasions.productid";
				}	
				
				// Append where clauses according to what is passed into this page				
				
				if (($productcategory == '') && ($designerid == '')) {
				$q = $q . " WHERE products.producttarget='$producttarget'
							AND designers.status='active' AND products.status='active'";
				
				} else if (($productcategory != '') && ($designerid == '')) {
				$q = $q . " WHERE products.producttarget='$producttarget'
							AND products.productcategory='$productcategory'
							AND designers.status='active' AND products.status='active'";
				
				} else if (($productcategory == '') && ($producttarget != '') && ($designerid != '')) {
				$q = $q . " WHERE products.producttarget='$producttarget'
							AND designers.designerid='$designerid'
							AND designers.status='active' AND products.status='active'";
							
				} else if (($productcategory == '') && ($producttarget == '') && ($designerid != '')) {
				$q = $q . " WHERE designers.designerid='$designerid'
							AND designers.status='active' AND products.status='active'";

				} else if (($productcategory != '') && ($producttarget != '') && ($designerid != '')) {
				$q = $q . " WHERE products.producttarget='$producttarget'
						   AND products.productcategory='$productcategory' 
						   AND designers.designerid='$designerid'
						   AND designers.status='active' AND products.status='active'";
				}
		
				// Append only the additional filters that are needed			
				
				if ($designers != '') { 
				$q = $q . " AND designers.tradeName='$designers'";
				}
				if ($productprice != '') { 
				$q = $q . " AND (products.productprice $productprice)";
				}
				if ($size != '') { 
				$q = $q . " AND productsize.size='$size'";
				}
				if ($color != '') { 
				$q = $q . " AND productcolor.color='$color'";
				}
				if ($occasion != '') { 
				$q = $q . " AND occasions.occasion='$occasion'";
				}
		
		
		// echo '<br>' . $q . '<br>';
		
		
		$r = @mysqli_query ($dbc, $q);
		$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
		$records = $row[0];
	
	
	
	// Number of records to show per page:
	$display = 12;
	
	// Determine how many pages there are...
	if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
		$pages = $_GET['p'];
	} else { // Need to determine.
		
		// Calculate the number of pages... ( the count, $records, was determined above )
		if ($records > $display) { // More than 1 page.
			$pages = ceil ($records/$display);
		} else {
			$pages = 1;
		}
		
	} // End of p IF.

	// Determine where in the database to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start = $_GET['s'];
	} else {
		$start = 0;
	}



	?>

  <div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">
		
		<div id="grpquery">  <!-- Side Menu For Bigger Screen Sizes (for small screens, side menu moves to location below the banner images) -->
		
		<?php
		// Load the side menu and banner image according to the top category item clicked - Designer? Women?, Men?, etc....
		if 	(($designerid == '') AND ($producttarget == 'women')) {
				include ('includesnew/sidemenu_bnr_wom.php');
			} else if (($designerid == '') AND ($producttarget == 'men')) { 	
				include ('includesnew/sidemenu_bnr_men.php');
			} else if (($designerid == '') AND ($producttarget == 'kids')) { 	
				include ('includesnew/sidemenu_bnr_kids.php');
			} else if (($designerid == '') AND ($producttype == 'accessories')) { 	
				include ('includesnew/sidemenu_bnr_acc.php');
			} else if ($designerid != '') {
				include ('includesnew/sidemenu_bnr_des.php');
			}
		?>
		
		</div>
		
		
		<div id="grpresultscontainer">
		
		
		  <div id="grpfilter">
		  
		   <!------------------------------------------------------------------------------->
			<div id="grpquery-ss">  <!-- Side Menu For Small Screen Sizes (side menu moves to location below the banner images) -->
		
			<?php
			// Load the side menu and banner image according to the top category item clicked - Designer? Women?, Men?, etc....
			if 	(($designerid == '') AND ($producttarget == 'women')) {
					include ('includesnew/sidemenu_bnr_wom.php');
				} else if (($designerid == '') AND ($producttarget == 'men')) { 	
					include ('includesnew/sidemenu_bnr_men.php');
				} else if (($designerid == '') AND ($producttarget == 'kids')) { 	
					include ('includesnew/sidemenu_bnr_kids.php');
				} else if (($designerid == '') AND ($producttype == 'accessories')) { 	
					include ('includesnew/sidemenu_bnr_acc.php');
				} else if ($designerid != '') {
					include ('includesnew/sidemenu_bnr_des.php');
				}
			?>
			
			</div>
		  <!------------------------------------------------------------------------------->
		  
		  
		  
			<!-- Temporary Facebook "like" buttons. (JavaScript code is located in topcontainer_shopping.php) -->			
			<div
			  class="fb-like"
			  data-share="true"
			  data-width="450"
			  data-show-faces="true"
			  style="margin-bottom:15px;">
			</div>
		  
		  
			<!-- the "Narrow By" filters -->
		  
			<form action="categresults.php" method="post">
		
				<h2>NARROW BY:</h2> 
				
				<div class="styled-select">
					<span class="arrow"></span>
					<select name="designers">
					<option value="">Designers</option>
						
						
						
									<?php	
							
									// if neither category nor designer was passed into this page, 
									// display all items for the producttarget.
										// ELSE
									// if a specific productcategory was passed into this page, 
									// display the category items for the producttarget.
										// ELSE
									// if a specific designer was passed into this page, display all items for that designer
									
									if (($productcategory == '') && ($designerid == '')) {
										$q = "select designers.designerid, tradeName, count(designers.designerid) as count from designers
											inner join products
											on designers.designerid = products.designerid
											WHERE products.producttarget='$producttarget'
											AND designers.status='active' AND products.status='active'
											GROUP BY designers.designerid";		
										} else if (($productcategory != '') && ($designerid == '')) {	
										$q = "select designers.designerid, tradeName, count(designers.designerid) as count from designers
											inner join products
											on designers.designerid = products.designerid
											WHERE products.producttarget='$producttarget'
											AND products.productcategory='$productcategory'
											AND designers.status='active' AND products.status='active'
											GROUP BY designers.designerid";			
										} else if (($productcategory == '') && ($producttarget != '') && ($designerid != '')) {	
										$q = "select designers.designerid, tradeName, count(designers.designerid) as count from designers
											inner join products
											on designers.designerid = products.designerid
											WHERE products.producttarget='$producttarget'
											AND designers.designerid='$designerid'
											AND designers.status='active' AND products.status='active'
											GROUP BY designers.designerid";
										} else if (($productcategory == '') && ($producttarget == '') && ($designerid != '')) {	
										$q = "select designers.designerid, tradeName, count(designers.designerid) as count from designers
											inner join products
											on designers.designerid = products.designerid
											WHERE designers.designerid='$designerid'
											AND designers.status='active' AND products.status='active'
											GROUP BY designers.designerid";
										} else if (($productcategory != '') && ($producttarget != '') && ($designerid != '')) {	
										$q = "select designers.designerid, tradeName, count(designers.designerid) as count from designers
											inner join products
											on designers.designerid = products.designerid
											WHERE products.producttarget='$producttarget'
										    AND products.productcategory='$productcategory' 
										    AND designers.designerid='$designerid'
											AND designers.status='active' AND products.status='active'
											GROUP BY designers.designerid";
										}
									
									
									
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									echo '<option value="' . $row['tradeName'] . '">' . $row['tradeName'] . ' (' . $row['count'] . ')</option>';
									}
								
									$num = mysqli_num_rows($r);
							
									if ($num == 0) {
										echo '<div style="width:35%; min-width:300px; margin-left:auto;margin-right:auto;"><p id=redtext>No designers were returned from the query.</p></div>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<div style="width:35%; min-width:300px; margin-left:auto;margin-right:auto;"><p id=redtext>No designers could be retrieved. We apologize for any inconvenience.</p></div>';	
									
									} // End of if ($r) IF.

								?>
						
						
					</select>
					<?php // echo '<br>' . $q . '<br>'; ?>
				</div>
				
				<div class="styled-select">
					<span class="arrow"></span>
					<select name="productprice">
						<option value="">Price</option>
						<option value=" < 40">$0 - $40 </option>
						<option value=" between 40 and 80">$41 - $80 </option>
						<option value=" between 80 and 150">$81 - $150 </option>
						<option value=" between 150 and 250">$151 - $250 </option>
						<option value=" > 250">$251 and higher </option>
					</select>
				</div> 
				
				<div class="styled-select">
					<span class="arrow"></span>
					<select name="occasion">
						<option value="">Occasion</option>
						<option value="daytime">Daytime</option>
						<option value="evening">Evening</option>
						<option value="work">Work</option>
						<option value="formal">Formal</option>
						<option value="casual">Casual</option>
						<option value="weddingdress">Wedding Dress</option>
						<option value="weddingguest">Wedding Guest</option>
						<option value="bridesmaid">Bridesmaid</option>
					</select>
				</div>	
				
				<div id="submitfilter">
					<input type="image" border=0 src="imagesnew/buttonsubmitnew.png" height=19 width=117 />
					<br>
					<input type="hidden" name="designerid" value="<?php echo $designerid; ?>">
					<input type="hidden" name="productcategory" value="<?php echo $productcategory; ?>">			
					<input type="hidden" name="producttarget" value="<?php echo $producttarget; ?>">
				</div>
				
				<div id="productcount">
					<?php echo $records; ?> Item(s)
				</div>

			</form>		
			
			<!-- "Narrow By" filters end -->
			
		  </div>
		  
		  
		  <!-- following is to enable responsiveness (number of columns of product changes according to width of screen) 
		  The variable $columncount is used to pass the number of columns to the included results-responsive.php code.
		  
		  Through use of media queries in the stylesheet (styles.css), the corresponding div (e.g. grp2cols) 
		  is shown according to the screen width range, and the rest are hidden --> 
		  
			<div id="grp4cols">		  
			  <?php
				$columncount=4;
				include ('includesnew/results-responsive.php');
			  ?>			
			</div>
			
			<div id="grp3cols">		  
			  <?php
				$columncount=3;
				include ('includesnew/results-responsive.php');
			  ?>			
			</div>
			
			<div id="grp2cols">		  
			  <?php
				$columncount=2;
				include ('includesnew/results-responsive.php');
			  ?>			
			</div>
			
			<div id="grp1col">		  
			  <?php
				$columncount=1;
				include ('includesnew/results-responsive.php');
			  ?>			
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
