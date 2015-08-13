<?php

$dbc = mysqli_connect("localhost","wwwwaxmo_wmfdb","WMfashiondb2!","wwwwaxmo_wmfdb");

									// Check connection
									if (mysqli_connect_error())
									  {
									  echo "Failed to connect to MySQL: " . mysqli_connect_error();
									  }