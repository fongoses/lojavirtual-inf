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
 	
 	$idProduto = intval(mysql_real_escape_string($_POST['idproduto']));
 	

 	$produto = new produto();
 	$produto->setIdProduto($idProduto);
 	
 	//if($produto->belongsToUser($_SESSION['user']->getName()))
 		$produtoSelecionado = $produto->select(1);
 	

 	echo "<h2>Informacoes do Produto:</h2><hr>";
 	echo "<table>".			
			"<form name='productEditionForm' method=post action=\"../../controller/produto/atualiza_produto.php\">";


 	foreach ($produtoSelecionado as $cadaProduto)
			echo"<tr><td>Identificador:</td><td>".$cadaProduto['idproduto']."<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/></td></tr>".
				"<tr><td>Nome: </td><td><input type=\"text\" name=\"nome\" value=\"".$cadaProduto['nome']."\"/></td></tr>".
				"<tr><td>Descricao: </td><td><input type=\"text\" name=\"descricao\" value=\"".$cadaProduto['descricao']."\"/></td></tr>".
				"<tr><td>Quantidade: </td><td><input type=\"text\" name=\"quantidade\" value=\"".$cadaProduto['quantidade']."\"/></td></tr>".
				"<tr><td>Preco: </td><td><input type=\"text\" name=\"preco\" value=\"".$cadaProduto['preco']."\"/></td></tr>".
				"<tr><td>Foto: </td><td><input type=\"text\" name=\"linkfoto\" value=\"".$cadaProduto['linkfoto']."\"/></td></tr>".
				"<tr><td>Venda iniciada em: </td><td><input type=\"text\" name=\"datainicio\" disabled=true value=\"".$cadaProduto['datainicio']."\"/></td></tr>".
				"<tr><td>Venda finaliza em: </td><td><input type=\"text\" name=\"datatermino\" value=\"".$cadaProduto['datatermino']."\"/></td></tr>".
				"<tr><td>Tamanho do Lote: </td><td><input type=\"text\" name=\"tamanholote\" value=\"".$cadaProduto['tamanholote']."\"/></td></tr>".
				"<tr><td>Preco do Lote: </td><td><input type=\"text\" name=\"precolote\" value=\"".$cadaProduto['precolote']."\"/></td></tr>".
				"<tr><td>Validade Apos Compra: </td><td><input type=\"text\" name=\"validadeaposcompra\" value=\"".$cadaProduto['validadeaposcompra']."\"/></td></tr>".
				"<tr><td><input type='submit' value=\"Salvar\"/></td</tr>";	

	echo "</form></table>";
?>

