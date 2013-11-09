<?php
/*
 * Created on 19/01/2012
 *
 * Cadastra novo usuário
 */ 
 		 	
 	if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
	}
 	
 	/* --Includes/Imports---------------------------------------------*/
 	include($CONTROLLERPATH.'/session/restrict/sessionControl.php');
 	include($CONTROLLERPATH.'/errors/errors.php'); 	 	
 	include($MODELPATH.'/model/produto/produto.php');
 	
 	
 	header('Content-Type: text/html; charset=UTF-8');
 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/
 	
 	$produto = new produto();
 	//$produto->setNome("Bola");
 	$resultado= $produto->selectAllProducts();
 	
 	
 	echo "Produtos<br><hr>";
 	while($cadaProduto = mysql_fetch_assoc($resultado))												
			echo $cadaProduto['nome']. " - ". $cadaProduto['quantidade']." - ".$cadaProduto['preco']."<br>";			
	
 	
 	
	
	
 
 
?>

