<?php
  	session_start();
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");
	$mc = new myclass();
	// $mc->connect( "smc_hotel_online_reservation" , "root" ); 
	
	// print_r($room);
	// echo "total room ".count($room)."<br>"; 
	/* 
		1.) references : http://www.thelalit.com/the-lalit-new-delhi/rooms-overview
		2.) 
	*/   
?> 
<!DOCTYPE html>
	<head>  
		<?php require ("hr_folders/hr_universal/universal1.php");  ?>
		<link rel="stylesheet" type="text/css" href="hr_folders/index/index_css/style.css">
		<script type="text/javascript" src="hr_folders/index/index_js/index_ajax.js" ></script>
		<script type="text/javascript" src="hr_folders/index/index_js/index_jquery.js" ></script>  
		<?php  
			// if (isset($_GET["submit"])) {
			// 	$from = $_GET["from"];   
			// 	$to   = $_GET["to"];
			// 	$room = $_GET["room"];  
			// } else {  
			require( "hr_folders/hr_popUp/hr_folder_php_file/search_room_popUp.php" );		
		// }  
			require( "hr_folders/hr_popUp/hr_folder_php_file/footer_option.php" );
		?>   
	</head> 
	<body onload="home_initialize()" >
		<?php require ("hr_folders/hr_menu/menu_php_file/menu.php") ?>

		<div id="hr_wrapper"> 
			<table id="hr_wrapper_table" border="0" cellpadding="0" cellspacing="0"> 
				<tr>  		
					<td id="hr_body_header" >  
						<?php  require ("hr_folders/hr_header/header_php_file/header1.php"); ?> 
					</td>
				<tr>
					<!-- <td id="hr_body_banner" > -->
						<?php //require ("hr_folders/hr_banner/banner1.php");  ?> 
					<!-- </td> -->
				<tr>
					<td id="hr_body_content" >  
 						<?php  require ("hr_folders/index/index_php_file/index_body.php"); ?>
					</td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
			</table>
		</div> 
	</body> 
</html>