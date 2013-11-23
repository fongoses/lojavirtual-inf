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
 	
 	
 	$produto = new produto();
 	
 	
 	//$produto->setNome("Bola");
 	$produtosParaVender= $produto->selectSellerProducts(); 	
 	$produtosComprados = $produto->selectBuyerProducts(); 	

 	echo "<h2>Produtos a venda:</h2><hr>";
 	foreach ($produtosParaVender as $cadaProduto)
			echo $cadaProduto['idproduto']." - "
				.$cadaProduto['nome']. " - "
				.$cadaProduto['quantidade']." - "
				.$cadaProduto['preco'].
				"<table>".
				"<tr>".
				"<td>".
				"<form name='productDetailForm' method=post action=\"../../../controller/produto/visualiza_informacoes_produto.php\">".
						"<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>".
    					"<input type=submit value=\"Detalhar\">".
    			"</form>".
    			"</td>".
    			"<td>".
				"<form name='productEditForm' method=post action=\"../../../controller/produto/visualiza_informacoes_produto.php\">".
						"<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>".
    					"<input type=submit value=\"Editar\">".
    			"</form>".
    			"</td>".
    			"</tr>".
    			"</table>";
					

	echo "<br><h2>Produtos Comprados:</h2><hr>";
 	foreach ($produtosComprados as $cadaProduto)
			echo $cadaProduto['idproduto']." - "
				.$cadaProduto['nome']. " - "
				.$cadaProduto['quantidade']." - "
				.$cadaProduto['preco'].
				"<form name='productDetailForm' method=post action=\"../../../controller/produto/visualiza_informacoes_produto.php\">".
						"<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>".
    					"<input type=submit value=\"Detalhar\">".
    			"</form><br>";
						
?>

