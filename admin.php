 <?php 	 session_start(); ?>

<?php  
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php"); 
 // 	$fullname     	= (!empty($_POST['fullname'])) ? $_POST['fullname'] : "" ;  
	// $email 			= (!empty($_POST['email'])) ? $_POST['email'] : "" ; 
	// $address 		= (!empty($_POST['address'])) ? $_POST['address'] : "" ; 
	// $contactnumber	= (!empty($_POST['contactnumber'])) ? $_POST['contactnumber'] : "" ; 
	// $companygroup	= (!empty($_POST['companygroup'])) ? $_POST['companygroup'] : "" ;  



	/**
	*  date created: jan 5 , 2014 time: 1:20 am
	*  by: jesus erwin suarez  
	*/ 

	class reservationadmin extends reservationadmincodes {
		public function __construct( ) {
			$this->load_page_content( );
		} 
		public function load_page_content( ) {

			if ( isset( $_POST['personel_login'] )) {  
				$personel_username = $_POST['personel_username'];
				$personel_password = $_POST['personel_password']; 
				if ($personel_username == '@admin' && $personel_password == '@pass' ) { 
					$_SESSION['personel_login'] = true;  
				} 
			}	 
			$personel_login = ( !empty($_SESSION['personel_login']) ) ?  $_SESSION['personel_login'] : false ;  
			$action  		= ( !empty($_GET['a']) ) ? $_GET['a'] : false ; 
			if ( $personel_login ) {
				if ( $action == 'adminuploadroom' ) {
					$page = "adminuploadroom";
				}else if ( $action == 'adminupdateroom' ) {
					$page = "adminupdateroom";
				}else if ( $action == 'adminuploadamenities' ) {  
					$page = "adminuploadamenities";
				}else if ( $action == 'adminupdateamenities' ) { 
					$page = "adminupdateamenities";
				}else if ( $action == 'adminupdatereservation' ){ 
					$page = "adminupdatereservation";
				}else if ( $action == 'adminviewrooms')  {
				 	$page = "adminviewrooms";
				}else{ 
					$page = "admindashboard";
				}
			}else{ 
				$page = "adminlogin";
			}    
			$this->page = $page; 
			$this->personel_login = $personel_login;
		} 
	}
	class reservationadmincodes {
	} 
	$ra = new reservationadmin ( );  
?>


<!DOCTYPE html>
 
	<head> 
		<?php require ("hr_folders/hr_universal/universal1.php");  ?>  
		<link rel="stylesheet" type="text/css" href="hr_folders/hr_admin/hr_admin_style_file/hr_admin_style.css"> 

		<script type="text/javascript" src="hr_folders/hr_admin/hr_admin_js_file/hr_admin_ajax.js" ></script>
		<script type="text/javascript" src="hr_folders/hr_admin/hr_admin_js_file/hr_admin_jquery.js" ></script>
	</head> 
	<body>
		
		<?php  require ("hr_folders/hr_menu/menu_php_file/admin-menu.php"); ?>
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
 						<?php  
							// echo "page = $ra->page ";
							require( "hr_folders/hr_admin/hr_admin_php_file/$ra->page.php" );   
 							?> 	
					</td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
			</table>
		</div> 
	</body> 
</html>

