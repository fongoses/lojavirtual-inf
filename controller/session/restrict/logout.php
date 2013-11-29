<?php
	
	if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
 	}

	header('Content-Type: text/html; charset=UTF-8');



	include($CONTROLLERPATH.'/session/restrict/restrictPageHeader.php');
	

	//desloga
	$sessionControl->logoutUser();


	echo '<script type="text/javascript"> alert("Você saiu do sistema");location.href="../../../"</script>;';		


?>