<?php

if(!defined("__MVCPATHS__")) {
    define("__MVCPATHS__", "true");
    
        $MAINPATH=$_SERVER['DOCUMENT_ROOT'].'lojavirtual';
        $CONTROLLERPATH=$MAINPATH.'/controller';
        $MODELPATH = $MAINPATH.'/model';
    
    }





include($CONTROLLERPATH.'/session/restrict/restrictPageHeader.php');

 $barra = 
            "<nav class=\"navbar navbar-smart\" role=\"navigation\">
            <!-- Brand and toggle get grouped for better mobile display -->
              
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav\">
                  <li class=\"divider-vertical\"></li>
                  <li><a href=\"http://localhost/lojavirtual/view/usuario/principal/\"><span class=\"glyphicon glyphicon-star\"></span> Home</a></li>
                </ul>

                
                <ul class=\"nav navbar-nav navbar-right\">      
                  <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$_SESSION['user']->getName()." <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                      <li><a href=\"../../produto/visualizacao/\">Meus Produtos</a></li> 
                      <li class=\"divider\"></li>
                      <li><a href=\"http://localhost/lojavirtual/view/usuario/configuracoes/\">Configurações</a></li> 
                      <li class=\"divider\"></li>
                      <li><a href=\""."http://".$_SERVER['HTTP_HOST']."/lojavirtual/view/usuario/logout/\">Sair</a></li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </nav>";


    echo $barra;

?>