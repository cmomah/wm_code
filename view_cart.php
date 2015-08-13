<?php
$title='View Cart';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
?>

<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

			
			<?php
			
			$carttitle = 'My Cart';
			$shipfee = '';
			$showeditcartlink = 'false';
			$showreduceandremove = 'true';
			$showcheckoutbutton = 'true';
			
			include ('cartnew.php');
			?>
			
			<br><br>
			
			
    
		</div>
    
	</div>
    
  </div>  
	

<?php
include ('includesnew/footertall.php');
?>
  
	
</div>

</body>

</html>
