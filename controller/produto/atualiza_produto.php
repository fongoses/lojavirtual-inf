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
	 	
	$idProduto = intval($_POST['idproduto']); //obter essa informcacao da sessao

 	$produto = new produto();

 	$produto->setIdProduto($idProduto); 
 	$produto->getUpdateFormFields(); 	
 		
 	
 	//if($produto->belongsToUser($_SESSION['user']->getName()))
 		$resultado = $produto->update();
 	
 	 	
	if($resultado == ERRO__MYSQL__DADOSEMBRANCO){		 			
 		echo '<script type="text/javascript"> alert("Produto inexistente");location.href="../../view/produto/visualizacao/"</script>;';
 		return;
 	}
 	
 	if($resultado == ERRO__MYSQL__FALHACONEXAO){
 		echo '<script type="text/javascript"> alert("Falha na conexão");location.href="../../view/produto/visualizacao/"</script>;';
 		return;
 	} 	
 	
 	if ($resultado > 0) {
		echo '<script type="text/javascript"> alert("Alteração realizada com sucesso!");location.href="../../view/produto/visualizacao/"</script>;';
		return;
	}
 	
?>

