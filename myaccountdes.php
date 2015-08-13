<?php
session_start();

// Retrieve designer's id if signed in 	
	if(isset($_SESSION['designerid'])) {
		$designerid = $_SESSION['designerid'];
	} else {
		header("Location: http://www.waxmode.com/responsive2/dessignin.php?");
	}	
		
	if(isset($_SESSION['tradeName'])) {
		$tradeName = $_SESSION['tradeName'];
	}

$title='My Account';

include ('includesnew/topcontainer_shopping.php');


?>
<link rel="stylesheet" type="text/css" media="screen" href="css/css-table.css" />


<div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1100px;">
			
		<div id="itemdetailssection" style="height:1100px;">
		
			<div style="width:952px; margin:0 auto;"> <!-- width:83%; -->

			
					<style type="text/css">
						body { font-family:'mplus-1m-medium-webfont', Open Sans, sans-serif; font-size:0.8em;}
						#report { border-collapse:collapse;}
						#report h4 { margin:0px; padding:0px;}
						#report img { float:right;}
						#report ul { margin:4px 0 0 40px; padding:0px;}
						#report th { background:#B6B2B2 url(imagesnew/img_exptbl/header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
						#report td { background:#EAF2F8 none repeat-x scroll center left; color:#000; padding:5px 15px; }
						#report tr.odd td { background:#fff url(imagesnew/img_exptbl/row_bkg.png) repeat-x scroll center left; cursor:pointer; }
						#report div.arrow { background:transparent url(imagesnew/img_exptbl/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
						#report div.up { background-position:0px 0px;}
					</style>
					
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
					
					
					<script type="text/javascript">  
						$(document).ready(function(){
							$("#report tr:odd").addClass("odd");
							$("#report tr:not(.odd)").hide();
							$("#report tr:first-child").show();
							
							$("#report tr.odd").click(function(){
								$(this).next("tr").toggle();
								$(this).find(".arrow").toggleClass("up");
							});
							//$("#report").jExpand();
						});
					</script>  
				
					<h3 style="margin-bottom:20px;">Year to Date Sales Report for <?php echo $tradeName; ?></h3>
					
					<table id="report">
						<tr>
							<th>Year</th>
							<th>Month</th>
							<th>Quantity</th>
							<th>Order Total</th>
							<th></th>
						</tr>
						
				<?php	

				$q1 = "SELECT YEAR(o.orderdate) AS Year, MONTHNAME(o.orderdate) AS Month, SUM(op.qty) AS Qty, SUM((op.productprice * op.qty)) AS PriceTotal 
				FROM order_products op
				INNER JOIN orders o
				ON op.orderid = o.orderid
				INNER JOIN prodcarttable p
				ON op.pcartid = p.pcartid
				INNER JOIN designers d
				ON op.designerid = d.designerid
				GROUP BY Year, Month";

				$r1 = @mysqli_query ($dbc, $q1);


				
					while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC))
					{
					
					$Month = $row["Month"];  // Used in the inner query
																		
				echo '<tr>
							<td>' . $row["Year"] . '</td>
							<td>' . $row["Month"] . '</td>
							<td>' . $row["Qty"] . '</td>
							<td>' . $row["PriceTotal"] . '</td>
							<td><div class="arrow"></div></td>
						</tr>';
				?>		
						
						<tr>
							<td colspan="5">
								<h4>Record Details</h4>
								<div>
								<!-- Using absolute positioning here because jquery has made it impossible to space columns here -->
									<div style="width:100%;position:relative;">
										<div style="width:10.66%;display:inline;">Year</div>
										<div style="width:16.66%;display:inline;position:absolute;left:52px;">Month</div>
										<div style="width:40.66%;display:inline;position:absolute;left:124px;">Product</div>
										<div style="width:10.66%;display:inline;position:absolute;left:444px;">Product ID</div>
										<div style="width:10.66%;display:inline;position:absolute;left:572px;">Qty</div>
										<div style="width:10.66%;display:inline;position:absolute;left:626px;">Order Total</div>
									</div>
									
									<?php	

									$q2 = "SELECT YEAR(o.orderdate) AS Year, MONTHNAME(o.orderdate) AS Month, 
									IFNULL(p.productname,'Total') as productname, IFNULL(op.pcartid,'Total') as pcartid, 
									SUM(op.qty) AS Qty, SUM((op.productprice * op.qty)) AS PriceTotal 
									FROM order_products op
									INNER JOIN orders o
									ON op.orderid = o.orderid
									INNER JOIN prodcarttable p
									ON op.pcartid = p.pcartid
									INNER JOIN designers d
									ON op.designerid = d.designerid
									WHERE d.designerid = '$designerid'
									AND MONTHNAME(o.orderdate) = '$Month'
									GROUP BY p.productname, op.pcartid";
													
									// echo '<br>' . $q2 . '<br>';
													
									$r2 = @mysqli_query ($dbc, $q2);

									
									while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC))
										{
																		
										echo '<div style="width:100%;">													
												<div style="width:10.66%;display:inline;">' . $row["Year"] . '</div>
												<div style="width:16.66%;display:inline;position:absolute;left:168px;">' . $row["Month"] . '</div>
												<div style="width:40.66%;display:inline;position:absolute;left:240px;">' . $row["productname"] . '</div>
												<div style="width:10.66%;display:inline;position:absolute;left:560px;">' . $row["pcartid"] . '</div>
												<div style="width:10.66%;display:inline;position:absolute;left:688px;">' . $row["Qty"] . '</div>
												<div style="width:10.66%;display:inline;position:absolute;left:742px;">' . $row["PriceTotal"] . '</div>
											</div>';
														
										}
										
										$num = mysqli_num_rows($r2);
												
										if ($num == 0) {
											echo '<p id=redtext>No order records were found.</p>';
										}
													
													
										mysqli_free_result ($r2); // Free up the resources.
										?>
									
								 </div>   
							</td>
						</tr>
					<?php	
														
					}
										
					$num = mysqli_num_rows($r1);
												
					if ($num == 0) {
						//
					}													
													
					mysqli_free_result ($r1); // Free up the resources.
					?>
						
					</table>
			
			
			
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