<?php
session_start();

// Retrieve designer's id if signed in 	
	if(isset($_SESSION['designerid'])) {
		$designerid = $_SESSION['designerid'];
	} else {
		
	}	
		
	if(isset($_SESSION['tradeName'])) {
		$tradeName = $_SESSION['tradeName'];
	}

$title='My Account';

include ('includesnew/topcontainer_shopping.php');

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
GROUP BY p.productname, op.pcartid
WITH ROLLUP";
				
//echo '<br>' . $q2 . '<br>';
				
$r2 = @mysqli_query ($dbc, $q2); 




?>
<link rel="stylesheet" type="text/css" media="screen" href="css/css-table.css" />


<div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1100px;">
			
		<div id="itemdetailssection" style="height:1100px;">
		
			<div style="width:90.14%; margin:0 auto;">

			
					<style type="text/css">
						body { font-family:'mplus-1m-medium-webfont', Open Sans, sans-serif; font-size:0.8em;}
						#report { border-collapse:collapse;}
						#report h4 { margin:0px; padding:0px;}
						#report img { float:right;}
						#report ul { margin:10px 0 10px 40px; padding:0px;}
						#report th { background:#7CB8E2 url(imagesnew/img_exptbl/header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
						#report td { background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
						#report tr.odd td { background:#fff url(imagesnew/img_exptbl/row_bkg.png) repeat-x scroll center left; cursor:pointer; }
						#report div.arrow { background:transparent url(imagesnew/img_exptbl/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
						#report div.up { background-position:0px 0px;}
					</style>
				<!--	
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
				-->
				
					<h3>Year to Date Sales Report for <?php echo $tradeName; ?></h3>
					
					<table id="report">
						<tr>
							<th>Year</th>
							<th>Month</th>
							<th>Quantity</th>
							<th>Price Total</th>
							<th></th>
						</tr>
						
				<?php		
					while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC))
					{
																		
				echo '<tr>
							<td>' . $row["Year"] . '</td>
							<td>' . $row["Month"] . '</td>
							<td>' . $row["Qty"] . '</td>
							<td>' . $row["PriceTotal"] . '</td>
							<td><img src="imagesnew/img_exptbl/arrows2.png" border="0" width=15px height=23px></div></td>
						</tr>';
				?>		
						
						<tr>
							<td colspan="5">
								<h4>Record Details</h4>
								<div>
								
									<div style="width:100%;">
										<div style="width:16.66%;display:inline;">Year</div>
										<div style="width:16.66%;display:inline;">Month</div>
										<div style="width:16.66%;display:inline;">Product</div>
										<div style="width:16.66%;display:inline;">Product ID</div>
										<div style="width:16.66%;display:inline;">Qty</div>
										<div style="width:16.66%;display:inline;">Order Total</div>
									</div>
									
									<?php		
									while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC))
										{
																		
										echo '<div style="width:100%;">													
												<div style="width:16.66%;display:inline;">' . $row["Year"] . '</div>
												<div style="width:16.66%;display:inline;">' . $row["Month"] . '</div>
												<div style="width:16.66%;display:inline;">' . $row["productname"] . '</div>
												<div style="width:16.66%;display:inline;">' . $row["pcartid"] . '</div>
												<div style="width:16.66%;display:inline;">' . $row["Qty"] . '</div>
												<div style="width:16.66%;display:inline;">' . $row["PriceTotal"] . '</div>
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
						
						
						<tr>
							<td>United Kingdom </td>
							<td>61,612,300</td>
							<td>244,820 km2</td>
							<td>English</td>
							<td><div class="arrow"></div></td>
						</tr>
						<tr>
							<td colspan="5">
								<h4>Additional information</h4>
								<ul>
									<li><a href="http://en.wikipedia.org/wiki/United_kingdom">UK on Wikipedia</a></li>
									<li><a href="http://www.visitbritain.com/">Official tourist guide to Britain</a></li>
									<li><a href="http://www.statistics.gov.uk/StatBase/Product.asp?vlnk=5703">Official 
										Yearbook of the United Kingdom</a></li>
								</ul>
								
							</td>
						</tr>
						<tr>
							<td>India</td>
							<td>1,147,995,904</td>
							<td>3,287,240‡ km2</td>
							<td>Hindi, English</td>
							<td><div class="arrow"></div></td>
						</tr>
						<tr>
							<td colspan="5">
								<h4>Additional information</h4>
								<ul>
									<li><a href="http://en.wikipedia.org/wiki/India">India on Wikipedia</a></li>
									<li><a href="http://india.gov.in/">Government of India</a></li>
									<li><a href="http://wikitravel.org/en/India">India travel guide</a></li>
								 </ul>   
							
							</td>
						</tr>
						<tr>
							<td>Canada</td>
							<td>33,718,000</td>
							<td>9,984,670 km2</td>
							<td>English, French</td>
							<td><div class="arrow"></div></td>
						</tr>
						<tr>
							<td colspan="5">
								<h4>Additional information</h4>
								<ul>
									<li><a href="http://en.wikipedia.org/wiki/Canada">Canada on Wikipedia</a></li>
									<li><a href="http://atlas.gc.ca/site/index.html" >Official 
										Government of Canada online Atlas of Canada</a></li>
									<li><a href="http://wikitravel.org/en/Canada">Canada travel guide</a></li>
								 </ul>   
							</td>
						</tr>
						<tr>
							<td>Germany</td>
							<td>82,060,000</td>
							<td>357,021 km2</td>
							<td>German</td>
							<td><div class="arrow"></div></td>
						</tr>
						<tr>
							<td colspan="5">
								<h4>Additional information</h4>
								<ul>
									<li><a href="http://en.wikipedia.org/wiki/Germany">Germany on Wikipedia</a></li>
									<li><a href="http://www.deutschland.de/home.php?lang=2">Deutschland.de Official Germany portal</a></li>
									<li><a href="http://www.cometogermany.com/">Germany Travel Info</a></li>
								 </ul>   
							</td>
						</tr>
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