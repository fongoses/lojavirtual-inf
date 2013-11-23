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
 	echo 'asd';

 	
 	/* --Includes/Imports---------------------------------------------*/
 	include($CONTROLLERPATH.'/session/restrict/sessionControl.php');
 	include($CONTROLLERPATH.'/errors/errors.php');
 	include($MODELPATH.'/produto/produto.php');
 	
 	header('Content-Type: text/html; charset=UTF-8');
 	 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/
 	
 	$idProduto = intval(mysql_real_escape_string($_POST['idproduto'])); //evita injection
 	

 	$produto = new produto();
 	$produto->setIdProduto($idProduto);
 	
 	 	 
 	$produtoSelecionado = $produto->select(1);
 	

 	echo "<h2>Informacoes do Produto:</h2><hr>";

 	foreach ($produtoSelecionado as $cadaProduto)
			echo"Identificador: ".$cadaProduto['idproduto'].
				"<br>Nome: ".$cadaProduto['nome'].
				"<br>Descricao: ".$cadaProduto['descricao'].
				"<br>Quantidade: ".$cadaProduto['quantidade'].
				"<br>Preco: ".$cadaProduto['preco'].
				"<br>Foto: <a href='http://".$cadaProduto['linkfoto']."'/>".$cadaProduto['linkfoto']."</a>".
				"<br>Venda iniciada em: ".$cadaProduto['datainicio'].
				"<br>Venda finaliza em: ".$cadaProduto['datatermino'].
				"<br>Tamanho do Lote: ".$cadaProduto['tamanholote'].
				"<br>Preco do Lote: ".$cadaProduto['precolote'].				
				"<br>Validade Apos Compra: ".$cadaProduto['validadeaposcompra'];
	
?>

