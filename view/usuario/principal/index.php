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
       
       
       
       
       
       
<title>SmartTicket::</title>
</head>

<body >
  

  <?php //Exibe Barra Superior e Produtos Cadastrados
      
      include($CONTROLLERPATH.'/session/restrict/barra_usuario.php');

      $produto = new produto();   
  
      //$produto->setNome("Bola");
      $produtosParaVender= $produto->selectAllProducts();  
  
      $i=1;
      echo "<div class=\"container\">";
      foreach ($produtosParaVender as $cadaProduto){

          if(!($i % 3)){
            echo "<div class='row'>";

          }
                  
          echo "<div class=\"col-sm-6 col-md-4\"> 
          <div class=\"thumbnail\">
              <img src=\"".(($cadaProduto['linkfoto']=='')?'../../img/semfoto.png':$cadaProduto['linkfoto'])."\"/>
              <div class=\"caption\">
                  <h3>".$cadaProduto['nome']."</h3>
                  <h4>".$cadaProduto['nomevendedor']."</h4>
                  <p>".$cadaProduto['descricao']."</p>                  
                  <a href=\"#\" class=\"btn btn-primary\" role=\"button\">Comprar</a>                     
                  
              </div>
          </div>
          </div>";


          if(!($i % 3)){
            echo "</div>";

          }
          $i++;
        }

        if($i % 3){ //faltou fechar a row
          echo "</div>";
        }
        echo "</div>";//fecha div container


  ?> 

  




	



</body>
</html>
