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
		 		<td> <a title="HOME" href="home"> HOME </a> </td>
		 		<td> <a title="SHARE" href=""> SHARE</a> </td>
		 		<td> <a title="ABOUT US" href=""> ABOUT US  </a> </td>
		 		<td> <a title="CONTACT US" href=""> CONTACT US</a> </td>
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