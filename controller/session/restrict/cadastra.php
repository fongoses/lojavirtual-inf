<?php
/*
 * Created on 19/01/2012
 *
 * Cadastra novo usuário
 */
 
 
 	
 	
 	/* --Includes/Imports---------------------------------------------*/
 	if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
 	}
 	include($CONTROLLERPATH.'/session/restrict/sessionControl.php');
 	
 	header('Content-Type: text/html; charset=UTF-8');
 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/
 	
 	$newUser = new completeUser();
 	
 	
 	$newUser->registerUser(); //get data from the form and regiser in the db

 	echo '<script type="text/javascript"> alert("Cadastro realizado com sucesso! Efetue o login!");location.href="../../../"</script>;';		
	exit();
 	
 	
 
 
?>
