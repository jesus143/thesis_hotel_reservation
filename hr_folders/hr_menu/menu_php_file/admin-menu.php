<!-- 
	created: Dec 01 , 2013 / Sunday 10:28 pm
	requirements: js plugin
	author : Jesus Erwin Suarez
 -->
 

 <!-- key codes:  http://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes  -->
 <link rel="stylesheet" type="text/css" href="hr_folders/hr_menu/menu_style_file/menu_style1.css">
 <script type="text/javascript" src="hr_folders/hr_menu/menu_js_file/menu_ajax.js" ></script>
 <script type="text/javascript" src="hr_folders/hr_menu/menu_js_file/menu_jquery.js" ></script> 

 <div id="menu_container">
 	<div id="menu_content">   
 		<table id="menu_table1" > 
		 	<tr>  
		 		<?php if ($ra->personel_login) { ?>
			 		<td> <a title="add room"            href="?a=adminviewrooms#hr_body_content"> view rooms    </a> </td>
			 		<td> <a title="add room"            href="?a=adminuploadroom#hr_body_content"> add room      </a> </td>
			 		<td> <a title="add amenities"  href="?a=adminuploadamenities#hr_body_content"> add amenities </a> </td>
			 		<td> <a title="reservation"                      href="admin#hr_body_content"> reservations  </a> </td>
			 		<td> <a title="logout"                                    href="admin-logout"> logout        </a> </td>
		 		<?php }else{  ?>
		 			<td> <a title=" forgot password"            href="#"> forgot password </a> </td>
		 			<td> <a title="change password  "           href="#"> change password </a> </td>
		 			<td> <a title="create new personel account" href="#"> create new personel account  </a> </td>
					<td> <a title="create new personel account" href=" admin#header-logo-nav"> login </a> </td>

		 		<?php } ?>
	 	</table>  
	 	<form method="get" action="index.php">
	 		<input  id="menu-search" type="text" placeholder="search" onkeyup ="search_typed();" name="search" autocomplete="off" >
	 	</form>
	 	<div  id="menu-search-result-dropdown" >    
	 	</div>  
	 	<div id="menu-search-container-loading" >  
	 		<center>
	 			<img id='menu-search-container-loading-img' src="hr_folders/hr_images/loading 2.gif"  >
	 		</center>
 		</div>
 	</div>  
 </div> 