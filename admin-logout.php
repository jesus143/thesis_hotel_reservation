<?php 
	session_start();
	session_destroy();
	header("Location: admin#header-logo-nav"); 
	echo "this is admin logout.";
?>