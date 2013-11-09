<?php
/*
 * Created on 09/01/2012
 *
 *Script de autenticacao.
 *
 *
 *
 *Salva na própria sessão do PHP uma instancia da classe de usuário 'User' 
 *e uma de controle de sessão 'sessionControl'. Essas instâncias serão utilizadas durante
 *a sessão para o controle dela e do usuário correspondente.
 *
 * Com ajax, ele serve como interface de comunicação entre o php e o javascript,
 * de modo que as mensagens ecoadas são retornadas via ajax para o client  
 * 
 */
 

 /* --Includes/Imports---------------------------------------------*/
 if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
 }
  
 include($CONTROLLERPATH.'/session/restrict/sessionControl.php'); //Classes de usuario e de sessao ja declaradas aqui
 header('Content-Type: text/html; charset=UTF-8');
 
 

 
	
	$sessionControl = new sessionControl();	
		
	//caso form esteja em branco
	if($sessionControl->createUserAndTestIfIsThereBlankField()){			
		
		exit;	
		
	}
	
	
	
	//loginUser() obtem os dados do form e realiza  login do usuario
	switch($sessionControl->loginUser()){
		
	case -2:				
							//ja ha sessão ativa, mas usuario tenta logar novamente
							//unset($_SESSION['sessionControl']);
							
							/* sem ajax - Php ecoa mensagens*/
							//echo '<script type="text/javascript"> alert("Já há uma sessão ativa");"</script>';
							
							/* com ajax - Php envia o codigo de volta para o ajax, e as mensagens/redir sao ecoadas via javascript*/
							echo '-2'; 
							break; 
	
	case -1:
	
							//se ja existe sessao em andamento, redireciona para pagina inicial/restrita da sessao
							
							//sem ajax
							//echo '<script type="text/javascript"> location.href="../../restrictPages/welcome.php"</script>';
							
							//com ajax
							echo '-1';
							break; 
	
	
	
	case 0:
							
							//Se o acesso/login nao eh permitido, retorna para a pagina de login, exibindo uma mensagem							
							
							//sem ajax
							//echo '<script type="text/javascript"> alert("Login Inválido.");</script>';	
							
							//com ajax
							echo '0';
							break;
	
	
	case 1:
							 
							//vai para a area restrita (agora, o usuario eh completeUser)							
							
							//sem ajax
							//header("Location: ../../restrictPages/welcome.php");
							
							//com ajax
							echo '1';						
							break;
	
	
	
	}
	
	


  
 
 
?>
