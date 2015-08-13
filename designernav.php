<?php
session_start();
ini_set('display_errors', 'On');

require ('includesnew/mysqli_connect.php'); // Connect to the db.

$title='Designer Listing';
?>



<!DOCTYPE HTML>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" x-undefined="" />

<title><?echo $title; ?></title>

<meta name="viewport" content="width=device-width">

<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/menustyles.css" rel="stylesheet" type="text/css" >
<link href="css/jquery-ui.css" rel="stylesheet">
<script src="jsnew/jquery.js"></script>
<script src="jsnew/jquery-ui.js"></script>

<link href="css/jqueryvalidval.css" rel="stylesheet"> 

</head>

<body>

<div id="wrapper">


<?php
// Retrieve current page
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

$curPageName = curPageName();

//echo $curPageName;







include ('includesnew/topmenu.php');
?>














<!--------------------------------------------------------->
  <div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

			
						<div class="navcoldiv">
						
						<?php
						// Check if an alphabet letter was clicked
								if(isset($_GET['alph'])) {
									$alph = $_GET["alph"];
									echo '<div id="navheader"><h1>"' . $alph . '" Designers</h1> </div>';
								} else {
									echo '<div id="navheader"><h1>"All" Designers</h1> </div>';
								}
						
							
								
								

								
								// if an alphabet was clicked, replace the initial disigners list with only those 
								// whose names begin with the clicked alphabet
								
								if ($alph == '') { 						
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName REGEXP '^[abcdefghijklmnopqrstuvwxyz]' and status = 'active' ORDER BY tradeName LIMIT 50";		
								} else {	
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName LIKE '$alph%' and status = 'active' ORDER BY tradeName LIMIT 50";		
								}	
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									// echo '<a href="designersd.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									echo '<a href="categresults.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No designers could be retrieved. We apologize for any inconvenience.</p>';	
									
								} // End of if ($r) IF.
							?>
						
						
						</div>
						
						<div class="navcoldiv" style="display: none;"> <!-- Hide until we have more designers to fill two columns -->
						
						 <div id="navheader"><h1>&nbsp;</h1></div>
							
							
							<?php	
							
								// if an alphabet was clicked, hide this column
								if ($alph == '') {
						
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName REGEXP '^[mnopqrstuvwxyz]' and status = 'active' ORDER BY tradeName LIMIT 50";				
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									//echo '<a href="designerdetails.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									echo '<a href="categresults.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No designers could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.
								} else {
								
									echo '&nbsp;';
								
								}

							?>
						
						
						</div>
					 
						<div class="navcoldiv">
					 
						
						<div id="navheader"><h1>Alphabetical</h1></div>
						
						
							<table border=0 cellspacing=0 cellpadding=0>
							<tr>				
								<td width=35 class="topleft-aligned">			
								<a href="<?php echo $curPageName ?>" class="colorlink">All</a>	<!-- If user presses "All" pass nothing via the URL so that the entire list will display -->			
								<br><a href="<?php echo $curPageName ?>?alph=A" class="colorlink">A</a>
								<br><a href="<?php echo $curPageName ?>?alph=B" class="colorlink">B</a>
								<br><a href="<?php echo $curPageName ?>?alph=C" class="colorlink">C</a>
								<br><a href="<?php echo $curPageName ?>?alph=D" class="colorlink">D</a>
								<br><a href="<?php echo $curPageName ?>?alph=E" class="colorlink">E</a>
								<br><a href="<?php echo $curPageName ?>?alph=F" class="colorlink">F</a>
								</td>
								
								<td width=35 class="topleft-aligned">	
								<a href="<?php echo $curPageName ?>?alph=G" class="colorlink">G</a>
								<br><a href="<?php echo $curPageName ?>?alph=H" class="colorlink">H</a>
								<br><a href="<?php echo $curPageName ?>?alph=I" class="colorlink">I</a>
								<br><a href="<?php echo $curPageName ?>?alph=J" class="colorlink">J</a>
								<br><a href="<?php echo $curPageName ?>?alph=K" class="colorlink">K</a>
								<br><a href="<?php echo $curPageName ?>?alph=L" class="colorlink">L</a>
								<br><a href="<?php echo $curPageName ?>?alph=M" class="colorlink">M</a>
								</td>
								
								<td width=35 class="topleft-aligned">	
								<a href="<?php echo $curPageName ?>?alph=N" class="colorlink">N</a>	
								<br><a href="<?php echo $curPageName ?>?alph=O" class="colorlink">O</a>
								<br><a href="<?php echo $curPageName ?>?alph=P" class="colorlink">P</a>			
								<br><a href="<?php echo $curPageName ?>?alph=Q" class="colorlink">Q</a>
								<br><a href="<?php echo $curPageName ?>?alph=R" class="colorlink">R</a>
								<br><a href="<?php echo $curPageName ?>?alph=S" class="colorlink">S</a>
								<br><a href="<?php echo $curPageName ?>?alph=T" class="colorlink">T</a>
								</td>
								
								<td width=35 class="topleft-aligned">
								<a href="<?php echo $curPageName ?>?alph=U" class="colorlink">U</a>
								<br><a href="<?php echo $curPageName ?>?alph=V" class="colorlink">V</a>
								<br><a href="<?php echo $curPageName ?>?alph=W" class="colorlink">W</a>
								<br><a href="<?php echo $curPageName ?>?alph=X" class="colorlink">X</a>
								<br><a href="<?php echo $curPageName ?>?alph=Y" class="colorlink">Y</a>
								<br><a href="<?php echo $curPageName ?>?alph=Z" class="colorlink">Z</a>
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
