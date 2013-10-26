<?php
/*
 *
 *Contain classes baseUser and subclass completeUser.
 * 
 */
 
 
 include('userConfig.php');
 include('datadb.php');

 
 
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
		$this->completeName='';
 		$this->street = '';
		$this->number = '';
		$this->city = '';		
		$this->state = '';		
		$this->country = '';
		$this->zip = '';
		$this->birthday = '';
		$this->cpf = '';
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
 	
 	public function getCompleteName(){
 		
 		return $this->completeName;
 		
 		
 	} 	
 	
 	public function setCompleteName($inputName){
 		$this->completeName=$inputName;
 		
 	}
 	
 	public function isCompleteNameEmpty(){
 		
 		return empty($this->completeName);	
 		
 	}
 	
	//
	public function getStreet(){
 		
 		return $this->street;
 		
 		
 	} 	
 	
 	public function setStreet($inputStreet){
 		$this->street=$inputStreet;
 		
 	}
 	
 	public function isStreetEmpty(){
 		
 		return empty($this->street);	
 		
 	}

	//

	public function getNumber(){
 		
 		return $this->number;
 		
 		
 	} 	
 	
 	public function setNumber($inputNumber){
 		$this->number=$inputNumber;
 		
 	}
 	
 	public function isNumberEmpty(){
 		
 		return empty($this->number);	
 		
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
	
	public function getState(){
 		
 		return $this->state;
 		
 		
 	} 	
 	
 	public function setState($inputState){
 		$this->state=$inputState;
 		
 	}
 	
 	public function isStateEmpty(){
 		
 		return empty($this->state);	
 		
 	}

	//

	public function getCountry(){
 		
 		return $this->country;
 		
 		
 	} 	
 	
 	public function setCountry($inputCountry){
 		$this->country=$inputCountry;
 		
 	}
 	
 	public function isCountryEmpty(){
 		
 		return empty($this->country);	
 		
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
	
	public function echoAllFields(){
		echo $this->getName().'<br>';
		echo $this->getCompleteName().'<br>';
		echo $this->getEmail().'<br>';
		//echo $this->getPass().'<br>';
		echo 'Senha <br>';
		echo $this->getStreet().'<br>';
		echo $this->getNumber().'<br>';
		echo $this->getCity().'<br>';
		echo $this->getState().'<br>';
		echo $this->getCountry().'<br>';
		echo $this->getZip().'<br>';
		echo $this->getBirthday().'<br>';
		echo $this->getCpf().'<br>';
		


	}

 	//obtem dados do formulario de cadastro
 	public function getRegisterFormFieldsSafely(){
 		
 		/*
 		 * Get's all the form fields needed to subscription.
 		 * Stores it in this class.
 		 * 
 		 */
 		
 		
 		//consistencia de dados eh client-side (via javascript)
 		
		
		$this->setPass(md5($_POST['pass'])); //Segurança: criptografa password com md5			
 		unset($_POST['pass']); //segurança: apaga password
		$this->setEmail($_POST['email']);
 		$this->setName($_POST['nome']);
		$this->setCompleteName($_POST['sobrenome']);
 		$this->setName($_POST['nome']);
 		$this->setStreet($_POST['rua']);
 		$this->setNumber($_POST['numero']);
 		$this->setCity($_POST['cidade']);
 		$this->setState($_POST['estado']);
 		$this->setCountry($_POST['pais']);
 		$this->setZip($_POST['cep']);
 		$this->setBirthday($_POST['nascimento']);
		$this->setCpf($_POST['cpf']);
 		
 		
 		
 	}
 	
 
 	
 	public function registerUser(){
 		
 		/*
 		 * Register User in the Database
 		 * 
 		 * this control everything about registering, including errors and echoed messages
 		 */
 		
 		
 		//get the info from the from in the view filling this instance of class with form contents
 		$this->getRegisterFormFieldsSafely();
 		
 		

 		
 		if(	($this->isEmailEmpty()) || ($this->isPassEmpty()) || ($this->isNameEmpty()))
 		{
 			echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../../home"</script>;';
 			exit;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db)
		{	
			die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
		
		}
				
		mysql_selectdb(BASEDADOS,$db);
		echo BASEDADOS;
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$this->echoAllFields();
		$query = sprintf("INSERT into vendedor (nome,sobrenome,email,senha,rua,numero,cidade,estado,pais,cep,nascimento,cpf) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
																mysql_real_escape_string($this->getName()),
																mysql_real_escape_string($this->getCompleteName()),
																mysql_real_escape_string($this->getEmail()),
																mysql_real_escape_string($this->getPass()),
																mysql_real_escape_string($this->getStreet()),	
																mysql_real_escape_string($this->getNumber()),	
																mysql_real_escape_string($this->getCity()),	
																mysql_real_escape_string($this->getState()),	
																mysql_real_escape_string($this->getCountry()),	
																mysql_real_escape_string($this->getZip()),	
																mysql_real_escape_string($this->getBirthday()),	
																mysql_real_escape_string($this->getCpf()));
																
												
												
												echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query) or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
							
		
		
		//echo $result;
 		
 	}	
 	
 
 	
 	
	
	
	
	
}
 
 
 
 
?>
