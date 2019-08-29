<?php 
 	session_start();   
 	$reservation_room_number        = (!empty($_POST['reservation_room_number'])) ? $_POST['reservation_room_number'] : "" ;  
	$reservation_room_checkindate   =  (!empty($_POST['reservation_room_checkindate'])) ? $_POST['reservation_room_checkindate'] : "" ; 
	$reservation_room_checkoutdate  =   (!empty($_POST['reservation_room_checkoutdate'])) ? $_POST['reservation_room_checkoutdate'] : "" ; 
	$estenated_time_arrival         =   (!empty($_POST['estenated_time_arrival'])) ? $_POST['estenated_time_arrival'] : "" ; 



?>


<!DOCTYPE html>
  
	<head> 
		 <?php require ("hr_folders/hr_universal/universal1.php");  ?> 



		<link rel="stylesheet" type="text/css" href="hr_folders/hr_guestinfo/hr_guestinfo_style_file/hr_guestinfo.css"> 
		<script type="text/javascript" src="hr_folders/hr_guestinfo/hr_guestinfo_js_file/hr_guestinfo_ajax.js" ></script>
		<script type="text/javascript" src="hr_folders/hr_guestinfo/hr_guestinfo_js_file/hr_guestinfo_jquery.js" ></script> 
	</head> 
	<body>
		<?php require ("hr_folders/hr_menu/menu_php_file/menu.php") ?>
		<div id="hr_wrapper"> 
			<table id="hr_wrapper_table" border="0" cellpadding="0" cellspacing="0"> 
				<tr>  		
					<td id="hr_body_header" > 
						<?php   require ("hr_folders/hr_header/header_php_file/header1.php"); ?> 
					</td>
				<tr>
					<!-- <td id="hr_body_banner" > -->
						<?php// require ("hr_folders/hr_banner/banner1.php");  ?> 
					<!-- </td> -->
				<tr>
					<td id="hr_body_content" > 
 						<?php require( "hr_folders/hr_guestinfo/hr_guestinfo_php_file/hr_guestinfo_body.php" ); ?> 	
					</td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
			</table>
		</div> 
	</body> 
</html>

