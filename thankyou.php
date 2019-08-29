 <?php 	//session_start(); ?>

<?php  
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php"); 
 	$fullname     	= (!empty($_POST['fullname'])) ? $_POST['fullname'] : "" ;  
	$email 			= (!empty($_POST['email'])) ? $_POST['email'] : "" ; 
	$address 		= (!empty($_POST['address'])) ? $_POST['address'] : "" ; 
	$contactnumber	= (!empty($_POST['contactnumber'])) ? $_POST['contactnumber'] : "" ; 
	$companygroup	= (!empty($_POST['companygroup'])) ? $_POST['companygroup'] : "" ;  
?>


<!DOCTYPE html>
 
	<head> 
		<?php require ("hr_folders/hr_universal/universal1.php");  ?>  
		<link rel="stylesheet" type="text/css" href="hr_folders/hr_thankyou/thankyou_style_file/thankyou_style.css"> 
		<script type="text/javascript" src="hr_folders/hr_thankyou/thankyou_js_file/thankyou_ajax.js" ></script>
		<script type="text/javascript" src="hr_folders/hr_thankyou/thankyou_js_file/thankyou_jquery.js" ></script>  
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
						<?php //require ("hr_folders/hr_banner/banner1.php");  ?> 
					<!-- </td> -->
				<tr>
					<td id="hr_body_content" > 
 						<?php  require( "hr_folders/hr_thankyou/thankyou_php_file/thankyou_body.php" ); ?> 	
					</td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
			</table>
		</div> 
	</body> 
</html>

