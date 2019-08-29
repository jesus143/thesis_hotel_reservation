<?php  
	session_start();
	require_once ("../../hr_php_function/connect.php");
	require("../../hr_php_function/function.php");
	require("../../hr_php_function/myclass.php");
	$mc = new myclass(); 
	 $keyTyped = $_GET["menu_search"]; 
	// $mc->connect( "smc_hotel_online_reservation" , "root" );  
	$room = selectV1(
		'*',
		"room",
		null,
		null,
		null,
		array(
			"rowName"=>"Room_type",
			"keySearch"=>$keyTyped
		)
	);   
	$troom = count($room);  


	echo "<ul>";  

		// if ( empty($keyTyped) ) { 
		// }else{  
			// print_r($room);
			$c=0; 
			// echo " key typed : $keyTyped <br> ";
			for ($i=0; $i < $troom ; $i++) { 


				$c++;
				// $msr = $menu_search_result[$i];
				$msr = $room[$i]["Room_type"]; 
				 echo "<li  id='menu-search-result-id-$c' title='$msr' onmouseover='search_result_mouseover(\"$c\")' onclick='search_send(\"$msr\")'  ><a  href='#''>$msr</a></li> ";
			}
		// }   
	echo "</ul>";  
	echo "<span id='total_room' style='display:none'>".count($room)."</span>";
?>

  