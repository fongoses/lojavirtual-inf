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
 	include($CONTROLLERPATH.'/session/restrict/restrictPageHeader.php');
 	include($CONTROLLERPATH.'/session/restrict/sessionControl.php');
 	include($CONTROLLERPATH.'/errors/errors.php');
 	include($MODELPATH.'/usuario/usuario.php');
 	 	
 	header('Content-Type: text/html; charset=UTF-8');
 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/ 	
	

 	$usuarioCompleto = new usuarioCompleto();
 	$usuarioCompleto->setIdUsuario($_SESSION['user']->getIdUsuario());
 	$usuarioCompleto->getUpdateFormFieldsSafely();	
 	$resultado = $usuarioCompleto->update();

 	
 	
 	//if($produto->belongsToUser($_SESSION['user']->getName()))
 		//$resultado = $produto->update();
 	
 	 	
	if($resultado == ERRO__MYSQL__DADOSEMBRANCO){		 			
 		echo '<script type="text/javascript"> alert("Preencha todos os dados obrigatorios");location.href="../../view/usuario/configuracoes/"</script>;';
 		return;
 	}
 	
 	if($resultado == ERRO__MYSQL__FALHACONEXAO){
 		echo '<script type="text/javascript"> alert("Falha na conexão");location.href="../../view/usuario/configuracoes/"</script>;';
 		return;
 	} 	
 	
 	if ($resultado > 0) {
 		//atualiza usuario da sessao(email permanece o antigo) 		
 		$usuarioCompleto->setEmail($_SESSION['user']->getEmail());
 		$_SESSION['user']=$usuarioCompleto; 
		echo '<script type="text/javascript"> alert("Alteração realizada com sucesso!");location.href="../../view/usuario/configuracoes/"</script>;';
		return;
	}
 	
?>

