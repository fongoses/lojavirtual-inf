<?php
/*
 *
 *Contain classes usuarioBase and subclass usuarioCompleto.
 * 
 */


if(!defined("__USERPHP__")) {	
	define("__USERPHP__", "true");
	

	if(!defined("__MVCPATHS__")) {
		define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'/lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
	}
	

	
	include(dirname(__FILE__).'/configUsuario.php');	
	include($MODELPATH.'/infodb/datadb.inc');					
	include($CONTROLLERPATH.'/errors/errors.php');
	
	
 
 
 class usuarioBase{
 	
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
 		 * Stores it in this class(usuarioCompleto).
 		 * 
 		 */
 		
 		
 		//consistencia de dados eh client-side (via javascript)
 		
		$this->setEmail($_POST['login']); 		
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
 		 	
 		 	
 		 	$usuarioCompleto = $_SESSION['user'];
 		 	
 		 	
 		 	
 		 	
 		 	$_SESSION['user'] = $usuarioCompleto; 		 	
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
 		 	
 		 	$usuarioBase = $_SESSION['user'];
 		 	
 		 	
 		 	
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
	 		 $usuarioCompleto = new usuarioCompleto();
	 		 
	 		 //get user data
	 		 $usuarioCompleto->setLogin(mysql_field_name($result,0));
	 		 $usuarioCompleto->setPass(mysql_field_name($result,1));
	 		 $usuarioCompleto->setEmail(mysql_field_name($result,2));
	 		 $usuarioCompleto->setName(mysql_field_name($result,3));
	 		 
	 		 	 		 	
	 		 $_SESSION['user'] = $usuarioCompleto; 		 	
 		 }*/ 
 		 	@session_start();
 		 	 
	 		if(isset($_SESSION['sessionControl'])){
		 		$result=$this->select();

		 		if (!$result){
		 		 	
		 			//doesnt exists in database
		 		 	return 0;

		 		}
		 		
		 		
		 		//if user exists in database, get user data and starts a session with it	 		 
		 		$usuarioCompleto = new usuarioCompleto();

		 		//armazena dados do usuario na sessao.
		 		$userdata=$result[0];
		 		$usuarioCompleto->setIdUsuario($userdata['idusuario']); 
		 		$usuarioCompleto->setName($userdata['nome']); 
		 		$usuarioCompleto->setEmail($userdata['email']);
		 		$usuarioCompleto->setAddress($userdata['endereco']);
		 		$usuarioCompleto->setCity($userdata['cidade']);
		 		$usuarioCompleto->setIdUf($userdata['iduf']);
		 		$usuarioCompleto->setIdPais($userdata['idpais']);
		 		$usuarioCompleto->setZip($userdata['cep']);
		 		$usuarioCompleto->setBirthday($userdata['nascimento']);
		 		$usuarioCompleto->setCpf($userdata['cpf']);
		 		


		 		 
		 		 
						 		 		 	
		 		$_SESSION['user'] = $usuarioCompleto;		 		 
		 		
		 		return 1;
	 		 } 		 		
 	}
 
 	
 	
 	public function validateUser(){
 		
 		/*
 		 * 
 		 * Verify if the current user uses the database
 		 * 
 		 */

 		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			$query = $db->prepare("SELECT * FROM usuario WHERE (email = 'mariogasparoni@gmail.com')");
			
			$query->execute(array($this->getEmail()));
			$result = $query->fetchAll();
			
		    $db = null;//fecha conexao

		    if(!$result) return 0;
		    return 1; //1:sucesso

		} catch (Exception $e) {		    
		    
		    return 0;

		}		
 	}


 	public function select(){
 		
 		/*
 		 * 
 		 * Verify if the current user uses the database
 		 * 
 		 */

 		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			$query = $db->prepare("SELECT * FROM usuario WHERE (email = ?)");
			
			$query->execute(array($this->getEmail()));
			$result = $query->fetchAll();
			
		    $db = null;//fecha conexao

		    return $result;	    

		} catch (Exception $e) {		    
		    
		    return NULL;

		}		
 	}
 	
 	
 	
 }
 
class usuarioCompleto extends usuarioBase{
		
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
 		$this->idUsuario=-1;
 		$this->name = '';
		$this->email = '';
 		$this->address = '';		
		$this->city = '';		
		$this->iduf = '';		
		$this->ifpais = '';
		$this->zip = '';
		$this->birthday = '';
		$this->cpf = '';
		$this->admin = false;	
 	}
 	
 	
 	public function getIdUsuario(){ 		
 		return $this->idUsuario;		
 		
 	} 	
 	
 	public function setIdUsuario($inputId){
 		$this->idUsuario=$inputId;
 		
 	}
 	
 	public function isIdUsuarioEmpty(){
 		
 		if ($this->idUsuario < 0) return true;	
 		return false;
 		
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
		$this->setAdmin(true);
		

 	}



 	public function getUpdateFormFieldsSafely(){
 		
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
		

		
 		$this->setName($_POST['nome']);		
 		$this->setAddress($_POST['endereco']); 		
 		$this->setCity($_POST['cidade']);
 		$this->setIdUf($_POST['uf']);
 		$this->setIdPais($_POST['pais']);
 		$this->setZip($_POST['cep']);
 		$this->setBirthday($_POST['nascimento']);
		$this->setCpf($_POST['cpf']);
		$this->setAdmin(true);
		

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



 	public function update(){
 		
 		/*
 		 * Update User in the Database
 		 * 
 		 * 
 		 */
 		
 		
 		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);			

		    $query = $db->prepare("UPDATE usuario SET nome=?,senha=?,endereco=?,cidade=?,iduf=?,idpais=?,cep=?,nascimento=?,cpf=? WHERE idusuario=?");
		    $query->execute(
		    	array($this->getName(),$this->getPass(),$this->getAddress(),
		    			$this->getCity(),$this->getIdUf(),$this->getIdPais(),
		    			$this->getZip(),$this->getBirthday(),$this->getCpf(),
		    			$this->getIdUsuario()));

		    $db = null;

		    return 1; 

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
		}	
 		
 	}



 	
 	
 	
 


 		
}//fim classe

}?>
