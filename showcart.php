<?php
/* We need a way to list all of the items in our shopping cart, as well as a total cost for all of those items. 
ShowCart handles all of this. It also provides a drop down list for each item, so that its quantity can be easily updated.

ShowCart is included in the cartnew.php page and is used to display the cart whenever user clicks on a "view cart" link or icon (view_cart.php)

ShowCart is also used for displaying the "Order Summary" section that is shown on all the checkout pages up until the order is paid for

ShowCart starts off by using an SQL INNER JOIN query to get a list of products from the cart table, and also each products details 
from the products table: */
?>
<script language="JavaScript"> 

function UpdateQty(item) 
{ pcartid = item.name; 
newQty = item.options[item.selectedIndex].text; 

document.location.href = 'view_cart.php?action=update_item&pcartid='+pcartid+'&qty='+newQty; 
}
</script>
<?php

// This contains the connection routine for the ID of the cart, etc 







// Get a connection to the database  
$cxn = @ConnectToDb($dbServer, $dbUser, $dbPass, $dbName);			

// The ShowCart code ( was a function before )

	$q = "select cart.*, prodcarttable.pcartid, designers.tradeName, prodcarttable.productname, prodcarttable.productprice, productsize.size, productcolor.color, productimages.productimgthumbnail 
		from cart
		inner join prodcarttable
		on cart.pcartid = prodcarttable.pcartid
		inner join designers
		on prodcarttable.designerid = designers.designerid
		inner join productsize
		on prodcarttable.sizeid = productsize.sizeid
		inner join productcolor
		on prodcarttable.productcolorid = productcolor.productcolorid
		inner join productimages
		on prodcarttable.productid = productimages.productid
		WHERE cart.cookieId = '" . GetCartId() . "' 
		and productimages.cartimage = 'yes'
		order by prodcarttable.productname asc";

		$result = mysql_query($q);
		
		// echo '<br>' . $q . '<br>';

		//Once the list of products is retrieved, each item is displayed as part of a table, as a table row:
		?>
		
		
		
		<h1 style="margin-bottom:20px;"><?php echo $carttitle ?></h1>
		<table class="cart" width="100%" cellspacing="0" cellpadding="6">
		  <tr>
			<td width="40%" bgcolor="#F9F9F9"><strong>Product</strong></td>
			<td width="28%" bgcolor="#F9F9F9"><strong>Designer</strong></td>
			<td width="17%" bgcolor="#F9F9F9"><strong>Unit Price</strong></td>
			<td width="15%" bgcolor="#F9F9F9"><strong>Quantity</strong></td>
		  </tr>
		
		<?php
		$totalCost=0;  // initialize total cost
		while($row = mysql_fetch_array($result))
		{ 
		// Increment the total cost of all products 
		$totalCost += ($row["qty"] * $row["productprice"]); 
		?> 
		<tr>
		<td>
		
		<div style="float:left;margin-right:10px;"><img src=<?php echo $row["productimgthumbnail"]; ?> alt=<?php echo $row["productname"]; ?> width="50" height="auto" border="0" /></div>
		<div style="float:left;margin-right:10px;"><a href="itemdetails.php?pcartid=<?php echo $row["pcartid"]; ?>"><?php echo $row["productname"]; ?></a><br><?php echo $row["size"]; ?> - <?php echo $row["color"]; ?></div>
		
		</td>  
		<td> 
		<?php echo $row["tradeName"]; ?> 
		</td>
		<td>  
		$<?php echo number_format($row["productprice"], 2, ".", ","); ?>  
		</td>  
		<td> 
		
			<div style="display:inline; float:left;">
			
			<?php 
			if ($showreduceandremove == 'true') {
			?>
				<select name="<?php echo $row["pcartid"]; ?>" onChange="UpdateQty(this)">  

				<?php
					for($i = 1; $i <= 20; $i++) 
					{ 
					echo "<option "; 
					if($row["qty"] == $i) 
					{ 
					echo " SELECTED "; 
					} 
					echo ">" . $i . "</option>"; 
					} 
				?> 
				
				</select> 
			<?php	
			} else {
				echo $row["qty"];
			}
			?>
			
			</div>
			
			<?php 
			if ($showreduceandremove == 'true') {
			?>
			<div style="display:inline; float:right;">
				<a class="colorlink" href="view_cart.php?action=remove_item&pcartid=<?php echo $row["pcartid"]; ?>">Remove</a>
			</div>
			<?php 
			}
			?>
		 
		</td> 
		</tr> 
		<?php
		}  // end of the while loop

		//The running tally of each item in the users shopping cart is kept as the $totalCost variable:

		// Increment the total cost of all items

		$totalCost += ($row["qty"] * $row["productprice"]);

		//The quantity of each item is multiplied by its price, and is then added to the $totalCost 
		//variable using the += operator, which is the same as:

		//$totalCost = $totalCost + ($row["qty"] * $row["productprice"]);

		?>

		<!-- Lastly, ShowCart displays the total cost of all items in the users cart: -->

		<tr> 
		</tr>
		<tr> 
		<td width="70%" colspan="2">  
		
		<?php
		// Check if shopper's cart is empty, using the total cost
		
		if($totalCost == 0)
		{
		echo '<br><span id="redtext" style="margin:0 0 15px 0;">Your cart is empty</span>
		<br /><br />';
		}
		?>
		
		<a class="colorlink" href="categresults.php?producttarget=women">&lt;&lt; Continue Shopping</a>  
		</td> 
		<td width="30%" colspan="2"> 
		
		<?php
		if ($shipfee == '') { ?>
			Total: $<?php echo number_format($totalCost, 2, ".", ",");
		} else if ($shipfee != '') { 
			$totalCost=$totalCost+$shipfee; ?>
			Total (incl. <span style="color:red;">$<?php echo $shipfee ?></span> shipping): $<?php echo number_format($totalCost, 2, ".", ",");
		}
		?>
		
		</td>
		</tr> 
		</table>
		
		<?php
		if ($showcheckoutbutton == 'true') {  // The cart display is being shown also in the checkout pages, so we hide checkout button for that page
			if($totalCost > 0)
			{
			echo '<br />
			<table width="100%" cellspacing="0" cellpadding="6" border="1">
				<tr>
				<td width="70%"><a href="view_cart.php?action=empty">Click Here to Empty Your Shopping Cart.</a></td>
				<td width="30%" align="right">'; 				
				
				if (isset($_SESSION['shopperid'])) {   //Advance shopper directly to shipping page if signed on
					echo '<a href="shipping.php?fromcart=true">';
				} else {	
					echo '<a href="checkout.php?fromcart=true">';
				}		
				
				echo '<img src="imagesnew/checkout.png" width="161" height="39" border="0"></a></td>				
				</tr>
			</table>';
			}
		}
		?>
		
		<?php
		if ($showeditcartlink == 'true') {
		echo '<br />
		<table width="100%" cellspacing="0" cellpadding="6" border="1">
			<tr>
			<td width="99%" align="right"><a class="colorlink-ul" href="view_cart.php?fromcart=true">Edit in Shopping Cart</a>
					
			</td>
			<td width="1%"> </td>
			</tr>
		</table>';
		}
