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
	include($MODELPATH.'/produto/configProduto.php');
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
 		
 		return empty($this->quantidade) && ($this->quantidade == 0);	
 		
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
 		 			
		
		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			$query1 = sprintf("INSERT into produto (nome,descricao,quantidade,preco,linkfoto,datainicio,datatermino,tamanholote,precolote,validadeaposcompra) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
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
																		
				
			
			// inicia a transacao
			$db->beginTransaction();

				
			    //Insere. Funcao exec retorna o numero de linhas afetadas			    
			    $count = $db->exec($query1);

			    $idProdutoCadastrado = $db->lastInsertId();
			    $idVendedor=1; //obter esse valor da sessao
				$query2 = sprintf("INSERT into produto_vendedor (idvendedor,idproduto,datacadastro) VALUES (%d,%d,NOW())",
																		$idVendedor,
																		$idProdutoCadastrado);
    
			    $count = $db->exec($query2);			
			    

		    $db->commit();//finaliza transacao
		    $db = null;//fecha conexao

		    return 1; //1:sucesso

		} catch (Exception $e) {
		    
		    $db->rollback(); //rollback em caso de falha
		    return ERRO__MYSQL__FALHACONEXAO;

		}


	}
	
	
	public function update(){
 		
 		/*
 		 * Update Product in the Database
 		 * The update is based on the primary key (idproduto)
 		 * 
 		 */
 		
 		
 		
 		
 		if( ($this->isIdProdutoEmpty()) ||	($this->isNomeEmpty()) || ($this->isPrecoEmpty()) || ($this->isQuantidadeEmpty())){
 			return ERRO__MYSQL__DADOSEMBRANCO;;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		

		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			

			$query = sprintf("UPDATE produto SET produto.nome= '%s',produto.descricao='%s',produto.quantidade='%s',produto.preco='%s',produto.linkfoto='%s',produto.datainicio='%s',produto.datatermino='%s',produto.tamanholote='%s',produto.precolote='%s',produto.validadeaposcompra='%s' WHERE idproduto='%d'",
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
															$this->getIdProduto());

		    
		    $count = $db->exec($query);
		   
		    $db = null;

		    return 1; 

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
		}		
		
	}
	
	
	public function select($code){
 		
 		/*
 		 * Select Product in the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.

 		 * if $code == 0, then this function returns all available products as a buyer.
 		 * if $code == 1, then this function returns all available products as a seller. 		 
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		if($this->allFieldsEmpty()) {
 			return ERRO__MYSQL__DADOSEMBRANCO;;
 			//echo '<script type="text/javascript"> alert("Preencha todos os dados do formulário");location.href="../../../view/cadastro/"</script>;';
 			//exit;
 			
 		}
 		
 		try {

			
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			$idUsuario=1; //obter esse valor da sessao

			//join eh prod carteziano, ja natural join eh o natural join, de fato
			if (!$code) 
				$query = sprintf("SELECT * from produto_cliente pc NATURAL JOIN produto p WHERE p.excluidovendedor = 0 AND pc.idcliente = %d ",$idUsuario);
			else
				$query = sprintf("SELECT * from produto_vendedor pv NATURAL JOIN produto p WHERE p.excluidovendedor = 0 AND pv.idvendedor = %d ",$idUsuario);
			
			if(!$this->isIdProdutoEmpty())
				$query .=  sprintf("AND p.idproduto = %d ",$this->getIdProduto());
			if(!$this->isNomeEmpty())
				$query .=  sprintf("AND p.nome = '%s' ",mysql_real_escape_string($this->getNome()));
			if(!$this->isDescricaoEmpty())
				$query .= sprintf("AND p.descricao = '%s' ",mysql_real_escape_string($this->getDescricao()));
			if(!$this->isQuantidadeEmpty())
				$query .= sprintf("AND p.quantidade = %d ",intval(mysql_real_escape_string($this->getQuantidade())));
			if(!$this->isPrecoEmpty())
				$query .= sprintf("AND p.preco = '%s' ",mysql_real_escape_string($this->getPreco()));
			if(!$this->isLinkFotoEmpty())
				$query .= sprintf("AND p.linkfoto = 's%' ",mysql_real_escape_string($this->getLinkFoto()));
			if(!$this->isDataInicioEmpty())
				$query .= sprintf("AND p.datainicio = '%s' ",mysql_real_escape_string($this->getDataInicio()));
			if(!$this->isDataTerminoEmpty())
				$query .= sprintf("AND p.datatermino = '%s' ",mysql_real_escape_string($this->getDataTermino()));
			if(!$this->isTamanhoLoteEmpty())
				$query .= sprintf("AND p.tamanholote = '%s' ",mysql_real_escape_string($this->getTamanhoLote()));	
			if(!$this->isPrecoLoteEmpty())
				$query .= sprintf("AND p.precolote = '%s' ",mysql_real_escape_string($this->getPrecoLote()));	
			if(!$this->isValidadeAposCompraEmpty())
				$query .= sprintf("AND p.validadeaposcompra = '%s' ",mysql_real_escape_string($this->getValidadeAposCompra()));
			
			
		    $result = $db->query($query);
		    
		    $db = null;//fecha conexao

		    if (!$result)
		    	return -1;
		    else return $result;

		} catch (Exception $e) {

		    return ERRO__MYSQL__FALHACONEXAO;

		}								
		
	}
	
	
	public function delete(){
 		
 		/*
 		 * Delete Product in the Database.		
 		 * The deletion is based on the primary key (idproduto)
 		 * 
 		 */
 		
 		
 		if($this->isIdProdutoEmpty()) {
 			return -1; 			 			
 		}


 		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);
			
			$query = sprintf("UPDATE produto SET produto.excluidovendedor= 1 WHERE idproduto=%d",
															$this->getIdProduto());

			//echo $query;
			$db->exec($query);		
			
		    $db = null;//fecha conexao

		    return 1; //1:sucesso

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
		}
 		
 		
	}
	
	
	/* Metodos uteis para manipulacao da base de dados de produtos*/
	
	
	public function selectBuyerProducts(){
		
 		
 		/*
 		 * Select all the bought Products  of the current user, from the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		//adicionar assim que acrescentarmos sessao com usuario
 		//if(empty($_SESSION['usuario'].id)) return -1;
 		//$idUsuario=$_SESSION['usuario'].id;
 		$idUsuario=1;

		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);

			$query = sprintf("SELECT p.* from produto_cliente pc NATURAL JOIN produto p on pc.idcliente = %d ",$idUsuario);
		    //Insere. Funcao retorna o numero de linhas afetadas			    
		    $result = $db->query($query);		    
		    
		    $db = null;//fecha conexao
		    if (!$result) 
		    	return -1;
		    else return $result;

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
		}		
												
	}

	public function selectSellerProducts(){
		
 		
 		/*
 		 * Select all the selling Products of the current user, from the Database.
 		 * The info used is the info present in this class, which means this
 		 * method expect the user to fill some/all fields of this class before
 		 * calling this method.
 		 * 
 		 * If there is no info in this class (all fields are blank), this method shall return -1;
 		 * If there is no data in the database associated with the given info to this class, this method shall return -1;
 		 * 
 		 * On successfull, this method returns the result of the query (an array of all the rows matching the given info)
 		 */
 		
 		
 		//adicionar assim que acrescentarmos sessao com usuario
 		//if(empty($_SESSION['usuario'].id)) return -1;
 		//$idUsuario=$_SESSION['usuario'].id;
 		$idUsuario=1;

		try {
						
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);

			//obs, join nao esta retornando id do usuario(apenas os campos de produto)
			$query = sprintf("SELECT p.* from produto_vendedor pv NATURAL JOIN produto p WHERE p.excluidovendedor = 0 AND pv.idvendedor = %d",$idUsuario);
		    
		    $result = $db->query($query);		    
		    
		    $db = null;//fecha conexao
		    if (!$result)
		    	return -1;
		    else return $result;

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
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
 		
 		
		try {
			
			//conecta na base base
			$db = new PDO("mysql:host=".ENDERECOBASE.";dbname=".BASEDADOS, USUARIOBASE, SENHA);

			$query = "SELECT * from produto";
		    //Insere. Funcao retorna o numero de linhas afetadas			    
		    $result = $db->query($query);		    
		    
		    $db = null;//fecha conexao
		    if (!$result) 
		    	return -1;
		    else return $result;

		} catch (Exception $e) {
		    return ERRO__MYSQL__FALHACONEXAO;
		}

		
	}
	
	
		
 		
}//fim classe produto





}?>
