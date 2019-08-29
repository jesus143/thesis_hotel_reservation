<?php 
	date_default_timezone_set('America/Los_Angeles');  
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
 		$dbName = "smc_hotel_online_reservation";
 		$con = mysql_connect("localhost","root","") or die(mysql_error()); //laptop 
 		if ( $con  )  {
 		 	// echo " connected to localhost <br>"; 
 		}
 		else 
 		{ 
 			// echo " not connected to localhost <br>";
 		}
 	}
 	else {  
 		// echo "online connect";
 		$user = "ricopeco_jesus7";
 		$pass = "Q?l-tpVNV)v+";
		$dbName = "ricopeco_smc_hotel_reservation"; 
 	   mysql_connect("localhost" , $user , $pass ) or die(mysql_error());  
 	}   

	$dbConn = mysql_select_db($dbName) or die("No Connection.. "); //fs 
 	if ( $dbConn ) 
 	{ 
 		// echo "connected to $dbName <br> ";
 	}
 	else  
 	{
 		// echo "not connected to $dbName <br> ";
 	} 

?>