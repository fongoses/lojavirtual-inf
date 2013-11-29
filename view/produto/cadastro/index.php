<?php
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
       
       
       
       

       
       
    <title>Cadastro de Produtos</title>
</head>

<body>  


        <div class="modal fade" id='modalWindow'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.href='../visualizacao';">&times;</button>
                        <h4 class="modal-title">Cadastre seu produto</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id='formCadastro' action='../../../controller/produto/cadastra_produto.php' method='post'>
                            
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Nome do Produto*</label>
                                    <input type='text' name='nome' class="form-control" placeholder="Nome"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Descrição</label>
                                    <input type='text' name='descricao' class="form-control" placeholder="Descricao"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Quantidade *</label>
                                    <input type='text' name='quantidade' class="form-control" placeholder="Quantidade"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Preço*</label>
                                    <input type='text' name='preco' class="form-control" placeholder="Preco"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Foto</label>
                                    <input type='text' name='linkfoto' class="form-control" placeholder="Link para a foto"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Início da Venda</label>
                                    <input type='text' name='datainicio' class="form-control" placeholder="Data de Inicio"/>
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Término da Venda</label>
                                    <input type='text' name='datatermino' class="form-control" placeholder="Data de Termino"/>
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Tamanho do Lote</label>
                                    <input type='text' name='tamanholote' class="form-control" placeholder="Tamanho do Lote"/>
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Preço do lote</label>
                                    <input type='text' name='precolote' class="form-control" placeholder="Preço"/>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="code">Validade de uso</label>
                                    <input type='text' name='validadeaposcompra' class="form-control" placeholder="Validade"/>
                                </div>
                            </div>
                            
                            
                            
                            

                            

                        </form>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.href='../visualizacao/';">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick='document.getElementById("formCadastro").submit();'>Cadastrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


       
       
               
                       
       
       
       
       
       
       



</body>
</html>

