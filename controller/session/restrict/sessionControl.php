<?php
/*
 * Created on 22/01/2012
 *
 * Classe de controle da sessao.
 * Instancia eh armazenada dentro da propria sessao do php.
 * 
 * 
 * mensagens de erro sao controladas externamente
 */
 
 
 /* --Includes/Imports---------------------------------------------*/
 include("../../../model/user/user.php");

 
 /*
 $ALREADY_STARTED_SESSION = -1;
 $INVALID_LOGIN =0;
 $VALID_LOGIN = 1;
 */
 
 class sessionControl{
 	
 	
 
 	
 
 
	 //classe
	 /* --Constants----------------------------------------------------*/
	 
	 
	 
	 
	 
	 /* --Fields------------------------------------------------------*/
	 
	 
	 
	 /* --Methods-----------------------------------------------------*/
 	
 	public function getCurrentUser(){
 		
 		
 		
 	}
 	
 	public function isLoginValid($user){
 		
		//consulta db para ver se ha usuario cadastrado
		/*
		 * 
		 * sql blabla...
		 * 
		 * 
		 */
		//como ainda nao implementei db sql, fiz uma verificacao/validacao por string.
	
 		if (($user->getEmail() == 'mario')|| ($user->getEmail() == 'victor'))
 		{	
 		
 			//teste
 			//echo $loginUser->getLogin().'<br/>';			
 			//exit(); -para tudo, inclusive o script aonde foi chamado
 			return true;
 			
 		}else{
 			
 			return false;
 		
 		}
 		
 		
 	}
 	
 	
 	
 	
 	
 	public function loginUser(){
 		/*
 		 * gets user information from the form and validates it. 		 * 
 		 * 
 		 * returns true if gets success
 		 */
 		
 		@session_start(); //em cada script eh necessario chamar session_start para manipular as vars da sessao. '@' nao exibe warning de 'sessao ja existe'
 		//se não existe sessao ativa, loga
 		
		if (!isset($_SESSION['sessionControl'])) {
		
		
				$_SESSION['sessionControl'] = new $this;						
				
				$loginUser = new baseUser();			
				$loginUser->getLoginFormFieldsSafely(); //getUser information from html form and store in this user
				
								
				
				//verifica se o usuario existe no DB
				 switch ($loginUser->verifyUser())				 
				 {
					case 1:			
					
					 		//manda o usuario para a pagina principal apos logado
							//na propria pagina welcome.php eh feito o controle de acesso do usuario
							//$_SESSION['user'] = serialize($loginUser); //php serializa variaveis da sessao automaticamente
							
							
							
							
							//recupera TODAS informacoes do usuario no banco de dados, gravando na session
							$loginUser->getCompleteUserDataAndStoreInTheSession();							
							
													
						 	return 1;
				 	
				 	
				 	
					case 0:
					 		
					 		
					 		//invalid_login
					 		if (isset($_SESSION['sessionControl'])) {unset($_SESSION['sessionControl']);}
					 		return 0;
					
					case -1:
							//failed to connect with DB
							if (isset($_SESSION['sessionControl'])) {unset($_SESSION['sessionControl']);} 
							return -1;
					 	
				 	
				 }
				 
				 
				 /*---------------------------------------------------*/
		 
				
				
				
				
					
				
				
		}else{
			//unset($_SESSION['sessionControl']); //tirar
			//se existe sessao ativa
			return -2;
			
			
		}
		
 		
 		
 		
 			
 		
 	}
 	
 	
 	
 	
 	public function logoutUser(){
 		/*
 		 * Logout the current user of the session and destroy all session contents, 
 		 * destroy the session as well
 		 * 
 		 */
 		
 		@session_start(); //open access to session
		
		//unset/destroy all contents
		if (isset($_SESSION['user'])){ unset($_SESSION['user']);}
		if (isset($_SESSION['sessionControl'])) { unset($_SESSION['sessionControl']);}
		if (isset($_SESSION['lastActivityTime'])) {unset($_SESSION['lastActivityTime']);} 
		
		session_destroy(); //destroy the session
		
 		
 		
 		
 		
 		
 			
 		
 	}
 	
 	public function createUserAndTestIfIsThereBlankField(){
 		
 		
		 		$loginUser = new baseUser();	
		 
				//obtem dados do formulario
				$loginUser->setEmail($_POST['loginEmailField']);
				$loginUser->setPass(md5($_POST['loginPassField'])); //Seguran�a: criptografa password com md5
				//nao dar unset no $_POST['loginPassField'] ainda pois ele eh utilizado mais adiante em sessionControl->loginUser()
		 		
			 	
			 	
			 	
				if( ($loginUser->isEmailEmpty()) || ($loginUser->isPassEmpty()) )
				{
						
					unset($loginUser); //destroi classe
					return true;
					
				}else{
					unset($loginUser); //destroi classe
					return false;	
					
				}
	 
 		
 		
 		
 	}
 	
 	
 	
 	public function isInactive(){	
  
  			
		   	@session_start();
		     
		    // tempo maximo de inatividade do usuario, em segundos
		    $inactive = 30;
		     
		    // check to see if $_SESSION['timeout'] is set
		    if(isset($_SESSION['lastActivityTime']) ) {
		    	$session_life = time() - $_SESSION['lastActivityTime'];
		   		if($session_life > $inactive)
		    	{ 
		    		
		    		//session_destroy();
		    		//if (isset($_SESSION['login'])){ unset($_SESSION['login']);}
		    		//if (isset($_SESSION['pass'])) { unset($_SESSION['pass']);}
		    		//if (isset($_SESSION['timeout'])) {unset($_SESSION['timeout']);}
		    		
		    		return true;
		    	}
		   	}
		    $_SESSION['lastActivityTime'] = time(); //qndo o usuario navega numa pagina restrita, reseta o tempo. 
		  	return false;
	  
 		
 	}
 	
 	public function controlAccess(){
			/*
			 * controlAccess
			 * 
			 * quando o login atual da sessao eh valido, mantem o usuario na pagina aonde esse metodo eh chamado.
			 * Caso contrario, bloqueia o acesso, destroi todos resquicios de sessao e redireciona o usuario para pagina de login
			 * 
			 * Como eh um metodo de controle, ecoa mensagens para o usuario.
			 * Em geral, os metodos nao ecoam para o usuario, apenas codigos de erro para o programador.
			 * 
			 */ 		
 			
 			
 			@session_start();
			//caso haja uma sessao aberta 		
 			if (isset($_SESSION['sessionControl'])){
 					
					/*inicializa variaveis de sessao*/
					//$loggedUser = unserialize($_SESSION['user']); //php serializa variaveis da sessao automaticamente
 					if (isset($_SESSION['user'])) {
 						$loggedUser = $_SESSION['user'];
 						
 						} else{exit();}
 					
 					
 					//echo '<script type="text/javascript"> alert("Falha na conexão com o sistema!'.$loggedUser->getPass().'Tente novamente!");location.href="../../login.php"</script>';exit;
					
					/*valida*/
				 	switch($loggedUser->validateUser()){
				 		
				 		case -1: unset($_SESSION['sessionControl']);unset($_SESSION['user']);echo '<script type="text/javascript"> alert("Falha na conexão com o sistemaa! Tente novamente!");location.href="../../../home"</script>';exit;
				 		case 0: unset($_SESSION['sessionControl']);unset($_SESSION['user']);echo '<script type="text/javascript"> alert("Usuário ou senha inváalidos! Tente novamente!");location.href="../../../home"</script>';exit;
				 		case 1: break; //case sucessfull(user exists), do nothing, just let the rest of the page loads
				 						//Consideration: here, we expect that user already logged in the session and $_SESSION['user'] var already is set with all user data(Which is supposed to happen in the user's login, sessionControl->loginUser())
				 	}	
				 		
				 	
				 	
			}
			else{ //caso contrario, solicita login novamente
				 	
				 	
						 	//exibe alerta e redireciona
						 	echo '<script type="text/javascript"> alert("Você não está logado.");location.href="../../../home"</script>;';	
						   	exit(); 
						   	
			}
	
 		
 		
 		
 		
 			
 		
 	}
 	
 	
 	
 }
 
 
?>
