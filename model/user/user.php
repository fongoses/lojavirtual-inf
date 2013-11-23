<?php
/*
 *
 *Contain classes baseUser and subclass completeUser.
 * 
 */


if(!defined("__USERPHP__")) {	
	define("__USERPHP__", "true");
	

	if(!defined("__MVCPATHS__")) {
		define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
	}
	

	
	include(dirname(__FILE__).'/userConfig.php');	
	include($MODELPATH.'/infodb/datadb.inc');					
	include($CONTROLLERPATH.'/errors/errors.php');
	
	
 
 
 class baseUser{
 	
 	/*
 	 * store user's information only to login.
 	 * 
 	 * 
 	 */
 
 
  	//echo $_SESSION['pass'];
 	
 	/* --Constants----------------------------------------------------*/
 
 
 
 
 
 	/* --Fields------------------------------------------------------*/
 	private $email = ''; //email is the login
 	private $pass = 0; //expects encoded md5 pass
 	
 	
 	/* --Methods-----------------------------------------------------*/
 	
 	
 	function __construct(){
 		
 		
 		$this->email = '';
 		$this->pass=1;
 		
 		//$this->name = '';
		
 		
 	}
 	
 	
 	/*--- getters and setters---*/
 	public function getEmail(){
 		
 		return $this->email;
 		
 		
 	}
 	
 	public function setEmail($inputEmail){
 		$this->email=$inputEmail;
 	}
 	
 	public function getPass(){
 		
 		return $this->pass;
 		
 		
 	} 	
 	
 	public function setPass($inputPass){
 		$this->pass=$inputPass;
 	}
 	
 	
 	public function isEmailEmpty(){
 		
 		return empty($this->email);
 		
 	}
 	
 	public function isPassEmpty(){
 		
 		return empty($this->pass);	
 		
 	}
 	
 	
 	//obtem dados do formulario de login
	public function getLoginFormFieldsSafely(){
 		
 		/*
 		 * Get's all the Login's form fields needed to subscription.
 		 * Stores it in this class(completeUser).
 		 * 
 		 */
 		
 		
 		//consistencia de dados eh client-side (via javascript)
 		
		$this->setEmail($_POST['email']); 		
		$this->setPass(md5($_POST['pass'])); //Segurança: criptografa password com md5			
 		unset($_POST['pass']); //segurança: apaga password
 		
 		
 		
 		
 		
 	}
 	
 	public function getCompleteUserDataAndStoreInTheSession(){
 		/*
 		 * Obtem usuario atual em $_SESSION['user'], recupera todas suas informacoes
 		 * no DB e regrava novamente em $_SESSION['user']
 		 * 
 		 * 
 		 */
 		 
 		 //nada disso precisaria ser feito, pois verifyUser() já armazena na session
 		 @session_start();
 		 
 		 if(isset($_SESSION['user'])){
 		 	
 		 	
 		 	$completeUser = $_SESSION['user'];
 		 	
 		 	
 		 	//copy fields
 		 	//$completeUser->setEmail($baseUser->getEmail()); 		 	
 		 	//$completeUser->setPass($baseUser->getPass());
 		 	
 		 	
 		 	
 		 	//query the DB and
 		 	//copy the remaining fields
 		 	/*
 		 	 * 
 		 	 * later...
 		 	 * 
 		 	 */
 		 	
 		 	$_SESSION['user'] = $completeUser; 		 	
 		 } 		
 	}
 	
 	
 	public function verifyUser(){
 		/*
 		 * 
 		 * Verify if user exists in DB
 		 * 
 		 * 
 		 * return 1 if user exists, 0 if doenst, -1 if fails on connecting with db
 		 */
 		 
 		 /*
 		 @session_start();
 		 
 		 if(isset($_SESSION['user'])){
 		 	
 		 	$baseUser = $_SESSION['user'];
 		 	
 		 	
 		 	
 		 	//conect in mysql
			$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
			if (!$db)
			{	
				die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			
			}
			//
			mysql_selectdb(BASEDADOS,$db);
			
			$query = sprintf("SELECT * FROM registeredusers WHERE login = '%s' && pass = '%s'",
																	mysql_real_escape_string($this->login),
																	mysql_real_escape_string(md5($this->pass)));
																	
													
													
													//echo $query;
													
													//realiza a consulta
													$result = mysql_query($query) or die('<script type="text/javascript"> alert("Usuário ou senha inválidos! Tente novamente!");location.href="../../login.php"</script>');								
								
	 		 
	 		 //if user exists in database, get user data and starts a session with it	 		 
	 		 $completeUser = new completeUser();
	 		 
	 		 //get user data
	 		 $completeUser->setLogin(mysql_field_name($result,0));
	 		 $completeUser->setPass(mysql_field_name($result,1));
	 		 $completeUser->setEmail(mysql_field_name($result,2));
	 		 $completeUser->setName(mysql_field_name($result,3));
	 		 
	 		 	 		 	
	 		 $_SESSION['user'] = $completeUser; 		 	
 		 }*/ 
 		 	 @session_start();
 		 	 
	 		 if(isset($_SESSION['sessionControl'])){
	 		 	
	 		 	
	 		 	
	 		 	
	 		 	

	 		 	//conect in mysql
				$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
				if (!$db)
				{	
									
					return -1;
					
				
				}
				//
				mysql_selectdb(BASEDADOS,$db);
				
				//charset
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');
				
				
				
				$query = sprintf("SELECT * FROM vendedor WHERE (email = '%s') and (senha = '%s') ",
																		mysql_real_escape_string($this->email),
																		mysql_real_escape_string($this->pass)); //pass foi unsetado pela funcao que leu dados do form na hora de registar(getRegisterFormFieldsSafely). Solução: fazer uma função para obter os dados do usuario, se possivel, sem a necessidade de confirmar o password. Sugestao: em vez da verificacao por password, testar somente a validade da sessao. O pass geralmente soh eh verificado em areas mais importantes da sessao restrita
																		
														
														
														//echo $query;
														
														//realiza a consulta
														$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Usuário ou senha inválidos! Tente novamente!");location.href="../../login.php"</script>');								
														if (!$result){
															return 0;
														}
		 		 
		 		 //if user exists in database, get user data and starts a session with it	 		 
		 		 $completeUser = new completeUser();
		 		 
		 		
		 		 $row =  mysql_fetch_array($result,MYSQL_NUM); //obtem a primeira linha, armazena em row, e incrementa o ponteiro da tabela resultante		 		 
		 		 
		 		 if (!$row){
		 		 	
		 		 	//doesnt exists in database
		 		 	return 0;
		 		 	
		 		 	
		 		 	
		 		 }
		 		
		 		
		 		 //echo '<script type="text/javascript"> alert("'.$this->login.'")</script>';exit;	
		 		 
		 		 //get user data
		 		 $completeUser->setName($row[1]); //coluna 0 eh a id/PK
		 		 $completeUser->setEmail($row[3]);
		 		 //echo '<script type="text/javascript"> alert("'.$completeUser->getLogin().'")</script>';exit;
		 		 //echo '**'.$row[0].'**<br/>';
		 		 //$completeUser->setPass($row[3]);//em principio,nao ira precisar do pass na sessao. Caso necessite a senha para uma operacao mais segura, serah feita uma nova solicitacao e uma consulta ao BD
		 		 
		 		 
		 		 
						 		 		 	
		 		 $_SESSION['user'] = $completeUser;
		 		 
		 		 mysql_close();
		 		 return 1;
	 		 } 		 		
 	}
 
 	
 	
 	public function validateUser(){
 		
 		/*
 		 * 
 		 * Verify if the current user uses the database
 		 * 
 		 */
 
 		//conect in mysql
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
		if (!$db)
		{	
							
			return -1;
			
		
		}
		//
		mysql_selectdb(BASEDADOS,$db);
		
		
		
		$query = sprintf("SELECT * FROM vendedor WHERE (email = '%s')",
																mysql_real_escape_string($this->email)); //pass foi unsetado pela funcao que leu dados do form na hora de registar(getRegisterFormFieldsSafely). Solução: fazer uma função para obter os dados do usuario, se possivel, sem a necessidade de confirmar o password. Sugestao: em vez da verificacao por password, testar somente a validade da sessao. O pass geralmente soh eh verificado em areas mais importantes da sessao restrita
																
												
												
		//echo $query;
		
		//realiza a consulta
		$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Usuário ou senha inválidos! Tente novamente!");location.href="../../login.php"</script>');								
		if (!$result){
						return 0;
		}
 
 		
		mysql_close();
		return 1;
 
 
 
 	}
 	
 	
 	
 }
 
class completeUser extends baseUser{
		
 	/*
 	 * store all user's information needed for database's task.
 	 * 
 	 */
 	
 	
 
 
  	//echo $_SESSION['pass'];
 	
 	/* --Constants----------------------------------------------------*/
 
 
 
 
 
 	/* --Fields------------------------------------------------------*/
 	//private $email = '';
 	private $name = '';
 	private $email = '';
	
 	
 	
 	/* --Methods-----------------------------------------------------*/
 	
	function __construct(){
 		
 		parent::__construct();
 		//$this->email = '';
 		$this->name = '';		
 		$this->address = '';		
		$this->city = '';		
		$this->iduf = '';		
		$this->ifpais = '';
		$this->zip = '';
		$this->birthday = '';
		$this->cpf = '';
		$this->admin = false;		
 	}
 	
 	
 	
 
 	
 	
 	public function getName(){
 		
 		return $this->name;
 		
 		
 	} 	
 	
 	public function setName($inputName){
 		$this->name=$inputName;
 		
 	}
 	
 	public function isNameEmpty(){
 		
 		return empty($this->name);	
 		
 	}
 	
 		
	//
	public function getAddress(){
 		
 		return $this->address;
 		
 		
 	} 	
 	
 	public function setAddress($inputAddress){
 		$this->address=$inputAddress;
 		
 	}
 	
 	public function isAddressEmpty(){
 		
 		return empty($this->address);	
 		
 	}

	//

	public function getCity(){
 		
 		return $this->city;
 		
 		
 	} 	
 	
 	public function setCity($inputCity){
 		$this->city=$inputCity;
 		
 	}
 	
 	public function isCityEmpty(){
 		
 		return empty($this->city);	
 		
 	}

	//

	public function getIdUf(){
 		
 		return $this->iduf;
 		
 		
 	} 	
 	
 	public function setIdUf($inputIdUf){
 		$this->iduf=$inputIdUf;
 		
 	}
 	
 	public function isIdUfEmpty(){
 		
 		return empty($this->iduf);	
 		
 	}

 	//
	
	public function getIdPais(){
 		
 		return $this->idpais;
 		
 		
 	} 	
 	
 	public function setIdPais($inputIdPais){
 		$this->idpais=$inputIdPais;
 		
 	}
 	
 	public function isIdPaisEmpty(){
 		
 		return empty($this->idpais);	
 		
 	}

	//

	public function getZip(){
 		
 		return $this->zip;
 		
 		
 	} 	
 	
 	public function setZip($inputZip){
 		$this->zip=$inputZip;
 		
 	}
 	
 	public function isZipEmpty(){
 		
 		return empty($this->zip);	
 		
 	}

	//

	public function getBirthday(){
 		
 		return $this->birthday;
 		
 		
 	} 	
 	
 	public function setBirthday($inputBirthday){
 		$this->birthday=$inputBirthday;
 		
 	}
 	
 	public function isBirthdayEmpty(){
 		
 		return empty($this->birthday);	
 		
 	}

	public function getCpf(){
 		
 		return $this->cpf;
 		
 		
 	} 	
 	
 	public function setCpf($inputCpf){
 		$this->cpf=$inputCpf;
 		
 	}
 	
 	public function isCpfEmpty(){
 		
 		return empty($this->cpf);	
 		
 	}
 	
 	public function getAdmin(){
 		
 		return $this->admin; 		
 		
 	} 	
 	
 	public function setAdmin($flagAdmin){
 		$this->admin=$flagAdmin;
 		
 	}
 	

 	public function isAdminEmpty(){
 		
 		return empty($this->admin);	
 		
 	}
 
 	
 	public function echoAllFields(){
		echo $this->getName().'<br>';		
		echo $this->getEmail().'<br>';
		//echo $this->getPass().'<br>';
		echo 'Senha <br>';
		echo $this->getAddress().'<br>';		
		echo $this->getCity().'<br>';
		echo $this->getIdUf().'<br>';
		echo $this->getIdPais().'<br>';
		echo $this->getZip().'<br>';
		echo $this->getBirthday().'<br>';
		echo $this->getCpf().'<br>';
		echo $this->getAdmin().'<br>';
		
		
	}

 	//obtem dados do formulario de cadastro
 	public function getRegisterFormFieldsSafely(){
 		
 		/*
 		 * Get's all the form fields needed to subscription.
 		 * Stores it in this class.
 		 * 
 		 */
 		
 		
 		//consistencia de dados eh client-side (via javascript)
 		
		if(!empty($_POST['pass'])){
			$this->setPass(md5($_POST['pass'])); //Segurança: criptografa password com md5			
 			unset($_POST['pass']); //segurança: apaga password
 			
		}else $this->setPass('');
		

		$this->setEmail($_POST['email']);
 		$this->setName($_POST['nome']);		
 		$this->setAddress($_POST['endereco']); 		
 		$this->setCity($_POST['cidade']);
 		$this->setIdUf($_POST['uf']);
 		$this->setIdPais($_POST['pais']);
 		$this->setZip($_POST['cep']);
 		$this->setBirthday($_POST['nascimento']);
		$this->setCpf($_POST['cpf']);
		$this->setAdmin($_POST['admin']);
		

 	}
 	//TODO: 
 	//-renomear para save()
 	//-
 	public function registerUser(){
 		
 		/*
 		 * Register User in the Database
 		 * 
 		 * this control everything about registering, including errors and echoed messages
 		 */
 		
 		
 		//get the info from the from in the view filling this instance of class with form contents
 		$this->getRegisterFormFieldsSafely();
 		
 		 		
 		if(	($this->isEmailEmpty()) || ($this->isPassEmpty()) || ($this->isNameEmpty()) || ($this->isIdUfEmpty()) || ($this->isIdPaisEmpty())   ){
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../view/usuario/cadastro/"</script>;';
 			//exit; 			
 			
 			 
 			return ERRO__MYSQL__DADOSEMBRANCO;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db)
		{	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return ERRO__MYSQL__FALHACONEXAO;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("INSERT into usuario (nome,email,senha,endereco,cidade,iduf,idpais,cep,nascimento,cpf,admin) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
																mysql_real_escape_string($this->getName()),																
																mysql_real_escape_string($this->getEmail()),
																mysql_real_escape_string($this->getPass()),
																mysql_real_escape_string($this->getAddress()),																
																mysql_real_escape_string($this->getCity()),	
																mysql_real_escape_string($this->getIdUf()),
																mysql_real_escape_string($this->getIdPais()),	
																mysql_real_escape_string($this->getZip()),	
																mysql_real_escape_string($this->getBirthday()),	
																mysql_real_escape_string($this->getCpf()),
																mysql_real_escape_string($this->getAdmin()));
																
																
																
												
												
												echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query); //or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) {											
													return ERRO__MYSQL__FALHACONEXAO;
												}
												else {													
													return intval($result); //precisa retornar um inteiro;
												}
										
		
		
		//echo $result;
 		
 	}	
 		
}

}?>
