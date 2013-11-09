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
 	include($MODELPATH.'/produto/produto.php');
 	
 	
 	header('Content-Type: text/html; charset=UTF-8');
 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/
 	
 	$produto = new produto();
 	
 	$produto->getFormFields();
 	
 	$resultado = $produto->save();
 	
 	
 	
	if($resultado == ERRO__MYSQL__DADOSEMBRANCO){	
 			
 		echo '<script type="text/javascript"> alert("Preencha os dados obrigatórios (*) do formulário");location.href="../../view/produto/cadastro/"</script>;';
 		return;
 	}
 	
 	if($resultado == ERRO__MYSQL__FALHACONEXAO){
 		echo '<script type="text/javascript"> alert("Falha na conexão");location.href="../../view/produto/cadastro/"</script>;';
 		return;
 	} 	
 	
 	if ($resultado > 0) {
		echo '<script type="text/javascript"> alert("Produto cadastrado com sucesso!");location.href="../../view/produto/cadastro/"</script>;';
		return;
	}	
 	
 	
 
 
?>
