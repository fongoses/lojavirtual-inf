<?php
/*
 *
 *Contain classes baseProduct and subclass completeProduct.
 * 
 */
 

 
if(!defined("__PRODUTOPHP__")) {
define("__PRODUTOPHP__", "true");

	if(!defined("__MVCPATHS__")) {
	define("__MVCPATHS__", "true");
	
		$MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
	 	$CONTROLLERPATH=$MAINPATH.'/controller';
	 	$MODELPATH = $MAINPATH.'/model';
	
	}
 	
 	
 	
 	/* --Includes/Imports---------------------------------------------*/
 	
 	include($CONTROLLERPATH.'/errors/errors.php');
	include(dirname(__FILE__).'/configProduto.php');
	include($MODELPATH.'/infodb/datadb.inc');
	
	
class produto {
		
 	/*
 	 * Armazena informacoes de um produto
 	 * 
 	 */
 	
 	
 
 
  	//echo $_SESSION['pass'];
 	
 	/* --Constants----------------------------------------------------*/
 
 
 
 
 
 	/* --Fields------------------------------------------------------*/ 	
 	private $idProduto = '';
	private $nome='';
	private $descricao = '';
	private $quantidade = '';
	private $preco = '';		
	private $linkFoto = '';		
	private $dataInicio = '';
	private $dataTermino = '';
	private $tamanhoLote = '';
	private $precoLote = '';
	private $validadeAposCompra = '';	
 	
 	
 	/* --Methods-----------------------------------------------------*/
 	
	function __construct(){
 		
 		 		
 		$this->idProduto = '';
		$this->nome='';
 		$this->descricao = '';
		$this->quantidade = '';
		$this->preco = '';		
		$this->linkFoto = '';		
		$this->dataInicio = '';
		$this->dataTermino = '';
		$this->tamanhoLote = '';
		$this->precoLote = '';
		$this->validadeAposCompra = '';		
 	}
 	
 	
 	
 	public function getIdProduto(){
 		
 		return $this->idProduto;
 		
 		
 	} 	
 	
 	public function setIdProduto($novoIdProduto){
 		$this->idProduto=$novoIdProduto;
 		
 	}
 	
 	public function isIdProdutoEmpty(){
 		
 		return empty($this->idProduto);	
 		
 	}
 	
 	
 	public function getNome(){
 		
 		return $this->nome;
 		
 		
 	} 	
 	
 	public function setNome($novoNome){
 		$this->nome=$novoNome;
 		
 	}
 	
 	public function isNomeEmpty(){
 		
 		return empty($this->nome);	
 		
 	}
 	
 	public function getDescricao(){
 		
 		return $this->descricao;
 		
 		
 	} 	
 	
 	public function setDescricao($novaDescricao){
 		$this->descricao=$novaDescricao;
 		
 	}
 	
 	public function isDescricaoEmpty(){
 		
 		return empty($this->descricao);	
 		
 	}
 	
	//
	public function getQuantidade(){
 		
 		return $this->quantidade;
 		
 		
 	} 	
 	
 	public function setQuantidade($novaQuantidade){
 		$this->quantidade=$novaQuantidade;
 		
 	}
 	
 	public function isQuantidadeEmpty(){
 		
 		return empty($this->quantidade);	
 		
 	}

	//

	public function getPreco(){
 		
 		return $this->preco;
 		
 		
 	} 	
 	
 	public function setPreco($novoPreco){
 		$this->preco=$novoPreco;
 		
 	}
 	
 	public function isPrecoEmpty(){
 		
 		return empty($this->preco);	
 		
 	}

	
	public function getLinkFoto(){
 		
 		return $this->linkFoto;
 		
 		
 	} 	
 	
 	public function setLinkFoto($novoLinkFoto){
 		$this->linkFoto=$novoLinkFoto;
 		
 	}
 	
 	public function isLinkFotoEmpty(){
 		
 		return empty($this->linkFoto);	
 		
 	}

		
	public function getDataInicio(){
 		
 		return $this->dataInicio;
 		
 		
 	} 	
 	
 	public function setDataInicio($novaDataInicio){
 		$this->dataInicio=$novaDataInicio;
 		
 	}
 	
 	public function isDataInicioEmpty(){
 		
 		return empty($this->dataInicio);	
 		
 	}


	public function getDataTermino(){
 		
 		return $this->dataTermino;
 		
 		
 	} 	
 	
 	public function setDataTermino($novaDataTermino){
 		$this->dataTermino=$novaDataTermino;
 		
 	}
 	
 	public function isDataTerminoEmpty(){
 		
 		return empty($this->dataTermino);	
 		
 	}


	public function getTamanhoLote(){
 		
 		return $this->tamanhoLote;
 		
 		
 	} 	
 	
 	public function setTamanhoLote($novoTamanhoLote){
 		$this->tamanhoLote=$novoTamanhoLote;
 		
 	}
 	
 	public function isTamanhoLoteEmpty(){
 		
 		return empty($this->tamanhoLote);	
 		
 	}

	public function getPrecoLote(){
 		
 		return $this->precoLote;
 		
 		
 	} 	
 	
 	public function setPrecoLote($novoPrecoLote){
 		$this->precoLote=$novoPrecoLote;
 		
 	}
 	
 	public function isPrecoLoteEmpty(){
 		
 		return empty($this->precoLote);	
 		
 	}

	public function getValidadeAposCompra(){
 		
 		return $this->validadeAposCompra;
 		
 		
 	} 	
 	
 	public function setValidadeAposCompra($novaValidadeAposCompra){
 		$this->validadeAposCompra = $novaValidadeAposCompra;
 		
 	}
 	
 	public function isValidadeAposCompraEmpty(){
 		
 		return empty($this->validadeAposCompra);	
 		
 	}
 	
 	
 	public function echoAllFields(){
 		echo $this->getIdProduto().'<br>';
		echo $this->getNome().'<br>';
		echo $this->getDescricao().'<br>';
		echo $this->getQuantidade().'<br>';
		echo $this->getPreco().'<br>';
		echo $this->getLinkFoto().'<br>';
		echo $this->getDataInicio().'<br>';
		echo $this->getDataTermino().'<br>';
		echo $this->getTamanhoLote().'<br>';
		echo $this->getPrecoLote().'<br>';
		echo $this->getValidadeAposCompra().'<br>';
			
	}

	public function allFieldsEmpty(){
		
		return ($this->isIdProdutoEmpty() && $this->isNomeEmpty() && $this->isDescricaoEmpty() && $this->isQuantidadeEmpty() 
					&& $this->isPrecoEmpty() && $this->isLinkFotoEmpty() && $this->isDataInicioEmpty 
					&& $this->isTamanhoLoteEmpty() && $this->isPrecoLoteEmpty() && $this->isValidadeAposCompraEmpty());				
	}
 	
 	public function getFormFields(){
 		
 		/*
 		 * Get's all the form fields related to a product
 		 * Stores it in this class.
 		 * 
 		 */
 		
 		
 		//consistencia de dados eh client-side (via javascript)		
		$this->setNome($_POST['nome']); 		
		$this->setDescricao($_POST['descricao']);
 		$this->setQuantidade($_POST['quantidade']);
 		$this->setPreco($_POST['preco']);
 		$this->setLinkFoto($_POST['linkfoto']);
 		$this->setDataInicio($_POST['datainicio']);
 		$this->setDataTermino($_POST['datatermino']);
 		$this->setTamanhoLote($_POST['tamanholote']);
 		$this->setPrecoLote($_POST['precolote']);
 		$this->setValidadeAposCompra($_POST['validadeaposcompra']);			
 		
 	}
 	
 
 	
 	public function save(){
 		
 		/*
 		 * Register Product in the Database
 		 * 
 		 * return 1 when successfull, -2 when there are missing data and -1 when connection with db fails
 		 * 
 		 */
 		
 		
 		if(	($this->isNomeEmpty()) || ($this->isPrecoEmpty()) || ($this->isQuantidadeEmpty())){
 			return ERRO__MYSQL__DADOSEMBRANCO;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return ERRO__MYSQL__FALHACONEXAO;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("INSERT into produto (nome,descricao,quantidade,preco,linkfoto,datainicio,datatermino,tamanholote,precolote,validadeaposcompra) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
																mysql_real_escape_string($this->getNome()),
																mysql_real_escape_string($this->getDescricao()),
																mysql_real_escape_string($this->getQuantidade()),
																mysql_real_escape_string($this->getPreco()),
																mysql_real_escape_string($this->getLinkFoto()),	
																mysql_real_escape_string($this->getDataInicio()),	
																mysql_real_escape_string($this->getDataTermino()),	
																mysql_real_escape_string($this->getTamanhoLote()),	
																mysql_real_escape_string($this->getPrecoLote()),	
																mysql_real_escape_string($this->getValidadeAposCompra()));
																
												
												
												//echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) {
													return ERRO__MYSQL__FALHACONEXAO;
												}
												else {													
													return intval($result);
												}
	}
	
	
	public function update(){
 		
 		/*
 		 * Update Product in the Database
 		 * The update is based on the primary key (idproduto)
 		 * 
 		 */
 		
 		
 		
 		
 		if( ($this-isIdProdutoEmpty) ||	($this->isNomeEmpty()) || ($this->isPrecoEmpty()) || ($this->isQuantidadeEmpty())){
 			return -1;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return -1;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("UPDATE produto SET produto.nome= '%s',produto.descricao='%s',produto.quantidade='%s',produto.preco='%s',produto.linkfoto='%s',produto.datainicio='%s',produto.datatermino='%s',produto.tamanholote='%s',produto.precolote='%s',produto.validadeaposcompra='%s') WHERE idproduto='%s'",
																mysql_real_escape_string($this->getNome()),
																mysql_real_escape_string($this->getDescricao()),
																mysql_real_escape_string($this->getQuantidade()),
																mysql_real_escape_string($this->getPreco()),
																mysql_real_escape_string($this->getLinkFoto()),	
																mysql_real_escape_string($this->getDataInicio()),	
																mysql_real_escape_string($this->getDataTermino()),	
																mysql_real_escape_string($this->getTamanhoLote()),	
																mysql_real_escape_string($this->getPrecoLote()),	
																mysql_real_escape_string($this->getValidadeAposCompra()),
																mysql_real_escape_string($this->getIdProduto));
																
												
												
												//echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) return -1;
												else return 1;
	}
	
	
	public function select(){
 		
 		/*
 		 * Select Product in the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		if($this->allFieldsEmpty()) {
 			return -1;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return -1;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("SELECT * from produto WHERE nome = '%s' && descricao='%s' && quantidade ='%s'&& preco='%s' && linkfoto='%s' && datainicio='%s && datatermino='%s' && tamanholote='%s' && precolote='%s' && validadeaposcompra='%s')",
																mysql_real_escape_string($this->getNome()),
																mysql_real_escape_string($this->getDescricao()),
																mysql_real_escape_string($this->getQuantidade()),
																mysql_real_escape_string($this->getPreco()),
																mysql_real_escape_string($this->getLinkFoto()),	
																mysql_real_escape_string($this->getDataInicio()),	
																mysql_real_escape_string($this->getDataTermino()),	
																mysql_real_escape_string($this->getTamanhoLote()),	
																mysql_real_escape_string($this->getPrecoLote()),	
																mysql_real_escape_string($this->getValidadeAposCompra()));
																
												
												
												//echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) return -1;
												else {
													
													/*while($row = mysql_fetch_assoc($result)){
														echo row['nome'];
														echo row['descricao'];
													}*/
														
													return $result;
												}
	}
	
	
	public function delete(){
 		
 		/*
 		 * Delete Product in the Database.		
 		 * The deletion is based on the primary key (idproduto)
 		 * 
 		 */
 		
 		
 		if($this->isIdProdutoEmpty) {
 			return -1;
 			 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return -1;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("delete from produto WHERE idproduto = '%s'",
												mysql_real_escape_string($this->getIdProduto()));
												
												//echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) return -1;
												else {
													
													/*while($row = mysql_fetch_assoc($result)){
														echo row['nome'];
														echo row['descricao'];
													}*/
														
													return $result;
												}
	}
	
	
	/* Metodos uteis para manipulacao da base de dados de produtos*/
	
	
	public function selectUserProducts(){
		
 		
 		/*
 		 * Select all the Products of the current user, from the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		if($this->isNomeEmpty()) {
 			return -1;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return -1;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("SELECT * from produto WHERE nome = '%s'",		
												mysql_real_escape_string($this->getNome()));
		
												//echo $query;
												
												/*realiza a consulta*/
												$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
												if(!$result) return -1;
												else {
													return $result;
												}
	}
	
	public function selectAllProducts(){
		
 		
 		/*
 		 * Select all the Products of the current user, from the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		 		
 		//conect in mysql		
		$db=mysql_pconnect(ENDERECOBASE,USUARIOBASE,SENHA);
        
		if (!$db){	
			//die('<h1>Nao foi possivel conectar a base de dados</h1>'.mysql_error());
			return -1;
		}
				
		mysql_selectdb(BASEDADOS,$db);
		//charset
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$query = sprintf("SELECT * from produto ");
		
		//echo $query;
		
		/*realiza a consulta*/
		$result = mysql_query($query);// or die('<script type="text/javascript"> alert("Falha ao cadastrar, tente novamente mais tarde.");</script>');								
		if(!$result) return -1;
		else {
			return $result;
		}
	}
	
	
		
 		
}//fim classe produto





}?>
