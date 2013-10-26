<?php
/*
 * Created on 23/01/2012
 *
 * 
 *	Controls the access to the login's page.
 *
 *	Basically, if there is an active session, redirects the user to the
 *	welcome page. 
 * 
 * 
 * 
 */
 header('Content-Type: text/html; charset=UTF-8');
 
 @session_start();
 
 if (isset($_SESSION['sessionControl'])){
 	
 	echo '<script type="text/javascript"> location.href="php/restrictPages/welcome"</script>';
	exit; 
 	
 	
 }
 
?>
