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
 	include($CONTROLLERPATH.'/session/restrict/restrictPageHeader.php');
 	include($CONTROLLERPATH.'/session/restrict/sessionControl.php');
 	include($CONTROLLERPATH.'/errors/errors.php');
 	include($MODELPATH.'/produto/produto.php');
 ?>



<!DOCTYPE html>
<html>
<head>
       
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <!-- StyleSheets  -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"></link>    
    <link rel="stylesheet" type="text/css" href="../../css/smartstyle.css"></link>

    <!-- Carrega Scripts -->
    <script src="../../js/jquery.js" type="text/javascript"></script> 
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script> 
    
    <script src="documentReady.js" type="text/javascript" ></script> 
       
       
       
       
<title>Cadastro</title>
</head>

<body>

	



 <?php
 	
 	
 	/* --Methods-----------------------------------------------------*/
 	
 
 	$produto = new produto(); 	
 	
 	//$produto->setNome("Bola");
 	$produtosParaVender= $produto->selectSellerProducts(); 	
 	$produtosComprados = $produto->selectBuyerProducts(); 	

 	include($CONTROLLERPATH.'/session/restrict/barra_usuario.php');	

 	echo 
 	"<div class=\"container\">
 			<h3>Produtos a venda <button type=\"button\" class=\"btn btn-primary\" onclick=\"location.href='../cadastro/'\">Cadastrar Produto</button></h3>
            <div class=\"panel-body\">
                <ul class=\"list-group\">";

 	
 	foreach ($produtosParaVender as $cadaProduto){
 		echo "<li class=\"list-group-item\">
                        <div class=\"row\">
                            <div class=\"col-xs-2 col-md-1\">
                                <img src=\"http://placehold.it/80\" class=\"img-circle img-responsive\" alt=\"\" /></div>
                            <div class=\"col-xs-10 col-md-11\">
                                <div><h4>"                                    
                                    .$cadaProduto['nome'].
                                    "</h4>
                                    <h5>"                                    
                                    .$cadaProduto['descricao'].
                                    "</h5>
                                  <div class=\"mic-info\">
                                        Cadastrado em: ".$cadaProduto['datainicio']."
                                    </div>
                                </div>
                                <div class=\"comment-text\">
                                    Quantidade:".$cadaProduto['quantidade']."
                                </div>
                                <div class=\"action\">

                                	<form id='productEditForm' method=post action=\"../../../controller/produto/visualiza_informacoes_produto.php\">
										<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/> 
    								</form>

    								<form id='productDeleteForm' method=post action=\"../../../controller/produto/deleta_produto.php\">
										<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>    									
    								
    								</form>
    			
									<button type=\"button\" class=\"btn btn-primary btn-xs\" title=\"Editar\" onclick=\"document.getElementById('productEditForm').submit();\">                                        
                                        <span class=\"glyphicon glyphicon-pencil\"></span>
                                    </button> 

                                    <button type=\"button\" class=\"btn btn-danger btn-xs\" title=\"Apagar\" onclick=\"document.getElementById('productDeleteForm').submit();\">
                                        <span class=\"glyphicon glyphicon-trash\"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>";
			
	}
	echo "</li></ul></div><div>";				

	/*echo $cadaProduto['idproduto']." - "
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
    					"<input type=submit value=\"Atualizar\">".
    			"</form>".
    			"</td>".
    			"<td>".
				"<form name='productEditForm' method=post action=\"../../../controller/produto/deleta_produto.php\">".
						"<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>".
    					"<input type=submit value=\"Apagar\">".
    			"</form>".
    			"</td>".
    			"</tr>".
    			"</table>";*/

	//Comprados
	echo 
 	"<div class=\"container\">
 			<h3>Produtos Comprados</h3>
            <div class=\"panel-body\">
                <ul class=\"list-group\">";

 	
 	foreach ($produtosComprados as $cadaProduto){
 		echo "<li class=\"list-group-item\">
                        <div class=\"row\">
                            <div class=\"col-xs-2 col-md-1\">
                                <img src=\"http://placehold.it/80\" class=\"img-circle img-responsive\" alt=\"\" /></div>
                            <div class=\"col-xs-10 col-md-11\">
                                <div><h4>"                                    
                                    .$cadaProduto['nome'].
                                    "</h4><div class=\"mic-info\">
                                        Cadastrado em: ".$cadaProduto['datainicio']."
                                    </div>
                                </div>
                                <div class=\"comment-text\">
                                    Quantidade:".$cadaProduto['quantidade']."
                                </div>
                                <div class=\"action\">

                                	<form id='productEditForm' method=post action=\"../../../controller/produto/visualiza_informacoes_produto.php\">
										<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/> 
    								</form>

    								<form id='productDeleteForm' method=post action=\"../../../controller/produto/deleta_produto.php\">
										<input type=text name=\"idproduto\" value=\"".$cadaProduto['idproduto']."\" style=\"display:none;\"/>    									
    								
    								</form>
    			
									<button type=\"button\" class=\"btn btn-primary btn-xs\" title=\"Editar\" onclick=\"document.getElementById('productEditForm').submit();\">                                        
                                        <span class=\"glyphicon glyphicon-pencil\"></span>
                                    </button> 

                                    <button type=\"button\" class=\"btn btn-danger btn-xs\" title=\"Apagar\" onclick=\"document.getElementById('productDeleteForm').submit();\">
                                        <span class=\"glyphicon glyphicon-trash\"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>";
			
	}
	echo "</li></ul></div><div>";	
?>
</body>
</html>