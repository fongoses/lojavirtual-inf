<?php
/*
 * Created on 22/01/2012
 *
 * Script that calls controlAccess's method for restrict pages.
 * 
 * 
 * 
 * All restrict pages MUST have it included before start your HTML code
 */

if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
}
include($CONTROLLERPATH.'/session/restrict/sessionControl.php');

 
 
//controla Acesso de usuario
@session_start();
if (isset($_SESSION['sessionControl'])){ 
	//se ha um usuario logado
	
	//$loggedUser = $_SESSION['user'];
	$sessionControl = $_SESSION['sessionControl'];
	//$sessionControl->logoutUser();	
	
	//controla seu acesso
	$sessionControl->controlAccess();


				
			
}else { 
	
	echo '<script type="text/javascript"> alert("Você não está logado!");location.href="http://localhost/lojavirtual/view"</script>';		
	exit();
}
	

//verifica inatividade do usuario
if ($sessionControl->isInactive()){		
		
	$sessionControl->logoutUser();				
	echo '<script type="text/javascript"> alert("Sessão Expirada.");location.href="http://localhost/lojavirtual/view"</script>';
	exit();
	
}

 
?>
