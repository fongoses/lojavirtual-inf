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
 	include($CONTROLLERPATH.'/errors/errors.php');
 	include($MODELPATH.'/produto/produto.php'); 	
 	header('Content-Type: text/html; charset=UTF-8');
 	 	
  	//echo '<script type="text/javascript"> alert("aaa") </script>'
 	/* --Methods-----------------------------------------------------*/
 	
 	$idProduto = intval($_POST['idproduto']);
 	

 	$produto = new produto();
 	$produto->setIdProduto($idProduto);
 	
 	//if($produto->belongsToUser($_SESSION['user']->getName()))
 		$produtoSelecionado = $produto->select(1);
 	
?>

<!DOCTYPE html>
<html>
<head>
       
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <!-- StyleSheets  -->
    <link rel="stylesheet" type="text/css" href="../../view/css/bootstrap.min.css"></link>    
    <link rel="stylesheet" type="text/css" href="../../view/css/mainstyle.css"></link>
    <link rel="stylesheet" type="text/css" href="../../view/css/smartstyle.css"></link>

    <!-- Carrega Scripts -->
    <script src="../../view/js/jquery.js" type="text/javascript"></script> 
    <script src="../../view/js/bootstrap.min.js" type="text/javascript"></script> 
    
    
       
       
       
       
<title>Cadastro</title>
</head>

<body>


<?php

	include($CONTROLLERPATH.'/session/restrict/barra_usuario.php');  
	$produtoSelecionado=$produtoSelecionado[0];
	
	echo "<div class='container'>";
	echo "<form role=\"form\" id='formEdicao' action='../produto/atualiza_produto.php' method='post'>
                            
							<div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Identificador</label>
                                    <input type='text' name='idproduto' class=\"form-control\" placeholder=\"Id\" value=\"".$produtoSelecionado['idproduto']."\"/>
                                </div>
                            </div>


                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Nome do Produto*</label>
                                    <input type='text' name='nome' class=\"form-control\" placeholder=\"Nome\" value=\"".$produtoSelecionado['nome']."\"/>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Descrição</label>
                                    <input type='text' name='descricao' class=\"form-control\" placeholder=\"Descricao\" value=\"".$produtoSelecionado['descricao']."\"/>
                                </div>
                            </div>


                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Quantidade *</label>
                                    <input type='text' name='quantidade' class=\"form-control\" placeholder=\"Quantidade\" value=\"".$produtoSelecionado['quantidade']."\"/>
                                </div>
                            </div>


                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Preço*</label>
                                    <input type='text' name='preco' class=\"form-control\" placeholder=\"Preco\" value=\" ".$produtoSelecionado['preco']."\"/>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Foto</label>
                                    <input type='text' name='linkfoto' class=\"form-control\" placeholder=\"Link para a foto\" value=\"".$produtoSelecionado['linkfoto']."\" />
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Início da Venda</label>
                                    <input type='text' name='datainicio' class=\"form-control\" placeholder=\"Data de Inicio\" value=\"".$produtoSelecionado['datainicio']."\" />
                                </div>
                            </div>

                             <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Término da Venda</label>
                                    <input type='text' name='datatermino' class=\"form-control\" placeholder=\"Data de Termino\" value=\"".$produtoSelecionado['datatermino']."\" />
                                </div>
                            </div>

                             <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Tamanho do Lote</label>
                                    <input type='text' name='tamanholote' class=\"form-control\" placeholder=\"Tamanho do Lote\" value=\"".$produtoSelecionado['tamanholote']."\" />
                                </div>
                            </div>

                             <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Preço do lote</label>
                                    <input type='text' name='precolote' class=\"form-control\" placeholder=\"Preço\" value=\"".$produtoSelecionado['precolote']."\"/>
                                </div>
                            </div>
                            
                             <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <label for=\"code\">Validade de uso</label>
                                    <input type='text' name='validadeaposcompra' class=\"form-control\" placeholder=\"Validade\" value=\"".$produtoSelecionado['validadeaposcompra']."\" />
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"form-group col-lg-5\">
                                    <button type=\"submit\" class=\"btn btn-primary pull-right\">Atualizar</button></div>
                                </div>
                            
                          </div>

                        </form></div>";



 	
?>

</body>
</html>